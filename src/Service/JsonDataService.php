<?php

namespace Birthday\Service;

use Exception;

class JsonDataService
{
    /**
     * fetch data from data file
     *
     * @param $filePath
     * @return mixed
     * @throws Exception
     */
    public function getData($filePath)
    {
        $this->isFileExists($filePath); // check if file exists
        $data = file_get_contents($filePath); // get data
        $this->isFileEmpty($data); // check if content exists

        return $this->isJsonValid($data); // valid json
    }

    /**
     * check if file exists
     *
     * @param $filePath
     * @return void
     * @throws Exception
     */
    private function isFileExists($filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception('File not found.');
        }
    }

    /**
     * check if file is empty
     *
     * @param $data
     * @return void
     * @throws Exception
     */
    private function isFileEmpty($data)
    {
        if (isset($data) && empty($data)) {
            throw new Exception('No data.');
        }
    }

    /**
     * check if file content is a valid json
     *
     * @param $data
     * @return mixed
     * @throws Exception
     */
    private function isJsonValid($data)
    {
        $data = json_decode($data);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid data.');
        }

        return $data;
    }
}
