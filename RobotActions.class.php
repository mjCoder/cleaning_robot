<?php
/**
 * This class refers to the entire actions of what the robot can do.
 * Created by PhpStorm.
 * User: mjvila
 * Date: 03/08/2018
 * Time: 6:07 PM
 */
Class RobotActions implements IRobotActions {
    const ACTION_CLEAN = 'C';

    const DIR_NORTH = 'N';
    const DIR_WEST = 'W';
    const DIR_EAST = 'E';
    const DIR_SOUTH = 'S';

    /**
     * Sets new direction after turning left.
     * @param \Location $location
     * @return \Location
     */
    public function turnLeft(\Location $location)
    {
        $direction = $location->getFacing();
        switch ($direction) {
            case self::DIR_NORTH :
                $location->setFacing(self::DIR_WEST);
                break;
            case self::DIR_WEST :
                $location->setFacing(self::DIR_SOUTH);
                break;
            case self::DIR_SOUTH :
                $location->setFacing(self::DIR_EAST);
                break;
            case self::DIR_EAST :
                $location->setFacing(self::DIR_NORTH);
                break;
            default:
                break;
        }
        return $location;
    }

    /**
     * Sets new direction after turning right.
     * @param \Location $location
     * @return \Location
     */
    public function turnRight(\Location $location)
    {
        $direction = $location->getFacing();
        switch ($direction) {
            case self::DIR_NORTH :
                $location->setFacing(self::DIR_EAST);
                break;
            case self::DIR_WEST :
                $location->setFacing(self::DIR_NORTH);
                break;
            case self::DIR_SOUTH :
                $location->setFacing(self::DIR_WEST);
                break;
            case self::DIR_EAST :
                $location->setFacing(self::DIR_SOUTH);
                break;
            default:
                break;
        }
        return $location;
    }

    /**
     * Advance to new coordinates.
     * @param \Location $location
     * @param array $map
     * @return \Location
     */
    public function goForward(\Location $location, array $map)
    {
        $x = $location->getX();
        $y = $location->getY();
        $direction = $location->getFacing();
        $totalX = $location->getTotalX();
        $totalY = $location->getTotalY();

        switch ($direction) {
            case self::DIR_NORTH :
                if ($y != 0) {
                    $y = $y - 1;
                    if ($map[$y][$x] != self::ACTION_CLEAN) {
                        $location->setY($y);
                    }
                    $location->setStatus($map[$y][$x]);
                } else {
                    $location->setStatus(null);
                }
                break;
            case self::DIR_WEST :
                if ($x != 0) {
                    $x = $x - 1;
                    if ($map[$y][$x] != self::ACTION_CLEAN) {
                        $location->setX($x);
                    }
                    $location->setStatus($map[$y][$x]);
                } else {
                    $location->setStatus(null);
                }
                break;
            case self::DIR_SOUTH :
                if ($y != $totalY) {
                    $y = $y + 1;
                    if ($map[$y][$x] != self::ACTION_CLEAN) {
                        $location->setY($y);
                    }
                    $location->setStatus($map[$y][$x]);
                } else {
                    $location->setStatus(null);
                }
                break;
            case self::DIR_EAST :
                if ($x != $totalX) {
                    $x = $x + 1;
                    if ($map[$y][$x] != self::ACTION_CLEAN) {
                        $location->setX($x);
                    }
                    $location->setStatus($map[$y][$x]);
                } else {
                    $location->setStatus(null);
                }
                break;
            default:
                break;
        }
        return $location;
    }

    /**
     * Go back to previous coordinate.
     * @param \Location $location
     * @param array $map
     * @return boolean
     */
    public function goBack(\Location $location, array $map)
    {
        $x = $location->getX();
        $y = $location->getY();
        $direction = $location->getFacing();
        $totalX = $location->getTotalX();
        $totalY = $location->getTotalY();

        switch ($direction) {
            case self::DIR_NORTH :
                if ($y != $totalY) {
                    $y = $y + 1;
                    if ($map[$y][$x] != self::ACTION_CLEAN) {
                        $location->setY($y);
                    }
                    $location->setStatus($map[$y][$x]);
                } else {
                    $location->setStatus(null);
                }

                break;
            case self::DIR_WEST :
                if ($x != $totalX) {
                    $x = $x + 1;
                    if ($map[$y][$x] != self::ACTION_CLEAN) {
                        $location->setX($x);
                    }
                    $location->setStatus($map[$y][$x]);
                } else {
                    $location->setStatus(null);
                }

                break;
            case self::DIR_SOUTH :
                if ($y != 0) {
                    $y = $y - 1;
                    if ($map[$y][$x] != self::ACTION_CLEAN) {
                        $location->setY($y);
                    }
                    $location->setStatus($map[$y][$x]);
                } else {
                    $location->setStatus(null);
                }
                break;
            case self::DIR_EAST :
                if ($x != 0) {
                    $x = $x - 1;
                    if ($map[$y][$x] != self::ACTION_CLEAN) {
                        $location->setX($x);
                    }
                    $location->setStatus($map[$y][$x]);
                } else {
                    $location->setStatus(null);
                }
                break;
            default:
                break;
        }
        return $location;
    }

    /**
     * Clean the current coordinate.
     * @param \Location $location
     * @param array $map
     * @return \Location
     */
    public function clean(\Location $location, array $map)
    {
        $location->setStatus(self::ACTION_CLEAN);
        $x = $location->getX();
        $y = $location->getY();
        $map[$y][$x] = self::ACTION_CLEAN;
        return $map;
    }
}