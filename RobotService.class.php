<?php
/**
 * Created by PhpStorm.
 * User: mjvila
 * Date: 05/08/2018
 * Time: 8:57 AM
 */
Class RobotService implements IRobotService {
    /**
     * Commands
     */
    const CMD_TURN_LEFT     = 'TL';
    const CMD_TURN_RIGHT    = 'TR';
    const CMD_ADVANCE       = 'A';
    const CMD_CLEAN         = 'C';
    const CMD_SPACE         = 'S';
    const CMD_BACK          = 'B';

    /**
     * @var \Location
     */
    private $location;

    /**
     * @var \RobotActions
     */
    private $robotAction;

    /**
     * @var \Rules
     */
    private $rules;

    private $map;
    private $commands;
    private $battery;
    private $visited;
    private $cleaned;
    private $final;

    /**
     * Set the json file and convert to objects (map, start, commands, battery)
     * @param string $jsonFile
     */
    public function loadJsonData($jsonObj)
    {
        $this->map = $jsonObj->map;

        $this->location = new \Location();
        $x = $jsonObj->start->X;
        $y = $jsonObj->start->Y;
        $this->location->setX($x);
        $this->location->setY($y);
        $this->location->setFacing($jsonObj->start->facing);
        $this->location->setStatus($this->map[$y][$x]);
        $this->location->setTotalX(count(current($jsonObj->map)) - 1);
        $this->location->setTotalY(count($jsonObj->map) - 1);

        $this->visited = array();
        $this->visited[] =  array(
            'X' => $x,
            'Y' => $y
        );
        $this->commands = $jsonObj->commands;
        $this->battery = $jsonObj->battery;

        $this->robotAction = new \RobotActions();
        $this->rules = new \Rules();
    }

    /**
     * Execute the commands
     */
    public function run()
    {

        foreach ($this->commands as $command) {
            $this->getAction ($command);
        }

        $this->final = array(
            'X' => $this->location->getX(),
            'Y' => $this->location->getY(),
            'facing' => $this->location->getFacing()
        );

        $jsonResponse = array(
            "visited" => $this->visited,
            "cleaned" => $this->cleaned,
            "final" => $this->final,
            "battery" => $this->battery
        );

        return json_encode($jsonResponse);
    }

    private function getAction ($command) {
        $this->logs[] = array(
            'X' => $this->location->getX(),
            'Y' => $this->location->getY(),
            'facing' => $this->location->getFacing(),
            'status' => $this->location->getStatus(),
        );
        switch ($command) {
            case self::CMD_TURN_LEFT :
                $this->battery = $this->battery - 1;
                $this->currentFacing = $this->robotAction->turnLeft($this->location);
                break;
            case self::CMD_TURN_RIGHT :
                $this->battery = $this->battery - 1;
                $this->currentFacing = $this->robotAction->turnRight($this->location);
                break;
            case self::CMD_ADVANCE :
                $this->battery = $this->battery - 2;
                $location = $this->robotAction->goForward($this->location, $this->map);
                if ($location->getStatus() == self::CMD_SPACE) {
                    $this->setVisited($location);
                    $this->rules->resetHits();
                } else {
                    $this->executeRules();
                }
                break;
            case self::CMD_BACK :
                $this->battery = $this->battery - 3;
                $location = $this->robotAction->goBack($this->location, $this->map);
                if ($location->getStatus() == self::CMD_SPACE) {
                    $this->setVisited($location);
                } else {
                    $this->executeRules();
                }
                break;
            case self::CMD_CLEAN:
                $this->battery = $this->battery - 5;
                $this->map = $this->robotAction->clean($this->location, $this->map);
                $this->cleaned[] =  array(
                    'X' => $this->location->getX(),
                    'Y' => $this->location->getY()
                );
                break;
            default:
                break;
        }
    }

    private function executeRules() {
        $rules = $this->rules->getRules();
        foreach ($rules as $command) {
            $this->getAction ($command);
        }
    }

    /**
     * Sets visited location
     * If it is already visited will not be registered.
     * @param Location $location
     */
    private function setVisited(\Location $location) {
        $isExisting = false;
        $x = $location->getX();
        $y = $location->getY();

        foreach ($this->visited as $visitedLoc) {
            $visitedX = $visitedLoc['X'];
            $visitedY = $visitedLoc['Y'];
            if ($visitedX == $x && $visitedY == $y) {
                $isExisting = true;
            }
        }

        if (!$isExisting) {
            $this->visited[] =  array(
                'X' => $location->getX(),
                'Y' => $location->getY()
            );
        }
    }
}
