<?php

namespace Birthday\Controller;

require_once('./src/Service/JsonDataService.php');
require_once('./src/Service/DateService.php');

use Birthday\Service\JsonDataService;
use Birthday\Service\DateService;
use Exception;


class BirthdayController
{
    /**
     * @var JsonDataService
     */
    private JsonDataService $dataService;

    /**
     * @var DateService
     */
    private DateService $dateService;

    public function __construct()
    {
        $this->dataService = new JsonDataService();
        $this->dateService = new DateService();
    }

    public function getWhosBirthdayIsToday()
    {
        $birthdayPerson = [];

        try {
            $allData = $this->dataService->getData();
            foreach ($allData as $data) {

                // assume that [0] = first name, [1] = last name, [2] = birthday

                $name = $this->getName($data[0], $data[1]);
                $birthday = $this->getBirthday($data[2]);

                $isTodayBirthday = $this->dateService->isGivenDateIsToday($birthday);
                if ($isTodayBirthday) {
                    $birthdayPerson[] = $name;
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }


        return $birthdayPerson;
    }

    private function getName($firstName, $lastName)
    {
        return $firstName . ',' . $lastName;
    }

    private function getBirthday($sDate)
    {
        return $this->dateService->getBirthday($sDate);
    }
}
