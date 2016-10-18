<?php

namespace Kaktus\Crouton\Crud;

class Write extends Crud
{

    /**
     * Write constructor.
     * @param $cron_path
     */
    public function __construct($cron_path)
    {
        parent::__construct($cron_path);
    }


    /**
     * destructor function
     */
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

        if(!empty($arguments))
        {
            $cron .= " " . $arguments;
        }

        return $cron;
    }
}