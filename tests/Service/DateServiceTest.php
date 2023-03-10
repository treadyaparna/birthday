<?php

namespace Tests\Birthday\Service;

require_once("./src/Service/DateService.php");

use Birthday\Service\DateService;
use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;

class DateServiceTest extends TestCase
{
    private $dateService;

    function setUp(): void
    {
        parent::setUp();
        $this->dateService = new DateService();
    }

    function tearDown(): void
    {
        unset($this->dateService);
        parent::tearDown();
    }

    public function testIfTodayIsYourBirthday()
    {
        $date = new DateTime('now');
        $actualData = $this->dateService->IsTodayUsersBirthday($date);

        $this->assertEquals(true, $actualData);
    }

    public function testIfGivenDateIsPastDate()
    {
        $date = new DateTime('1990/01/01');
        $actualData = $this->dateService->IsTodayUsersBirthday($date);

        $this->assertEquals(false, $actualData);
    }

    /**
     * @throws Exception
     */
    public function testIfGivenBirthdayIsValidDate()
    {
        $validDate = '2050/01/01';

        $expectedDate = DateTime::createFromFormat(DATE_FORMAT_IN_JSON, '2050/01/01');
        $expectedDate->setTime(0, 0, 0);

        $actualData = $this->dateService->getBirthday($validDate);

        $this->assertEquals($expectedDate, $actualData);
    }

    /**
     * @throws Exception
     */
    public function testIfGivenBirthdayIsInvalidDate()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid date');

        $invalidDate = 'ABC';

        $expectedDate = DateTime::createFromFormat(DATE_FORMAT_IN_JSON, '2050/01/01');
        $expectedDate->setTime(0, 0, 0);

        $actualData = $this->dateService->getBirthday($invalidDate);

        $this->assertEquals($expectedDate, $actualData);
    }
}
