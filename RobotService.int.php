<?php
/**
 * Created by PhpStorm.
 * User: mjvila
 * Date: 05/08/2018
 * Time: 8:51 AM
 */
interface IRobotService {
    /**
     * Set the json file path
     * @param object $jsonObj
     */
    public function loadJsonData($jsonObj);
    public function run();
}