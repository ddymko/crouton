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
     * @description Driver function to update a single cron entry
     *
     * @param $name
     * @param null $days
     * @param null $start_time
     * @param null $end_time
     * @param null $script_path
     * @param null $env
     * @param null $arguments
     */
    public function update($name, $days = null, $start_time = null, $end_time = null, $script_path = null, $env = null, $arguments = null)
    {
        $key = $this->checkIfExists($name);

        $regex = [
          'days' => $days,
          'start_time' => $start_time,
          'end_time' => $end_time,
          'script_path' => $script_path,
          'env' => $env,
          'arguments' => $arguments
        ];

        $cron_line = file($this->path);
        $key_line = $key+1;

        $update_cron = $this->regexChecker($regex, $cron_line[$key_line]);

        $this->updateWrite($this->cronCreate($update_cron), $key_line);
    }

    /**
     *
     * @description Creates new cron data in an array
     *
     * @param $regex
     * @param $cron
     * @return array
     */
    public function regexChecker($regex, $cron)
    {

        $cron = explode(" ",$cron);

        if(isset($regex['start_time'])){
            $time = explode("-",$cron['1']);
            $time = $regex['start_time'] . "-" . $time['1'];
            $cron['1'] = $time;
        }

        if(isset($regex['end_time'])) {
            $time = explode("-",$cron['1']);
            $time = $time['0'] . "-" . $regex['end_time'];
            $cron['1'] = $time;
        }

        if(isset($regex['days'])) {
            $cron[4] = $regex['days'];
        }

        if(isset($regex['env'])) {
            $cron[5] = $regex['env'];
        }

        if(isset($regex['script_path'])) {
            $cron[6] = $regex['script_path'];
        }

        if(isset($regex['arguments'])) {
            $cron[7] = $regex['arguments'];
        }

        return $cron;
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

    /**
     *
     * @description Updates cron with new entries
     *
     * @param $update_cron
     * @param $key_line
     */
    public function updateWrite($update_cron, $key_line)
    {

        $data = file($this->path, FILE_IGNORE_NEW_LINES);
        $data[$key_line] = $update_cron;

        $f = fopen($this->path, 'w+');
        flock($f, LOCK_EX);
        foreach($data as $line) {
            fwrite($f, $line."\n");
        }
        flock($f, LOCK_UN);
    }

    /**
     *
     * Creates a readable string format of cron
     *
     * @param $cron
     * @return string
     */
    public function cronCreate($cron)
    {
        $final = "5 $cron[1] * * $cron[4] ";

        if(isset($cron[5]))
        {
            $final .= $cron[5] . " ";
        }

        if(isset($cron[6]))
        {
            $final .= $cron[6];
        }

        if(isset($cron[7]))
        {
            $final .= " " . $cron[7];
        }

        return $final;
    }
}