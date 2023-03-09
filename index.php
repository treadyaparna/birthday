<?php

namespace Birthday;

require_once('./src/Config/Config.php');
require_once('./src/Controller/BirthdayController.php');

use Birthday\Controller\BirthdayController;

$birthdayPerson = new BirthdayController();

echo "<pre>";
var_dump($birthdayPerson->getWhosBirthdayIsToday());
