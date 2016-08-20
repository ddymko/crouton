<?php
/**
 * Created by PhpStorm.
 * User: Dymko
 * Date: 8/17/16
 * Time: 8:09 PM
 */

namespace kaktus\Tests;

use kaktus\Crouton\Crouton;

class CroutonTest extends \PHPUnit_Framework_TestCase
{
    public function testWrite()
    {

        $bab = new Crouton();
        $bab->write('1', "12:34", "18:21", "/Users/Dymko/Desktop/test.txt");
        $cron = $bab->cron_creator('1', "12:34", "18:21", "/Users/Dymko/Desktop/test.txt");

        $handle = fopen('/Users/Dymko/Desktop/test.txt','r');
        $data = fread($handle,filesize('/Users/Dymko/Desktop/test.txt'));

        $cron = preg_replace('/\*/', '\*', $cron);
        $cron = preg_replace('/\//', '\/', $cron);
        $cron = "/$cron/";

        $this->assertRegExp($cron, $data);

    }

    public function testCronCreator()
    {
        $crouton = new Crouton();
        $cron_test = $crouton->cron_creator('1,4,5,7', "02:34", "12:12", "/Users/Dymko/Desktop/test.txt");
        $cron_test = preg_replace('/\*/', '\*', $cron_test);
        $cron_test = preg_replace('/\//', '\/', $cron_test);
        $cron_test = "/$cron_test/";

        $this->assertRegExp($cron_test, '5 02-12 * * 1,4,5,7 /Users/Dymko/Desktop/test.txt');


        $cron_test = $crouton->cron_creator('1,4,5,7', "02:34", "12:12", "/Users/Dymko/Desktop/test.txt", "php");
        $cron_test = preg_replace('/\*/', '\*', $cron_test);
        $cron_test = preg_replace('/\//', '\/', $cron_test);
        $cron_test = "/$cron_test/";

        $this->assertRegExp($cron_test, '5 02-12 * * 1,4,5,7 php /Users/Dymko/Desktop/test.txt');

    }
}