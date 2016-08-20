<?php

namespace kaktus\Crouton;

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
        $cron = $this->cron_creator($days, $start_time, $end_time, $script_path);
        $write = new FileSystem();
        $write->write($cron . "\n");
    }

    /**
     *
     * @description takes in all data needed for a proper cron entry
     * and then creates an entry which will be used for the cron
     *
     * @param $days
     * @param $start_time
     * @param $end_time
     * @param $script_path
     * @param null $env
     * @param null $arguments
     * @return string
     */
    public function cron_creator($days, $start_time, $end_time, $script_path, $env = null, $arguments = null)
    {

        $arr_start = explode(':',$start_time);
        $arr_end = explode(':',$end_time);
        $cron = "5 $arr_start[0]-$arr_end[0] * * $days ";

        if(!empty($env))
        {
            $cron .= $env . " ";
        }

        if(!empty($script_path))
        {
            $cron .= $script_path;
        }

        return $cron;
    }
}