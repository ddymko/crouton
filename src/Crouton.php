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
    public function update($name, $minute, $hours, $days_of_month, $month, $days, $env, $script_path, $arguments)
    {
        //todo this is a temp solution due to poor design with the update
        //todo so for now we just delete and update
        $delete = new Delete($this->getCronPath());
        $delete->delete($name);

        $write = new Write($this->getCronPath());
        $cron = $write->cron_creator($minute, $hours, $days_of_month, $month, $days, $env, $script_path, $arguments);
        $write->write("#$name\n" . $cron . "\n");

    }

}