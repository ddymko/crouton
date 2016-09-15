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
    public function __construct()
    {
        // this is the default cron for crouton
        if(!file_exists('/etc/cron.d/crouton'))
        {
            try {
                $fh = fopen('/etc/cron.d/crouton', 'w');
                chmod('/etc/cron.d/crouton', 0777);
                fwrite($fh, "#Crouton Cron Entry\n");
            } catch (\Exception $e) {
                error_log($e);
            }
        }

    }

    /**
     *
     * @description Takes all data for cron and then sends it to be added in
     * @param $name
     * @param $days
     * @param $start_time
     * @param $end_time
     * @param $script_path
     * @param $cron_path
     * @param null $env
     * @param null $arguments
     */
    public function write($name, $days, $start_time, $end_time, $script_path, $cron_path = null, $env = null, $arguments = null)
    {
        $write = new Write($cron_path);
        $cron = $write->cron_creator($days, $start_time, $end_time, $script_path, $env, $arguments);
        $write->write("#$name\n". $cron . "\n");
    }

    /**
     * @description takes in the name you gave for your cron entry and deletes it
     * @param $cron_path
     * @param $entry_name
     */
    public function delete($cron_path, $entry_name)
    {
        $delete = new Delete($cron_path);
        $delete->delete($entry_name);
    }

    public function update($cron_path, $name, $days = null, $start_time = null, $end_time = null, $script_path = null, $env = null, $arguments = null)
    {
        $update = new Update($cron_path);
        $update->update($name, $days, $start_time, $end_time, $script_path, $env, $arguments);
    }

}