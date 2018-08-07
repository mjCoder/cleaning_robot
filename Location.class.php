<?php
/**
 * Created by PhpStorm.
 * User: mjvila
 * Date: 07/08/2018
 * Time: 7:16 AM
 */
Class Location {

    /**
     * @var int     $x          - x map coordinates.
     * @var int     $y          - y map coordinates.
     * @var string  $facing     - the direction it faces.
     * @var string  $status     - the current status of the location (S or C).
     * @var int     $totalX     - the maximum x map coordinates.
     * @var int     $totalY     - the maximum y map coordinates.
     */
    private $x;
    private $y;
    private $facing;
    private $status;
    private $totalX;
    private $totalY;

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param mixed $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function getFacing()
    {
        return $this->facing;
    }

    /**
     * @param mixed $facing
     */
    public function setFacing($facing)
    {
        $this->facing = $facing;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getTotalX()
    {
        return $this->totalX;
    }

    /**
     * @param mixed $totalX
     */
    public function setTotalX($totalX)
    {
        $this->totalX = $totalX;
    }

    /**
     * @return mixed
     */
    public function getTotalY()
    {
        return $this->totalY;
    }

    /**
     * @param mixed $totalY
     */
    public function setTotalY($totalY)
    {
        $this->totalY = $totalY;
    }


}