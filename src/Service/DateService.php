<?php

namespace Birthday\Service;

use DateTime;
use Exception;

class DateService
{
    /**
     * current datetime with time set to midnight
     * 
     * @var DateTime
     */
    private DateTime $today;

    public function __construct()
    {
        $this->today = new DateTime("today");
    }

    private function isLeapYear()
    {
        return date('L', time()) ? true : false;
    }

    public function isGivenDateIsToday($birthday)
    {
        $diffDays = (int) $this->today->diff($birthday)->format("%a");

        return $diffDays === 0 ? true : false;
    }

    private function isDateValid($sDate, $format = 'Y/m/d')
    {
        $date = DateTime::createFromFormat($format, $sDate);

        if ($date === false) {
            throw new Exception('Invalid date.');
        }

        return $date;
    }

    public function getBirthday($sDate)
    {
        $date = $this->isDateValid($sDate);

        if ($date) {
            // if current year is leap year
            $isLeapYear = $this->isLeapYear();
            if (!$isLeapYear) {
                if ($date->format('m') == '02' && (int) $date->format('d') < 28) {
                    $date->modify('-1 day');
                }
            }
        }

        return $date;
    }
}
