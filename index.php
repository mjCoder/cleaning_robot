<?php
/**
 * Created by PhpStorm.
 * User: mjvila
 * Date: 05/08/2018
 * Time: 12:14 PM
 */
require 'RobotActions.int.php';
require 'RobotService.int.php';
require 'RobotActions.class.php';
require 'RobotService.class.php';
require 'Rules.class.php';
require 'Location.class.php';

if (isset($argv[1])) {
    // To execute from command line. Getting argument 1 as the path for the json file.
    $jsonFile = __DIR__ . $argv[1];
    $jsonData = file_get_contents($jsonFile);
    $jsonObj = json_decode($jsonData);

} elseif (isset($_POST)) {
    // To execute via JSON POST Request.

    // To check that the content type of the POST request has been set to application/json
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if(strcasecmp($contentType, 'application/json') != 0){
        throw new Exception('Content type must be: application/json');
    }

    //Receive the RAW post data.
    $jsonData = trim(file_get_contents("php://input"));
    $jsonObj = json_decode($jsonData);
}

$robotService = new \RobotService();
$robotService->loadJsonData($jsonObj);
$output = $robotService->run();
echo $output;