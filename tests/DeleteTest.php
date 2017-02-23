<?php
/**
 * Created by PhpStorm.
 * User: Dymko
 * Date: 9/2/16
 * Time: 7:06 PM
 */

namespace Kaktus\Tests;

use Kaktus\Crouton\Crouton;

class Test extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();

        if(!file_exists('/tmp/crouton'))
        {
            $fh = fopen('/tmp/crouton', 'w') or die("Can't create file");
            chmod('/tmp/crouton', 0777);
            fwrite($fh, "#Crouton Cron Entry\n");
        }

    }

    public function testDelete()
    {
        $crouton = new Crouton('/tmp/crouton');
        $crouton->write('TestForDelete1', '5', '5-12', '*', '*', '5,6,7', 'ruby', '/home/ruby/test', null);
        $crouton->write('SpareDeleteTesting3', '5', '5-12', '*', '*', '5,6,7', 'ruby', '/home/ruby/test', null);
        $crouton->write('SpareDeleteTesting4', '5', '5-12', '*', '*', '5,6,7', 'ruby', '/home/ruby/test', null);

        $crouton->delete('TestForDelete1');


        $data = file('/tmp/crouton');

        foreach($data as $line) {
            if(trim("#TestForDelete") == $line)
            {
                $this->assertFalse(true);
            }
            else
            {
                $this->assertTrue(true);
            }

        }
    }
}
