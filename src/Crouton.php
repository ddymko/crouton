<?php

namespace Kaktus\Crouton;
use Kaktus\Crouton\Crud\Write;

/**
 * Class Crouton
 * @package Kaktus\Crouton
 */
class Crouton
{
    public function __construct()
    {
        // this is the default cron for crouton
        if(!file_exists('/etc/cron.d/crouton'))
        {
            $fh = fopen('/etc/cron.d/crouton', 'w') or die("Can't create file");
            chmod('/etc/cron.d/crouton', 0777);
            fwrite($fh, "#Crouton Cron Entry\n");
        }

    }

    /**
     *
     * @description Takes all data for cron and then sends it to be added in
     * @param $days
     * @param $start_time
     * @param $end_time
     * @param $script_path
     * @param $cron_path
     * @param null $env
     * @param null $arguments
     */
    public function write($days, $start_time, $end_time, $script_path, $cron_path = null, $env = null, $arguments = null)
    {
        $write = new Write($cron_path);
        $cron = $write->cron_creator($days, $start_time, $end_time, $script_path);
        $write->write($cron . "\n");
    }

}