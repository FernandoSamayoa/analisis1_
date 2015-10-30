<?
require_once('index2.php');

class test extends PHPUnit_framework_TestCase{
    public function testname(){
	$hw=new index();
	$usuario="yo";
	$resultado=$hw->prueba2($usuario);
        $this->assertTrue($resultado);
    }
}
?>
