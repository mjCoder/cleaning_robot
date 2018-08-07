<?php
/**
 * Created by PhpStorm.
 * User: mjvila
 * Date: 07/08/2018
 * Time: 4:31 PM
 */
require '../RobotActions.int.php';
require '../RobotService.int.php';
require '../RobotActions.class.php';
require '../RobotService.class.php';
require '../Rules.class.php';
require '../Location.class.php';

use PHPUnit\Framework\TestCase;

Class RobotServiceTest extends TestCase
{
    private $robotService;

    public function setUp()
    {
        $this->robotService = new \RobotService();
    }

    /**
     * @param $jsonObj
     * @param $expectedResult
     *
     * @dataProvider dataProviderJson
     */
    public function testRun($jsonObj, $expectedResult)
    {
        $this->robotService->loadJsonData($jsonObj);
        $jsonResponse = $this->robotService->run();

        $this->assertEquals($expectedResult, $jsonResponse);
    }

    /**
     * @return array
     */
    public static function dataProviderJson()
    {
        $jsonFile1 = '../data/test1.json';
        $jsonData1 = file_get_contents($jsonFile1);
        $jsonObj1 = json_decode($jsonData1);
        $jsonResultFile1 = '../data/test1_real_result.json';
        $expectedResult1 = file_get_contents($jsonResultFile1);

        $jsonFile2 = '../data/test2.json';
        $jsonData2 = file_get_contents($jsonFile2);
        $jsonObj2 = json_decode($jsonData2);
        $jsonResultFile2 = '../data/test2_real_result.json';
        $expectedResult2 = file_get_contents($jsonResultFile2);

        return array(
            'Load test1.json' => array(
                $jsonObj1, $expectedResult1
            ),
            'Load test2.json' => array(
                $jsonObj2, $expectedResult2
            )
        );
    }

}