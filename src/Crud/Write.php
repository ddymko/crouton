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
        parent::__destruct();
    }


    /**
     * Takes in a string which is already assembled to be readable by the cron
     * and appends it to the existing etc/cron.d
     * @param $cron
     *
     */
    public function write($cron)
    {
        $this->getLogger()->info("writing $cron");
        try{
            fwrite($this->getHandle(), $cron);
        } catch (\Exception $e) {
            $this->getLogger()->critical("failed to write $cron");
            $this->getLogger()->critical("error message: $e");
            exit;
        }

    }

    /**
     *
     * @description takes in all data needed for a proper cron entry
     * and then creates an entry which will be used for the cron
     *
     * @param string $minute
     * @param string $hours
     * @param string $days_of_month
     * @param string $month
     * @param string $days
     * @param null $env
     * @param null $script_path
     * @param null $arguments
     *
     * @return string
     */
    public function cron_creator(
        $minute = '*',
        $hours = '*',
        $days_of_month = '*',
        $month = '*',
        $days = '*',
        $env = null,
        $script_path = null,
        $arguments = null
    ) {


        $cron = "$minute $hours $days_of_month $month $days ";


        if (!empty($env)) {
            $cron .= $env . " ";
        }


        if (!empty($script_path)) {
            $cron .= $script_path;
        }

        if (!empty($arguments)) {
            $cron .= " " . $arguments;
        }

        return $cron;
    }
}