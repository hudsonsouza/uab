<?php
    session_start();
    if (!isset($_SESSION['s_login'])) {
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?menu=usuario/login'>";
    } elseif( ($_SESSION['s_permissao']==1) || ($_SESSION['s_permissao']==2) || ($_SESSION['s_permissao']==3) || ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==7) || ($_SESSION['s_permissao']==9) ){
?>


<? if( ($_SESSION['s_permissao']>=1) && ($_SESSION['s_permissao']<=9) ){ ?>

   <li class="menuvertical"><a href="#">Cadastro</a>
      <ul id="nav" class="menu">
      <? if( ($_SESSION['s_permissao']>=1) && ($_SESSION['s_permissao']<=9) ){  // UAB ?>   
        <li class="submenu"><a href='index.php?menu=cadastro/pessoa' alt="Pessoa" title="Pessoa">Pessoas</a></li> 
            <? if( ($_SESSION['s_permissao']>=3) && ($_SESSION['s_permissao']<=9) ){ // ACADEMICO, TUTOR, SECRETARIA, COORDENADOR, T.I. ?>
              <li class="submenu"><a href='index.php?menu=noticia/noticia_form&barra=barraFormatacao' alt="Notícias" title="Notícias">Notícias</a></li> 
            <? } ?>
      <? } ?>
      </ul>
   </li>

<? } ?> 
   
  
   
   
<?
	// fecha o ELSEIF ELSE
	} else {
                // SEGURANCA - PEGA URL
                $server = $_SERVER['SERVER_NAME'];
                $uri = $_SERVER ['REQUEST_URI'];
                $segurancaURL = "http://" . $server . $uri; 
		//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=usuario/sair&segurancaURL=$segurancaURL'>";
	}
?>
 
