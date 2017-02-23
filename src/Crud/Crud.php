<?php

namespace Kaktus\Crouton\Crud;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Crud
{

    private $path;
    private $handle;
    private $logger;


    /**
     * Crud constructor.
     *
     * @param $cron_path
     *
     * @throws \Exception
     */
    public function __construct($cron_path)
    {

        $this->setLogger(new Logger('crouton'));
        $this->getLogger()->pushHandler(new StreamHandler(__DIR__.'/../../log/my_app.log', Logger::DEBUG));


        $this->setPath($cron_path);

        if (!file_exists($this->getPath())) {
            $this->getLogger()->critical("$cron_path does not exist");
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

    /**
     * @return mixed
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param mixed $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}