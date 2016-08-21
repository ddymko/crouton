<?php

namespace kaktus\Crouton;


class FileSystem
{
    private $handle;
    public function __construct()
    {
        $this->handle = fopen('/tmp/test.txt','a');
    }

    public function __destruct()
    {
        fclose($this->handle);
    }

    /**
     * Takes in a string which is already assembled to be readable by the cron
     * and appends it to the existing etc/cron.d
     * @param $cron
     *
     */
    public function write($cron)
    {
        fwrite($this->handle, $cron);
    }

}