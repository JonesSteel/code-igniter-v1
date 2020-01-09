<title>Sistema de Control de Cajas | Registro</title>

<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/semovi.ico'); ?>"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet">

<nav class="navbar navbar-light bg-light" style="border-bottom: 2px solid #068e06; padding: 0.2rem 1rem;">
    <a class="navbar-brand">
        <img src="<?php echo base_url(); ?>assets/img/logoCDMX.png" style="width:250px; height:70px;" alt="">
    </a>
    <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
        <li class="nav-item">
            <a class="navbar-brand">
                <img src="<?php echo base_url(); ?>assets/img/movilidad_derecha.png" style="width:160px; height:49px;" alt="">
            </a>
        </li>
        <li class="nav-item">
            <a class="navbar-brand">
                <img src="<?php echo base_url(); ?>assets/img/movilidad_central.png" style="width:160px; height:48px;" alt="">
            </a>
        </li>
        <li class="nav-item">
            <a class="navbar-brand">
                <img src="<?php echo base_url(); ?>assets/img/movilidad_izquierda.png" style="width:160px; height:48px;" alt="">
            </a>
        </li>
    </ul>
</nav>
<div class="container">
    <div class="card card-container">
        <p id="profile-name" class="profile-name-card">Registro</p>
        <br />
        <form id="formUsuario" name="formUsuario" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/Usuarios/agregaUsuario">
            <div class="form-group">
                <input type="text" name="rfc" id="rfc" style="text-transform: uppercase" class="form-control input-sm" placeholder="RFC" required autofocus>
            </div>
            <div class="form-group">
                <input type="text" name="nombre" id="nombre" style="text-transform: uppercase" class="form-control input-sm" placeholder="Nombre" required autofocus>
            </div>
            <div class="form-group">
                <input type="text" name="primer_apellido" id="primer_apellido" style="text-transform: uppercase" class="form-control input-sm" placeholder="Apellido Paterno" required autofocus>
            </div>
            <div class="form-group">
                <input type="text" name="segundo_apellido" id="segundo_apellido" style="text-transform: uppercase" class="form-control input-sm" placeholder="Apellido Materno">
            </div>
            <div class="form-group">
                <select class="form-control input-sm" id="atributo" name="atributo">
                    <option value="" selected="true">Seleccione</option>
                    <option value='1'>CAPTURISTA</option>
                    <option value='2'>ADMINISTRADOR</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control input-sm" id="id_modulo" name="id_modulo">
                    <option value="" selected="true">Seleccione</option>
                    <?php
                        foreach ($modulos as $modulo) {
                            echo "<option value='".$modulo['id_modulo']."'>".$modulo['nombre_modulo']."</option>";
                        }
                    ?>
                </select>
            </div>
            <input type="hidden" name="id_sistema" id='id_sistema' value='99'>
            <div class="form-group">
                <input type="password" id="password" name="password" class="form-control input-sm" placeholder="Password" required>
            </div>
            <div class="form-group"´>
                <input type="password" id="password_repite" name="password_repite" class="form-control input-sm" placeholder="Password otra vez" required>
            </div>

            <?php
            if(isset($mensaje)){
                echo "<center><span class='label label-warning'>".$mensaje."</span></center>";
            }
            if(isset($mensajeError)){
                echo "<center><span class='label label-warning'>".$mensajeError."</span></center>";
            }
            ?>
            <button class="btn btn-success btn-block /*btn-signin*/" type="button" onclick = 'validaDatos();'>Agregar Usuario</button>
        </form>
    </div>
</div>
<footer class="footer fixed-bottom" style="background-color: #e0e0e0; padding-top: 10px; padding-bottom: 10px;">
    <div class="container" style="text-align:center;">
        <span class="text-muted">Dirección General de Registro Público de Transporte - Subsecretaría de Transporte</span>
    </div>
</footer>
<script>
	function validaDatos(){
		var rfc = document.getElementById("rfc").value;
		var nombre = document.getElementById("nombre").value;
		var primer_apellido = document.getElementById("primer_apellido").value;
		var segundo_apellido = document.getElementById("segundo_apellido").value;
		var atributo = document.getElementById("atributo").value;
		var modulo = document.getElementById("id_modulo").value;
		var sistema = document.getElementById("id_sistema").value;
		var password = document.getElementById("password").value;
		var password_repite = document.getElementById("password_repite").value;

		if(password != password_repite){
			alert("Los password no son iguales");
			return false;
		}else{

			if(rfc != '' && nombre != '' && primer_apellido != '' && password != '' && password_repite != '' && atributo != '' && modulo != '' && sistema != ''){
				document.getElementById("formUsuario").submit();
			}else{
				
				if(rfc == ''){
					alert('Ingrese el RFC');
					document.getElementById("rfc").focus();
					return false;
				}
				if(nombre == ''){
					alert('Ingrese el nombre');
					document.getElementById("nombre").focus();
					return false;
				}
				if(primer_apellido == ''){
					alert('Ingrese el primer apellido');
					document.getElementById("primer_apellido").focus();
					return false;
				}

				if(atributo == ''){
					alert('Seleccione el atributo');					
					return false;
				}
				if(modulo == ''){
					alert('Seleccione el modulo');
					return false;
				}
				if(sistema == ''){
					alert('Seleccione el sistema');
					return false;
				}			
				if(password == ''){
					alert('Ingrese el Password');
					document.getElementById("password").focus();
					return false;
				}
				if(password_repite == ''){
					alert('Repita el password');
					document.getElementById("password_repite").focus();
					return false;
				}
			}
		}
		
	}
</script>