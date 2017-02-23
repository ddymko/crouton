<?php

namespace Kaktus\Crouton\Crud;

class Crud
{

    private $path;
    private $handle;

    /**
     * Crud constructor.
     *
     * @param $cron_path
     *
     * @throws \Exception
     */
    public function __construct($cron_path)
    {
        $this->setPath($cron_path);

        if (!file_exists($this->getPath())) {
            throw new \Exception($cron_path . " does not exist");
        }

        $this->setHandle(fopen($this->getPath(), 'a'));

    }

    /**
     * Crud destructor
     *
     */
    public function __destruct()
    {
        fclose($this->getHandle());
    }


    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return resource
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param resource $handle
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }
}