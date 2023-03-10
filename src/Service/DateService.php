<?php

namespace Birthday\Service;

use DateTime;
use Exception;

class DateService
{
    /**
     * check if given date is today or not
     *
     * @param $birthday
     * @return bool
     */
    public function IsTodayUsersBirthday($birthday): bool
    {
        return $birthday->format('m-d') == date('m-d');
    }

    /**
     * validate birthday and process the date if leap year
     *
     * @param $sDate
     * @return DateTime
     * @throws Exception
     */
    public function getBirthday($sDate): DateTime
    {
        $date = $this->isDateValid($sDate);

        // if current year is leap year
        $isLeapYear = $this->isLeapYear();
        if ($isLeapYear) {
            if ($date->format('m') == '02' && (int)$date->format('d') == 29) {
                $date->modify('-1 day');
            }
        }

        return $date;
    }

    /**
     * check if given string date is valid date based on standard date format
     *
     * @param $sDate
     * @return DateTime
     * @throws Exception
     */
    private function isDateValid($sDate): DateTime
    {
        $date = DateTime::createFromFormat(DATE_FORMAT_IN_JSON, $sDate);
        if ($date === false) {
            throw new Exception('Invalid date');
        }

        $date->setTime(0, 0, 0);
        return $date;
    }

    /**
     * check if current year is leap year
     *
     * @return bool
     */
    private function isLeapYear(): bool
    {
        return (bool)date('L', time());
    }
}
