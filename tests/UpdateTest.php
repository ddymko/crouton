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
//
//    public function setUp()
//    {
//        parent::setUp();
//
//        if (!file_exists('/tmp/crouton')) {
//            $fh = fopen('/tmp/crouton', 'w') or die("Can't create file");
//            chmod('/tmp/crouton', 0777);
//            fwrite($fh, "#Crouton Cron Entry\n");
//        }
//
//        $this->update = new Update('/tmp/crouton');
//
//    }
//
//    public function testCheckIfExists()
//    {
//        $crouton = new Crouton();
//        $crouton->write('UpdateForUnit', '1,2,3,4', "12:34", "18:21", "/home/ddymko/desktop/test.php", '/tmp/crouton', 'php');
//
//        $update = new Update('/tmp/crouton');
//        $key = $update->checkIfExists('UpdateForUnit');
//
//        if(isset($key))
//        {
//            $this->assertTrue(true);
//        }
//        else{
//            $this->assertFalse(true);
//        }
//
//        $invalid = $update->checkIfExists('does_not_exist');
//
//        if($invalid)
//        {
//            $this->assertFalse(true);
//        }
//
//
//    }
//
//    public function testUpdate()
//    {
//        $update = new Update('/tmp/crouton');
//        $update->update('UpdateForUnit', '2,4,6', '14', '21', '/home/ddymko/test.php', 'ruby');
//
//        $cron_line = file('/tmp/crouton');
//        $this->assertTrue(in_array("5 14-21 * * 2,4,6 ruby /home/ddymko/test.php\n",$cron_line, false));
//    }
//
//    public function testRegexChecker()
//    {
//        $regex = [
//          'days' => '2,4,6',
//          'start_time' => '14',
//          'end_time' => '21',
//          'script_path' => '/home/ddymko/test.php',
//          'env' => 'ruby'
//        ];
//
//        $update = new Update('/tmp/crouton');
//        $updated = $update->regexChecker($regex,'5 12-18 * * 1,2,3,4 php /home/ddymko/desktop/test.php');
//
//        $this->assertEquals("2,4,6", $updated[4]);
//        $this->assertEquals("14-21", $updated[1]);
//        $this->assertEquals("ruby",  $updated[5]);
//        $this->assertEquals("/home/ddymko/test.php",  $updated[6]);
//
//    }
//
//    public function testCronCreator()
//    {
//        $cron = ['5','14-21', '*', '*', '2,4,6', 'ruby', '/home/ddymko/test.php'];
//
//        $update = new Update('/tmp/crouton');
//        $updated = $update->cronCreate($cron);
//
//        $this->assertEquals('5 14-21 * * 2,4,6 ruby /home/ddymko/test.php',$updated);
//
//    }
//
//    public function testUpdateWrite()
//    {
//        $update = new Update('/tmp/crouton');
//        $update->updateWrite('5 14-21 * * 2,4,6 sh /home/shell', 2);
//        $cron_line = file('/tmp/crouton');
//        $this->assertTrue(in_array("5 14-21 * * 2,4,6 sh /home/shell\n",$cron_line, false));
//
//    }
}
