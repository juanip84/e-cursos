<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title; ?></title>
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/demo.css" rel="stylesheet">-->
    
    <link href="<?= base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url();?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url();?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= base_url();?>css/price-range.css" rel="stylesheet">
    <link href="<?= base_url();?>css/animate.css" rel="stylesheet">
    <link href="<?= base_url();?>css/responsive.css" rel="stylesheet">
    <link href="<?= base_url();?>css/main.css" rel="stylesheet">
    <link href="<?= base_url();?>css/demo.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?= base_url();?>images/ico/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/price-range.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.scrollUp.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.prettyPhoto.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/main.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/datos_usuario.js" ></script>
        
</head><!--/head-->
<body style="height: 100%;">	
<!--popups-->
<!-- Modal generic-->
<div id="wrap"><!-- agregado para footer-->
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
		<div class="row">
                    <div class="col-sm-4">
			<div class="contactinfo">
                            <ul class="nav nav-pills">
				<!--<li><a href="#"><i class="fa fa-phone"></i> </a></li>-->
				<li><a href="#"><i class="fa fa-envelope"></i> info@e-cursos.com.ar</a></li>
                            </ul>
			</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="contactinfo" align="center">
                            <ul class="nav">
                                <?php
                                if (isset($this->session->userdata['usuario'])) {
                                    echo '<li><a href="#"><strong>Usuario: '.$this->session->userdata['usuario'].'</strong></a></li>';
                                }
                                ?>
                            </ul>
			</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
				<li><a href="https://www.facebook.com/ecursos.empresas/"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
			</div>
                    </div>
		</div>
            </div>
	</div><!--/header_top-->
		
	<div class="header-middle"><!--header-middle-->
            <div class="container">
		<div class="row">
                    <div class="col-sm-2">
			<div class="logo pull-left">
                            <a href="<?php echo site_url('/application/index/'); ?>"><img src="<?= base_url();?>images/home/logo.png" alt="" /></a>
			</div>
                    </div>
                    <div class="col-sm-10">
			<div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
				<li><a href="<?php echo site_url('/application/cuenta/'); ?>"><i class="fa fa-user"></i> Cuenta</a></li>
				<li><a href="<?php echo site_url('/application/cursos_inscriptos/0'); ?>"><i class="fa fa-star"></i> Favoritos</a></li>
				<li><a href="<?php echo site_url('/application/cursos_asignados/0'); ?>"><i class="fa fa-buysellads"></i> Asignaciones</a></li>
                                <li><a href="<?php echo site_url('/application/mis_cursos/0'); ?>"><i class="fa fa-file-text-o"></i> Mis cursos</a></li>
                                <li><a <?php if ($new_notifications>0) echo 'id="a_yellow"'; ?> href="<?php echo site_url('/application/notificaciones/0'); ?>"><i class="fa fa-inbox"></i> Notificaciones</a></li>
                                <?php if ($this->session->userdata("id")>0) { 
                                    if ($this->session->userdata("perfil")==1) {
				?>
                                        <li><a href="<?php echo site_url('/application/administracion/'); ?>"><i class="fa fa-tasks"></i> Administracion</a></li>
                                <?php 
                                    }
				?>
                                    <li><a href="<?php echo site_url('/application/logout/'); ?>"><i class="fa fa-lock"></i> Cerrar sesion</a></li>
                                <?php } else { ?>
                                    <li><a href="<?php echo site_url('/application/login/'); ?>"><i class="fa fa-lock"></i> Ingresar</a></li>
                                <?php } ?>
                            </ul>
			</div>
                    </div>
		</div>

            </div>
	</div><!--/header-middle-->
	
    </header><!--/header-->
    <div id="main">
        <div class="modal fade" id="generic_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-big">
                    <div class="modal-header modal-header-background">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title text-brown" id='generic_modal_title'>Title</h4>
                    </div>  
                    <div id="generic_modal_body" style="padding: 30px;">
                    </div>
                </div>
            </div>
        </div><!-- / Modal generic-->
        
    <br>