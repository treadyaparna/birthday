<?php

namespace Birthday\Service;

use Exception;

class JsonDataService
{
    public function getData()
    {
        // check if file exists
        $this->isFileExists();

        // get data
        $data = file_get_contents(DATAPATH);

        // check if content exists
        $this->isContentExists();


        $data = json_decode($data);

        // valid json
        $this->isJsonValid();

        return $data;
    }

    private function isFileExists()
    {
        if (!file_exists(DATAPATH)) {
            throw new Exception('File not found.');
        }
    }

    private function isContentExists()
    {
        if (isset($data) && empty($data)) {
            throw new Exception('No data.');
        }
    }

    private function isJsonValid()
    {
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid data.');
        }
    }
}
