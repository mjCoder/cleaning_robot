<?php
/**
 * Created by PhpStorm.
 * User: mjvila
 * Date: 03/08/2018
 * Time: 6:07 PM
 */
interface IRobotActions {
    /**
     * Sets new direction after turning left.
     * @param \Location $location
     * @return \Location
     */
    public function turnLeft(\Location $location);

    /**
     * Sets new direction after turning right.
     * @param \Location $location
     * @return \Location
     */
    public function turnRight(\Location $location);

    /**
     * Advance to new coordinates.
     * @param \Location $location
     * @param array $map
     * @return \Location
     */
    public function goForward(\Location $location, array $map);

    /**
     * Go back to previous coordinate.
     * @param \Location $location
     * @param array $map
     * @return \Location
     */
    public function goBack(\Location $location, array $map);

    /**
     * Clean the current coordinate.
     * @param \Location $location
     * @param array $map
     * @return \Location
     */
    public function clean(\Location $location, array $map);
}