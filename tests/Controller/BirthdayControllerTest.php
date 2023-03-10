<?php

namespace Tests\Birthday\Controller;

require_once("./vendor/autoload.php");
require_once("./src/Controller/BirthdayController.php");
require_once("./src/Service/JsonDataService.php");

use Birthday\Controller\BirthdayController;
use Mockery;
use PHPUnit\Framework\TestCase;

class BirthdayControllerTest extends TestCase
{
    private $filePath;
    private $birthdayController;

    function setUp(): void
    {
        parent::setUp();

        $this->filePath = './tests/Assets/testData.json';
        $this->birthdayController = new BirthdayController();
    }

    function tearDown(): void
    {
        unset($this->birthdayController);
        unlink($this->filePath);

        parent::tearDown();
    }

    public function testWhenBirthdayIsToday()
    {
        $birthday = date('m/d');
        $data = '[["Smith", "Mark", "1990/' . $birthday . '"]]';
        file_put_contents($this->filePath, $data);

        $actualData = $this->birthdayController->getWhoseBirthdayIsToday($this->filePath);

        $expectedData = ['Smith,Mark'];
        $this->assertEquals($expectedData, $actualData);
    }

    public function testWhenBirthdayIsYesterday()
    {
        $birthday = date_format(date_create("2000-02-29"), "Y/m/d");
        $data = '[["John", "Doe", "' . $birthday . '"]]';
        file_put_contents($this->filePath, $data);

        $expectedData = [];

        $actualData = $this->birthdayController->getWhoseBirthdayIsToday($this->filePath);

        $this->assertEquals($expectedData, $actualData);
    }

    public function testWhenBirthdayIsTomorrow()
    {
        $birthday = date('m/d', strtotime("+1 days"));
        $data = '[["John", "Doe", "1990/' . $birthday . '"]]';
        file_put_contents($this->filePath, $data);

        $expectedData = [];

        $actualData = $this->birthdayController->getWhoseBirthdayIsToday($this->filePath);

        $this->assertEquals($expectedData, $actualData);
    }

    public function testWhenBirthdayIsOnLeapDay()
    {
        $birthday = date_format(date_create("2000-02-29"), "Y/m/d");
        $data = '[["Aparna", "Saha", "' . $birthday . '"]]';
        file_put_contents($this->filePath, $data);

        $expectedData = [];

        $actualData = $this->birthdayController->getWhoseBirthdayIsToday($this->filePath);

        $this->assertEquals($expectedData, $actualData);
    }

}
