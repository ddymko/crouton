<?php

namespace Kaktus\Crouton;

use Kaktus\Crouton\Crud\Write;
use Kaktus\Crouton\Crud\Delete;
use Kaktus\Crouton\Crud\Update;

/**
 * Class Crouton
 * @package Kaktus\Crouton
 */
class Crouton
{

    private $cron_path;

    public function __construct($path = '/etc/cron.d/crouton')
    {

        $this->setCronPath($path);

        // this is the default cron for crouton
        if (!file_exists($this->getCronPath())) {
            try {
                $fh = fopen($this->getCronPath(), 'w');
                chmod($this->getCronPath(), 0777);
                fwrite($fh, "#Crouton Cron Entry\n");
            } catch (\Exception $e) {
                error_log($e);
            }
        }

    }

    /**
     * @return mixed
     */
    public function getCronPath()
    {
        return $this->cron_path;
    }

    /**
     * @param mixed $cron_path
     */
    public function setCronPath($cron_path)
    {
        $this->cron_path = $cron_path;
    }


    /**
     * @param $name
     * @param $minute
     * @param $hours
     * @param $days_of_month
     * @param $month
     * @param $days
     * @param $env
     * @param $script_path
     * @param $arguments
     */

    public function write($name, $minute, $hours, $days_of_month, $month, $days, $env, $script_path, $arguments)
    {

        $write = new Write($this->getCronPath());
        $cron = $write->cron_creator($minute, $hours, $days_of_month, $month, $days, $env, $script_path, $arguments);
        $write->write("#$name\n" . $cron . "\n");
    }

    /**
     * @description takes in the name you gave for your cron entry and deletes it
     * @param $name
     */
    public function delete($name)
    {
        $delete = new Delete($this->getCronPath());
        $delete->delete($name);
    }

    /**
     *
     * @description takes in name of a cron entry and updates accordingly
     * @param $cron_path
     * @param $name
     * @param null $days
     * @param null $start_time
     * @param null $end_time
     * @param null $script_path
     * @param null $env
     * @param null $arguments
     */
    public function update($cron_path, $name, $days = null, $start_time = null, $end_time = null, $script_path = null, $env = null, $arguments = null)
    {
        $update = new Update($cron_path);
        $update->update($name, $days, $start_time, $end_time, $script_path, $env, $arguments);
    }

}