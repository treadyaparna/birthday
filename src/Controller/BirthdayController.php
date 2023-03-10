<?php

namespace Birthday\Controller;

require_once('./src/Service/JsonDataService.php');
require_once('./src/Service/DateService.php');
require_once('./src/Config/Config.php');

use Birthday\Service\DateService;
use Birthday\Service\JsonDataService;
use DateTime;
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

    /**
     * get list of user's names whose birthday is today
     *
     * @return array
     */
    public function getWhoseBirthdayIsToday($filePath): array
    {
        $birthdayPerson = [];
        try {
            $allData = $this->dataService->getData($filePath);

            foreach ($allData as $data) {

                /**
                 * If feasible, I would like to change the structure of the json in the input file
                 * Sample: [{"lastname": "Saha", "firstname": "Aparna", "birthday": "1982/10/08"}]
                 * This will improve the readability of the input data and eliminate guesswork.
                 *
                 * As of now, I proceed with the given JSON structure
                 * Here I assume that data[0] is the first name and data[1] is the last name
                 */

                $name = $this->getName($data[0], $data[1]);
                $birthday = $this->getBirthday($data[2]);

                $isTodayYourBirthday = $this->dateService->IsTodayUsersBirthday($birthday);

                if ($isTodayYourBirthday) {
                    $birthdayPerson[] = $name;
                }
            }
        } catch (Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
        }

        return $birthdayPerson;
    }

    /**
     * get full name from first and last name
     *
     * @param $firstName
     * @param $lastName
     * @return string
     */
    private function getName($firstName, $lastName): string
    {
        return $firstName . ',' . $lastName;
    }

    /**
     * get date of birthday
     *
     * @param $sDate
     * @return DateTime
     * @throws Exception
     */
    private function getBirthday($sDate): DateTime
    {
        return $this->dateService->getBirthday($sDate);
    }
}
