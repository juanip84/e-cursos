<!DOCTYPE HTML>
<html>
    <head>
	<title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="" />
        
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="<?= base_url();?>css/inicio/animate.css" rel="stylesheet">
        
        <noscript>
            <link rel="stylesheet" href="<?= base_url();?>css/inicio/skel-noscript.css" />
            <link rel="stylesheet" href="<?= base_url();?>css/inicio/style.css" />
            <link rel="stylesheet" href="<?= base_url();?>css/inicio/style-desktop.css" />
	</noscript>
        <script src="<?= base_url();?>js/inicio/skel.min.js"></script>
	<script src="<?= base_url();?>js/inicio/skel-panels.min.js"></script>
	<script src="<?= base_url();?>js/inicio/init.js"></script>
        <script src="<?= base_url();?>js/inicio/custom.js"></script>
        <script src="<?= base_url();?>js/jquery.scrollUp.min.js" ></script>
        <script src="<?= base_url();?>js/bootstrap.min.js" ></script>
        <script src="<?= base_url();?>js/inicio/animate.js"></script>
    </head>
    <body class="homepage">
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
                fjs.parentNode.insertBefore(js, fjs);
            }
            (document, 'script', 'facebook-jssdk'));
        </script>
        
	<!-- Header -->
	<div id="header">
            <div id="nav-wrapper"> 
		<!-- Nav -->
                <nav id="nav">
                    <div class="logoimage"><a href="<?php echo site_url('/application/index/'); ?>"><img src="<?= base_url();?>images/home/logo_chico.png" alt="" /></a></div>
                    <ul class="menu_principal">
			<li class="active"><a href="#ecursos">E-cursos</a></li>
                        <li><a href="#caracteristicas">Caracteristicas</a></li>
			<li><a href="#content">Vista</a></li>
			<li><a href="<?php echo site_url('/application/login/'); ?>">Ingresar</a></li>
                        <li><a href="http://www.e-cursos.com.ar/foro" target="_blank">Foro</a></li>
                        <li><a href="https://github.com/juanip84/e-cursos" target="_blank">Descargar</a></li>
                        <!--<li></li>
                        <li><div class="fb-like" data-href="https://www.facebook.com/ecursos.empresas/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div></li>-->
                    </ul>
		</nav>
            </div>
            <div class="container">
                <div id="like">
                    <div class="fb-like" data-href="https://www.facebook.com/ecursos.empresas/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" data-colorscheme="dark"></div>
                </div>
                <!-- Logo -->
                <!--<div id="logo">
                    <h1><a href="#">Bienvenidos a</a></h1>
                    <span class="tag">E-Cursos</span>
		</div>-->
            </div>
	</div>
	<!-- Featured -->
	<div id="featured">
            <div class="container">
                <div id="ecursos">
                    <header>
                        <h2>Que es E-Cursos?</h2>
                    </header>
                    <p>E-Cursos es una plataforma web para capacitación interna en empresas. Permite capacitar a sus empleados en forma rapida, dinámica y flexible, con seguimiento y evaluación de conocimientos adquiridos.</p>
		</div>
                <hr />
                <div id="caracteristicas">
                    <header>
                        <h2>Características</h2>
                    </header>
                    <div class="row">
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-desktop"></span></span>
                            <h3>Capacitación</h3>
                            <p>Subi cursos con descripción, video, audio y documentos.</p>
                            <!--<a href="#" class="button button-style1">Read More</a>-->
                        </section>
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-check-circle"></span></span>
                            <h3>Seguimiento</h3>
                            <p>Asigna quien debe hacer el curso y chequea quienes ya lo vieron.</p>
                            <!--<a href="#" class="button button-style1">Read More</a>-->
                        </section>
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-edit"></span></span>
                            <h3>Exámenes</h3>
                            <p>Valida los conocimientos adquiridos sobre un curso.</p>
                            <!--<a href="#" class="button button-style1">Read More</a>-->
                        </section>
                    </div>

                    <div class="row">    
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-user"></span></span>
                            <h3>Administración</h3>
                            <p>Administra tus categorias y quienes tienen acceso a ver/subir cursos.</p>
                            <!--<a href="#" class="button button-style1">Read More</a>-->
                        </section>
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-star"></span></span>
                            <h3>Favoritos</h3>
                            <p>Guarda los cursos que te interesan en favoritos.</p>
                            <!--<a href="#" class="button button-style1">Read More</a>-->
                        </section>
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-comments"></span></span>
                            <h3>Feedback</h3>
                            <p>Enviale un mensaje al autor de un curso.</p>
                            <!--<a href="#" class="button button-style1">Read More</a>-->
                        </section>
                    </div>
                    <div class="row">
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-thumbs-up"></span></span>
                            <h3>Optimización</h3>
                            <p>Optimiza los RRHH al no necesitar de capacitaciones presenciales.</p>
                            <!--<a href="#" class="button button-style1">Read More</a>-->
                        </section>
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-share-alt"></span></span>
                            <h3>Disponibilidad</h3>
                            <p>Tene acceso a los cursos en cualquier momento, desde cualquier lugar y dispositivo.</p>
                            <!--<a href="#" class="button button-style1">Read More</a>-->
                        </section>
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-floppy-o"></span></span>
                            <h3>Backup</h3>
                            <p>No pierdas más contenido, videos y audios de capacitaciones.</p>
                            <!--<a href="#" class="button button-style1">Read More</a>-->
                        </section>



                        <!--<section class="4u">
                            <span class="pennant"><span class="fa fa-briefcase"></span></span>
                            <h3>Maecenas luctus lectus</h3>
                            <p>Curabitur sit amet nulla. Nam in massa. Sed vel tellus. Curabitur sem urna, consequat vel, suscipit in, mattis placerat, nulla. Sed ac leo.</p>
                            <a href="#" class="button button-style1">Read More</a>
                        </section>
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-lock"></span></span>
                            <h3>Maecenas luctus lectus</h3>
                            <p>Donec ornare neque ac sem. Mauris aliquet. Aliquam sem leo, vulputate sed, convallis at, ultricies quis, justo. Donec magna.</p>
                            <a href="#" class="button button-style1">Read More</a>
                        </section>
                        <section class="4u">
                            <span class="pennant"><span class="fa fa-globe"></span></span>
                            <h3>Maecenas luctus lectus</h3>
                            <p>Curabitur sit amet nulla. Nam in massa. Sed vel tellus. Curabitur sem urna, consequat vel, suscipit in, mattis placerat, nulla. Sed ac leo.</p>
                            <a href="#" class="button button-style1">Read More</a>
                        </section>-->
                    </div>
                </div>
            </div>	
        </div>
	<!-- Main -->
	<div id="main">
            <div id="content" class="container">
                <div class="row">			
                    <section class="12u">
			<header>
                            <h2>Vista de la plataforma</h2>
			</header>
			<video src="<?= base_url();?>videos/presentacion.mov" width="640" height="360" autoplay loop controls></video>
                    </section>				
		</div>
		<!--<div class="row">
                    <section class="6u">
			<a href="#" class="image full"><img src="<?= base_url();?>images/inicio/pic01.jpg" alt=""></a>
			<header>
                            <h2>Mauris vulputate dolor</h2>
			</header>
			<p>In posuere eleifend odio. Quisque semper augue mattis wisi. Maecenas ligula. Pellentesque viverra vulputate enim. Aliquam erat volutpat. Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum.</p>
                    </section>				
                    <section class="6u">
			<a href="#" class="image full"><img src="<?= base_url();?>images/inicio/pic02.jpg" alt=""></a>
			<header>
                            <h2>Mauris vulputate dolor</h2>
			</header>
			<p>In posuere eleifend odio. Quisque semper augue mattis wisi. Maecenas ligula. Pellentesque viverra vulputate enim. Aliquam erat volutpat. Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum.</p>
                    </section>				
		</div>
		<div class="row">
                    <section class="6u">
			<a href="#" class="image full"><img src="<?= base_url();?>images/inicio/pic03.jpg" alt=""></a>
                        <header>
                            <h2>Mauris vulputate dolor</h2>
                        </header>
                        <p>In posuere eleifend odio. Quisque semper augue mattis wisi. Maecenas ligula. Pellentesque viverra vulputate enim. Aliquam erat volutpat. Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum.</p>
                    </section>				
                    <section class="6u">
			<a href="#" class="image full"><img src="<?= base_url();?>images/inicio/pic04.jpg" alt=""></a>
			<header>
                            <h2>Mauris vulputate dolor</h2>
			</header>
			<p>In posuere eleifend odio. Quisque semper augue mattis wisi. Maecenas ligula. Pellentesque viverra vulputate enim. Aliquam erat volutpat. Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum.</p>
                    </section>				
		</div>-->			
            </div>
	</div>
	<!-- Tweet -->
	<div id="tweet">
            <div class="container">
		<section>
                    <blockquote>&ldquo;E-Cursos nos permite tener nuestros cursos de capacitación y tutoriales siempre disponibles para nuestros empleados, ahorrandonos tiempo en capacitaciones y explicaciones&rdquo;, Higos & Brevas</blockquote>
		</section>
            </div>
	</div>
	<!-- Footer -->
	<div id="footer">
            <div class="container">
		<section>
                    <header>
			<h2>Contactate</h2>
			<span class="byline">info@e-cursos.com.ar</span>
                    </header>
                    <ul class="contact">
			<li><a href="#" class="fa fa-twitter"><span>Twitter</span></a></li>
			<li class="active"><a href="https://www.facebook.com/ecursos.empresas/" target="_blank" class="fa fa-facebook"><span>Facebook</span></a></li>
			<li><a href="https://www.linkedin.com/in/juan-ignacio-paz-498aaa32/" target="_blank" class="fa fa-linkedin"><span>Linkedin</span></a></li>
			<li><a href="#" class="fa fa-google-plus"><span>Google+</span></a></li>
                    </ul>
                    
                    <!-- begin olark code -->
                    <script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
                    f[z]=function(){
                    (a.s=a.s||[]).push(arguments)};var a=f[z]._={
                    },q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
                    f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
                    0:+new Date};a.P=function(u){
                    a.p[u]=new Date-a.p[0]};function s(){
                    a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
                    hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
                    return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
                    b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
                    b.contentWindow[g].open()}catch(w){
                    c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
                    var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
                    b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
                    loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
                    /* custom configuration goes here (www.olark.com/documentation) */
                    olark.identify('6821-770-10-5424');/*]]>*/</script><noscript><a href="https://www.olark.com/site/6821-770-10-5424/contact" title="Contactanos" target="_blank">Preguntas? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
                    <!-- end olark code -->
		</section>
            </div>
	</div>
	<!-- Copyright -->
	<div id="copyright">
            <div class="container">
		Diseño: <a href="http://www.e-cursos.com.ar/empresas-dev">E-Cursos</a> Template: <a href="http://templated.co">TEMPLATED</a>
            </div>
	</div>
    </body>
</html>