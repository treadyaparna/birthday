<?php

namespace Tests\Service;

require_once("./src/Service/DateService.php");

use DateTime;
use DateInterval;
use PHPUnit\Framework\TestCase;
use Birthday\Service\DateService;

class DateServiceTest extends TestCase
{
    public function testIsGivenDateIsTodaySuccess()
    {
        $date = new DateTime('now');
        $expectedData = true;

        $dateService = new DateService();
        $actualData = $dateService->isGivenDateIsToday($date);

        $this->assertEquals($expectedData, $actualData);
    }

    public function testIsGivenDateIsTodayWithPastDate()
    {
        $date = new DateTime('2023/01/01');
        $expectedData = false;

        $dateService = new DateService();
        $actualData = $dateService->isGivenDateIsToday($date);

        $this->assertEquals($expectedData, $actualData);
    }

    public function testIsGivenDateIsTodayWithYesterday()
    {
        $date = new DateTime();
        $date->add(DateInterval::createFromDateString('yesterday'));
        $expectedData = false;

        $dateService = new DateService();
        $actualData = $dateService->isGivenDateIsToday($date);

        $this->assertEquals($expectedData, $actualData);
    }

    public function testIsGivenDateIsTodayWithFutureDate()
    {
        $date = new DateTime('2050/01/01');
        $expectedData = false;

        $dateService = new DateService();
        $actualData = $dateService->isGivenDateIsToday($date);

        $this->assertEquals($expectedData, $actualData);
    }

}
