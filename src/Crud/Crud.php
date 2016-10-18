<?php

namespace Kaktus\Crouton\Crud;

class Crud
{

  protected $path;
  protected $handle;

  public function __construct($cron_path)
  {
      if(!file_exists($cron_path))
      {
          throw new \Exception($cron_path . " does not exist");
      }
      $this->path = $cron_path;
      $this->handle =  fopen($this->path, 'a');

  }
}