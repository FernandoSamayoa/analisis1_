<?php
require_once('index2.php');

class test extends PHPUnit_framework_TestCase{
    public function testname(){
	$ruta="localhost/workspace/index.php?parametro='valor'";
	$hw=new index();
	$parametro="valor";
	$resultado=$hw->informacion($parametro);
        $this->assertTrue($resultado==$parametro);
    }

    public function testname2(){
	$hw=new index();
	$usuario="yo";
	$resultado=$hw->prueba2($usuario);
        $this->assertTrue($resultado);
    }
}
?>
