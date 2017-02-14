<?php

namespace Kaktus\Crouton\Crud;


class Delete extends Crud
{

    /**
     * Delete constructor.
     * @param $cron_path
     */
    public function __construct($cron_path)
    {
        parent::__construct($cron_path);
    }

    /**
     * @description Deletes an entry from the cron
     * @param $entry_name
     */
    public function delete($entry_name)
    {

        try {
            $out = file($this->getPath(), FILE_IGNORE_NEW_LINES);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }


        $new = array();
        $deletion = "#$entry_name";

        try {
            for ($i = 0; $i < count($out); $i++) {
                if (trim($out[$i]) == $deletion) {
                    $i++;
                    continue;
                }
                $new[] = $out[$i] . PHP_EOL;
            }

            $f = fopen($this->getPath(), 'w+');
            flock($f, LOCK_EX);
            foreach ($new as $line) {
                fwrite($f, $line);
            }
            flock($f, LOCK_UN);
            fclose($f);

        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }

    }


}