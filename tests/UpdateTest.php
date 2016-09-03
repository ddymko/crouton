<?php
/**
 * Created by PhpStorm.
 * User: Dymko
 * Date: 9/3/16
 * Time: 4:43 PM
 */

namespace Kaktus\Tests;

use Kaktus\Crouton\Crouton;
use Kaktus\Crouton\Crud\Update;

class UpdateTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();

        if (!file_exists('/tmp/crouton')) {
            $fh = fopen('/tmp/crouton', 'w') or die("Can't create file");
            chmod('/tmp/crouton', 0777);
            fwrite($fh, "#Crouton Cron Entry\n");
        }

        $this->update = new Update('/tmp/crouton');

    }

    public function testCheckIfExists()
    {
        $crouton = new Crouton();
        $crouton->write('UpdateForUnit', '1,2,3,4', "12:34", "18:21", "/home/ddymko/desktop/test.php", '/tmp/crouton');

        $update = new Update('/tmp/crouton');
        $key = $update->checkIfExists('UpdateForUnit');

        if(isset($key))
        {
            $this->assertTrue(true);
        }
        else{
            $this->assertFalse(true);
        }

        $invalid = $update->checkIfExists('does_not_exist');

        if($invalid)
        {
            $this->assertFalse(true);
        }


    }

}
