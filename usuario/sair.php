<?
	session_start();
  	if (!isset($_SESSION['s_login'])) {
		header("Location: index.php?menu=usuario/login");
	} elseif( ($_SESSION['s_permissao']==1) || ($_SESSION['s_permissao']==2) || ($_SESSION['s_permissao']==3)  || ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==7) || ($_SESSION['s_permissao']==9) ){
?>

<?
        $acao=$_GET["acao"];
        $pes = $_SESSION['s_idPessoa'];
	$nom = $_SESSION['s_nome'];
	$log = $_SESSION['s_login'];
	$per = $_SESSION['s_permissao'];
        $fon = $_SESSION["s_fone"];
        $ema = $_SESSION["s_email"];
        
        if($acao=="saindo"){
            // USUARIO CLICOU NO BOTAO 'sair'
            $acesso = 10;
            $observacao = "DESCONECTADO: sair";
            //controleAcesso($pes, $nom, $ape, $log, $per, $fon, $ema, $acesso, $observacao);
        } elseif($acao == "fimProva"){
            // USUARIO DESCONECTADO 'fim de prova'
            $segurancaURL=$_GET["segurancaURL"];  // RECUPERA URL BURLADA 
            $id_prova_agenda=$_GET["id_prova_agenda"];  // RECUPERA id_prova_agenda
            $ip_cliente = $_SERVER['REMOTE_ADDR'];  // RECUPERA IP DO CLIENTE
            include("banco/conecta.php");
            $sql_prova_agenda2=mysql_query("select resp_email, descricao from tb_prova_agenda where id_prova_agenda='$id_prova_agenda';");
            $dados1=mysql_fetch_array($sql_prova_agenda2);
            $resp_email=$dados1["resp_email"]; 
            $descricao=$dados1["descricao"]; 
            include("usuario/sairEmailFimProva.php"); // ENVIA E-MAIL AO SUPORTE TECNICO
            include("usuario/sairEmailFimProvaProfessor.php"); // ENVIA E-MAIL AO SUPORTE TECNICO
            $acesso = 12;
            $observacao = "DESCONECTADO: fim de prova - <br> URL: $segurancaURL";
            //controleAcesso($pes, $nom, $ape, $log, $per, $fon, $ema, $acesso, $observacao);
        } else {
            // USUARIO TENTANDO BURLAR O SISTEMA
            $segurancaURL=$_GET["segurancaURL"];  // RECUPERA URL BURLADA 
            $ip_cliente = $_SERVER['REMOTE_ADDR'];
            include("usuario/sairEmail.php"); // ENVIA E-MAIL AO SUPORTE TECNICO
            $acesso = 11;
            $observacao = "DESCONECTADO: url burlada - <br> URL: $segurancaURL";
            //controleAcesso($pes, $nom, $ape, $log, $per, $fon, $ema, $acesso, $observacao);
        }

        
        // ANULA VARIAVEL
        $pes = NULL;
	$nom = NULL;
	$log = NULL;
	$per = NULL;
        $fon = NULL;
        $ema = NULL;
        
	// anula os dados da sessao
	unset($_SESSION['s_idPessoa']);
	unset($_SESSION['s_nome']);
	unset($_SESSION['s_login']);
	unset($_SESSION['s_permissao']);
        unset($_SESSION['s_situacao']);

        
	// destroi sessoes
	session_destroy();

        
        // encaminha para pagina index.php
	echo "<center><div class=msg><br><br><br><br>.:: SESSÃO ENCERRADA ::.<br><br><br><br></div></center>";
	echo "<meta HTTP-EQUIV='refresh' CONTENT='2; URL=index.php?menu=home'>";	
?>

<?
	// fecha o ELSEIF ELSE
	} else {
                // SEGURANÇA - PEGA URL
                $server = $_SERVER['SERVER_NAME'];
                $uri = $_SERVER ['REQUEST_URI'];
                $segurancaURL = "http://" . $server . $uri; 
		//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=usuario/sair&segurancaURL=$segurancaURL'>";
	}
?>