<?php

namespace Kaktus\Crouton\Crud;


class Delete
{
    private $path;

    /**
     * Delete constructor.
     * @param $cron_path
     */
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
     * @description Deletes an entry from the cron - This needs to be rewritten since it isnt the best
     * @param $deletion
     */
    public function delete($deletion)
    {
        $data = file($this->path);
        $out = array();

        $deletion = "#$deletion";

        foreach($data as $line) {
                $out[] = $line;
        }

        for($i = 0; $i < count($out); $i++)
        {
            if(trim($out[$i]) == $deletion)
            {
                $i++;
                continue;
            }
            $new[] = $out[$i];
        }

        $f = fopen($this->path, 'w+');
        flock($f, LOCK_EX);
        foreach($new as $line) {
            fwrite($f, $line);
        }
        flock($f, LOCK_UN);
        fclose($f);

    }


}