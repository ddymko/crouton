<?php
/**
 * Created by PhpStorm.
 * User: Dymko
 * Date: 9/3/16
 * Time: 4:37 PM
 */

namespace Kaktus\Crouton\Crud;


class Update
{
    private $cron_path;

    public function __construct($cron_path)
    {
        if(empty($cron_path))
        {
            $this->path = '/etc/cron.d/crouton';
        }
        elseif(!file_exists($cron_path))
        {
            return false;
        }
        $this->path = $cron_path;

        $this->handle = fopen($this->path,'a');
    }

    /**
     *
     * @description Checks to see if the entry exists within the cron file
     *
     * @param $name
     * @return bool|mixed
     */
    public function checkIfExists($name)
    {
        $data = file($this->path, FILE_IGNORE_NEW_LINES);
        $key = array_search("#$name", $data);

        if ($key)
        {
           return $key;
        }
        return false;

    }
}