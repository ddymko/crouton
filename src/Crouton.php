<?php

namespace kaktus\Crouton;
use kaktus\Crouton\crud\write;

/**
 * Class Crouton
 * @package Kaktus\Crouton
 */
class Crouton
{
    public function __construct()
    {

    }

    /**
     *
     * @description Takes all data for cron and then sends it to be added in
     * @param $days
     * @param $start_time
     * @param $end_time
     * @param $script_path
     * @param null $env
     * @param null $arguments
     */
    public function write($days, $start_time, $end_time, $script_path, $env = null, $arguments = null)
    {

        $write = new Write('/etc/cron.d/crouton');
        $cron = $write->cron_creator($days, $start_time, $end_time, $script_path);
        $write->write($cron . "\n");
    }

}