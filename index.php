<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; true">
        <title>Polo UAB Paranavaí</title>        
        <link rel="stylesheet" type="text/css" href="estilo/estilo1.css"> 
        <link rel="shortcut icon" href="img_int/uab-ico.png"/>
        <script type="text/javascript" src="biblioteca/jquery/jquery-1-10-2.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
        <script type="text/javascript" src="js/menuJS.js"></script>
        <script type="text/javascript" src="js/menuHorizontal.js"></script>
    </head>

    <body onload="horizontal();">

    <div id="geral">
	
        <?php // include('funcao.php'); ?>
        
	<div id="cabecalho">
		<?php include('cabecalho.php'); ?>
	</div>
	

	<div id="menu">
		<?php include('menu.php'); ?>
	</div>
	
        
        <div id="rodape-cima"></div>
        
        
	<div id="corpo">
		<?php include('corpo.php'); ?>	
	</div>
	
        
        <div id="rodape-cima"></div>
        
        
        <div id="rodape">
		<?php include('rodape.php'); ?>
	</div>

    </div>
    </body>
</html>