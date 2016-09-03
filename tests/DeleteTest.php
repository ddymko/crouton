<?php
/**
 * Created by PhpStorm.
 * User: Dymko
 * Date: 9/2/16
 * Time: 7:06 PM
 */

namespace Kaktus\Tests;

use Kaktus\Crouton\Crouton;
use Kaktus\Crouton\Crud\Delete;

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
        $crouton = new Crouton();
        $crouton->write('TestForDelete', '1,2,3,4', "12:34", "18:21", "/home/ddymko/desktop/test.php", '/tmp/crouton');

        $delete = new Delete('/tmp/crouton');
        $delete->delete('TestForDelete');

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
