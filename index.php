<?php

namespace Birthday;

require_once('./src/Config/Config.php');
require_once('./src/Controller/BirthdayController.php');

use Birthday\Controller\BirthdayController;

$birthdayPerson = new BirthdayController();

$data = $birthdayPerson->getWhoseBirthdayIsToday(JSON_DATA_FILE_PATH);

if ($data) {
    echo implode('<br />', $data);
} else {
    echo "No one born today! ;)";

}
