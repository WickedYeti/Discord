<?php

namespace Discord\Debug\Logger;

use Discord\Debug\Error\DirectoryNotFound;
use Psr\Log\AbstractLogger;

class DailyFile extends AbstractLogger
{

    /** @var resource */
    protected $file;


    /**
     * Setup directory
     * @param string $directory
     * @throws DirectoryNotFound
     */
    public function __construct($directory)
    {
        // create directory
        $directory = rtrim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        if(!is_dir($directory)) {
            throw new DirectoryNotFound('Directory "' . $directory . '" not found.');
        }

        // open file
        $filename = php_sapi_name() . '-' . date('Y-m-d') . '.txt';
        $this->file = fopen($directory . $filename, 'a+');
    }


    /**
     * Logs with an arbitrary level
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = [])
    {
        $log = new Log($level, $message);
        fwrite($this->file, (string)$log . "\n");
    }


    /**
     * Close current log file
     */
    public function __destruct()
    {
        if($this->file) {
            fclose($this->file);
        }
    }

} 