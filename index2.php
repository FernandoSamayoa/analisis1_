<?php
    //ASOCIACION DE USUARIOS
    if(isset($_POST["in_padre"])){
        $padre=$_POST["in_padre"];
        $hijo=$_POST["in_hijo"];
        //console.log("padre . $padre.");
        //console.log("hijo ".$hijo);
        //falta asociarlos
        if($padre===$hijo){
            echo "<div class=\"alert alert-warning\"><strong>Error!</strong> No se puede asociar el mismo usuario!.</div>";
        }else{
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "analisis1", "3306");
            $result = mysqli_query($connection, 
            "insert into asociaciones(id_padre,id_hijo) values ($padre,$hijo);") or die("Query fail: " . mysqli_error());
            if(!result){
                echo "<div class=\"alert alert-warning\"><strong>Error!</strong> Posiblemente ya existe esta asociacion!.</div>";    
            }else{
                echo "<div class=\"alert alert-success\"><strong>Exito!</strong> Asociacion exitosa!.</div>";
            }
        }
    }
	$parametro="valor";
    //RESGISTRAR USUARIO
    if(isset($_POST["nombre"])){
                
        $nombre=$_POST["nombre"];
        $direccion=$_POST["direccion"];
        $email=$_POST["email"];
        $telefono=$_POST["telefono"];
        $fecha_nacimiento=$_POST["fecha_nacimiento"]." 00:00:00";
        $pass=$_POST["pass"];
        $pass2=$_POST["pass2"];
        $fecha_hoy=date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (el formato DATETIME de MySQL);
        if($pass2!=$pass){
            echo "<div class=\"alert alert-warning\"><strong>Error!</strong> No coinciden las contraseñas!.</div>";
        }else{
            $bandera=0;
            //connect to database
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "analisis1", "3306");
            //verificar si existe usuario
            $result = mysqli_query($connection, 
                "select * from socios where nombre=\"$nombre\"") or die("Query fail: " . mysqli_error());
            while ($row = mysqli_fetch_array($result)){ 
                    echo "<div class=\"alert alert-warning\"><strong>Error!</strong> Correo ya registrado!.</div>";
                    $bandera=1;
                    break;
            }
            if($bandera==0){
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "analisis1", "3306");
                //run the store proc
                //pnombre, pcorreo, ptelefono, prol, ppassword
                //echo "CALL usuario_alta('$nombre','$email',$telefono,'normal',0,'$pass')";
                $result = mysqli_query($connection,"insert into socios (nombre,telefono,email,fecha_nacimiento,direccion,fecha_inicio) values ('$nombre',$telefono,'$email','$fecha_nacimiento','$direccion','$fecha_hoy');");
                //loop the result set
                
                if (!$result) {
                    echo "<div class=\"alert alert-warning\"><strong>Error!</strong> Asociación ya existent!.</div>";
                }else{
                    echo "<div class=\"alert alert-success\"><strong>Exito!</strong> Registro exitoso!.</div>";
                }
            }
        }
    }
?>

<?php

class index
{
	function informacion($string)
	{
	return $string;
	}

	function prueba2($parametro)
	{
		if($parametro!=="")
		{
			return true;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SCREEN-JUNKIES</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top"  onclick = $("#menu-close").click(); >SCREEN-JUNKIES</a>
            </li>
            <li>
                <a href="#top" onclick = $("#menu-close").click(); >Home</a>
            </li>
            <li>
                <a href="#about" onclick = $("#menu-close").click(); >Registrarte</a>
            </li>
            <li>
                <a href="#services" onclick = $("#menu-close").click(); >Asociar Usuarios</a>
            </li>
        </ul>
    </nav>
    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1>SCREEN-JUNKIES</h1>
            <h3>Tu opción en videos</h3>
            <br>
            <a href="#about" class="btn btn-dark btn-lg">Registrate</a>
        </div>
    </header>
    <!-- About -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center">
		<form class="form-signin" method="post">
		        <h2 class="form-signin-heading">Registrate!</h2>
		        Nombre: <input type="text"  name="nombre" placeholder="Bilbo Bolson" class="form-control"  required>
		        Dirección: <input type="text" name="direccion" class="form-control" placeholder="3ra colina, La comarca" required>
		        Correo: <input type="email" name="email" class="form-control" placeholder="smaug@robamos_oro.com" required>
		        Telefono: <input type="number" name="telefono" class="form-control" placeholder="77778888" required>
		        Fecha nacimiento: <input type="date" name="fecha_nacimiento" class="form-control" required>
		        Password: <input type="password" id="pass" name="pass" class="form-control" placeholder="gema_del_arca" required>
		        Confirma Password: <input type="password" id="pass2"name="pass2" class="form-control" placeholder="gema_del_arca" required>
		        <br><button class="btn btn-lg btn-primary btn-block" type="submit" >Registrarme</button>          
		</form>
                </div>
		<div class="col-lg-6 text-center">
<br><br><br><br><br>
              		<img class="img-portfolio img-responsive" src="img/bg2.jpg">
		</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Services -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
</body>

</html>
