<title>Sistema de Control de Cajas - SEMOVI</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/semovi.ico'); ?>"/>
<script src="<?php echo base_url('assets/js/jquery_v3.min.js'); ?>"></script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet">



<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/login.js">

</script>
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
<!--<a class="navbar-brand" href="#">
    <img src="<?php echo base_url(); ?>assets/img/logoCDMX.png" style="width:100px; height:40px;" alt="">
  </a>
  <a class="navbar-brand" href="#">
    <img src="<?php echo base_url(); ?>assets/img/movilidad_derecha.png" style="width:100px; height:40px;" alt="">
  </a>
  <a class="navbar-brand" href="#">
    <img src="<?php echo base_url(); ?>assets/img/movilidad_central.png" style="width:100px; height:40px;" alt="">
  </a>

  <a class="navbar-brand" href="#">
    <img src="<?php echo base_url(); ?>assets/img/movilidad_izquierda.png" style="width:100px; height:40px;" alt="">
  </a>-->
</nav>

<!------ Include the above in your HEAD tag ---------->

<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">

    
        
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card">Control de Cajas</p>
            <form id='formLogin' name='formLogin' method="POST" class="form-signin" action="<?php echo base_url(); ?>index.php/Controlcajas/autentifica" >
                <span id="reauth-email" class="reauth-email"></span>
                <div class="form-group">
                    <input type="text" id="inputUsuario" name="inputUsuario" style="/*text-transform: uppercase*/" class="form-control" placeholder="Ingrese Usuario" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Ingrese Contraseña" required>
                </div>
                
               

                <!--<div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div> -->
                <?php
                    if(isset($mensaje)){

                        echo "<p id='profile-name' class='profile-name-card'><font color='red'>".$mensaje."</font></p>";
                    }
                ?>
                <button class="btn btn-success btn-block /*btn-signin*/" type="submit">Entrar</button>
               <!-- <button class="btn" type="submit">Entrar</button> -->
            </form><!-- /form -->
            <!-- <a href="#" class="forgot-password">
                Forgot the password?
            </a> -->
        </div><!-- /card-container -->

    </div><!-- /container -->
    <!-- Footer -->
    <footer class="footer fixed-bottom" style="background-color: #e0e0e0; padding-top: 10px; padding-bottom: 10px;
">
      <div class="container" style="text-align:center;">
        <span class="text-muted">Dirección General de Registro Público de Transporte - Subsecretaría de Transporte</span>
      </div>
    </footer>
<!-- Footer -->
