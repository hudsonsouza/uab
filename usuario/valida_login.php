<?
/*
* NIVEL DE PERMISSAO
* ==================
* 1 - UAB (Cadastro)
* 2 - Acadêmico
* 3 - Tutor
* 5 - Secretária
* 7 - Coordenador
* 9 - T.I.
*/    
    session_start();

	$login= $_POST["login_"];
	$senha = $_POST["senha_"];
	$senha_MD5=md5("$senha");  // senha criptografada com MD5

    include("banco/conecta.php");
        // TABELA AUTENTICACAO
	$resultado=mysql_query("SELECT * FROM tb_pessoa WHERE login='$login' and senha='$senha_MD5'");
	$campo=mysql_fetch_array($resultado);  // recebe Array da tabela
		$id_pessoa_aut=$campo["id_pessoa"];
		$login2=$campo["login"];
		$permissao=$campo["permissao"];
		$situacao=$campo["situacao"];
	$nregistros=mysql_num_rows($resultado);	
	

       	
	if(!$login || !$login2 || !$senha) {
		$_SESSION["s_permissao"] = 0;
                $acesso = 1;
                $observacao = "ACESSO RESTRITO ERRO: login ou senha vazio";
                $permissao = 0;
                //controleAcesso($id_pessoa_aut, $nome, $apelido, $login, $permissao, $fone_cel, $email, $acesso, $observacao);
                echo "<center><br><br><br><br>";
		echo "Caro <b>Visitante</b>, esta área é restrita, digite seu <b>login</b> e <b>senha</b><br><br>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='2; URL=index.php?menu=usuario/login'>";
                echo "<br><br><br><br><center>";
	} 

        
    if($nregistros==1) {
          
        
        // TABELA PESSOA
        $resultado=mysql_query("SELECT * FROM tb_pessoa WHERE id_pessoa='$id_pessoa_aut'");
	$campos=mysql_fetch_array($resultado);  // recebe Array da tabela
		$id_pessoa=$campos["id_pessoa"];
		$nome=$campos["nome"];
                $email=$campos["email"];
		$fone=$campos["fone"];                
        
 
        // 1-UAB 
        if ($permissao==1 && $situacao=='a') {
		$_SESSION["s_idPessoa"] = $id_pessoa_aut;
		$_SESSION['s_login'] = $login2;	// passa 'login' para Session
		$_SESSION["s_nome"] = $nome;
                $_SESSION['s_permissao'] = 1;	// passa 'nivel' para Session
                $_SESSION['s_situacao'] = 'a';  // passa 'situacao' para Session
                $_SESSION["s_email"] = $email;
		$_SESSION["s_fone"] = $fone;
                // $acesso = 1;
                // $observacao = "ACADÊMICO";
                //controleAcesso($id_pessoa_aut, $nome, $login2, $permissao, $fone, $email);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=home'>";
                
                
        // 2-ACADÊMICO   
        } else if ($permissao==2 && $situacao=='a') {
		$_SESSION["s_idPessoa"] = $id_pessoa_aut;
		$_SESSION['s_login'] = $login2;	// passa 'login' para Session
		$_SESSION["s_nome"] = $nome;
                $_SESSION['s_permissao'] = 2;	// passa 'nivel' para Session
                $_SESSION['s_situacao'] = 'a';  // passa 'situacao' para Session
                $_SESSION["s_email"] = $email;
		$_SESSION["s_fone"] = $fone;
                // $acesso = 1;
                // $observacao = "ACADÊMICO";
                //controleAcesso($id_pessoa_aut, $nome, $login2, $permissao, $fone, $email);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=home'>";
                
                
        // 3-TUTOR        
	} else if ($permissao==3 && $situacao=='a') {
		$_SESSION["s_idPessoa"] = $id_pessoa_aut;
		$_SESSION['s_login'] = $login2;	// passa 'login' para Session
		$_SESSION["s_nome"] = $nome;
                $_SESSION['s_permissao'] = 3;	// passa 'nivel' para Session
                $_SESSION['s_situacao'] = 'a';  // passa 'situacao' para Session
                $_SESSION["s_email"] = $email;
		$_SESSION["s_fone"] = $fone;
                // $acesso = 2;
                // $observacao = "TUTOR";
                //controleAcesso($id_pessoa_aut, $nome, $login2, $permissao, $fone, $email);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=home'>";
                 
                
        // 5-SECRETARIA        
	} else if ($permissao==5 && $situacao=='a') {
		$_SESSION["s_idPessoa"] = $id_pessoa_aut;
		$_SESSION['s_login'] = $login2;	// passa 'login' para Session
		$_SESSION["s_nome"] = $nome;
                $_SESSION['s_permissao'] = 5;	// passa 'nivel' para Session
                $_SESSION['s_situacao'] = 'a';  // passa 'situacao' para Session
                $_SESSION["s_email"] = $email;
		$_SESSION["s_fone"] = $fone;
                // $acesso = 5;
                // $observacao = "SECRETARIA";
                //controleAcesso($id_pessoa_aut, $nome, $login2, $permissao, $fone, $email);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=home'>";
                
                
        // 7-COORDENADORA        
	} else if ($permissao==7 && $situacao=='a') {
		$_SESSION["s_idPessoa"] = $id_pessoa_aut;
		$_SESSION['s_login'] = $login2;	// passa 'login' para Session
		$_SESSION["s_nome"] = $nome;
                $_SESSION['s_permissao'] = 7;	// passa 'nivel' para Session
                $_SESSION['s_situacao'] = 'a';  // passa 'situacao' para Session
                $_SESSION["s_email"] = $email;
		$_SESSION["s_fone"] = $fone;
                // $acesso = 5;
                // $observacao = "COORDENADORA";
                //controleAcesso($id_pessoa_aut, $nome, $login2, $permissao, $fone, $email);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=home'>";
               
                
        // 9-T.I.        
	} else if ($permissao==9 && $situacao=='a') {
		$_SESSION["s_idPessoa"] = $id_pessoa_aut;
		$_SESSION['s_login'] = $login2;	// passa 'login' para Session
		$_SESSION["s_nome"] = $nome;
                $_SESSION['s_permissao'] = 9;	// passa 'nivel' para Session
                $_SESSION['s_situacao'] = 'a';  // passa 'situacao' para Session
                $_SESSION["s_email"] = $email;
		$_SESSION["s_fone"] = $fone;
                // $acesso = 5;
                // $observacao = "T.I.";
                //controleAcesso($id_pessoa_aut, $nome, $login2, $permissao, $fone, $email);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=home'>";
                     
                
        // USUARIO INATIVO        
	} else if ($situacao=='i') {
                $acesso = 8;
                $observacao = "USUÁRIO BLOQUEADO: inativo";
                //controleAcesso($id_pessoa_aut, $nome, $apelido, $login2, $permissao, $fone_cel, $email, $acesso, $observacao);
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=home'>";
                echo "<br><br><br><br><br><br><br>";
                
                
        // USUARIO COMUM - NAO CADASTRADO        
	} else {
		$_SESSION["s_permissao"] = 0;
                echo "<center><br><br><br><br>";
		echo "Caro <b> ".$login."</b>, esta Área é restrita, digite seu <b>login</b> e <b>senha</b><br><br>";
                //$acesso = 9;
                //$observacao = "ACESSO RESTRITO ERRO: login/senha";
                $permissao = 0;
                //controleAcesso($id_pessoa_aut, $nome, $apelido, $login, $permissao, $fone_cel, $email, $acesso, $observacao);
                echo "<meta HTTP-EQUIV='refresh' CONTENT='2; URL=index.php?menu=usuario/login'>";
                echo "<br><br><br><br><center>";            
        }
        
    }
        
        // CONTROLE DE ACESSO
        // function controleAcesso($id_pessoa_aut, $nome, $apelido, $login, $permissao, $fone_cel, $email, $acesso, $observacao){
        //    $data_atual = data_aaaammdd_hms();
        //    $ip_cliente = $_SERVER['REMOTE_ADDR'];
        //    include("banco/conecta.php");
        //    mysql_query("INSERT INTO tb_controle_acesso (id_controle_acesso , data , ip_cliente , id_pessoa , nome , apelido , login , permissao , fone_cel, email, tipo_acesso, observacao ) VALUES (null, '$data_atual', '$ip_cliente', '$id_pessoa_aut', '$nome', '$apelido', '$login', '$permissao', '$fone_cel', '$email', '$tipo_acesso', '$observacao' )");
        //    mysql_query("commit");
        //    //return;
        // }
	
       
?>
