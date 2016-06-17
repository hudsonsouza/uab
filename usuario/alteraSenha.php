<?php
    $id=$_GET["id"];
    session_start();
    if (!isset($_SESSION['s_login'])) {
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?menu=usuario/login'>";
    } elseif(($_SESSION["s_permissao"]==2) || ($_SESSION["s_permissao"]==3) || ($_SESSION["s_permissao"]==5) || ($_SESSION["s_permissao"]==7) || ($_SESSION["s_permissao"]==9) ){
?>


<br><br>
<div class="titulo">CADASTRO DE PESSOAS - ALTERA SENHA</div>
<br>
<center>

    
<?php
// RECEBE ID via GET
$id_pessoa = $_SESSION["s_idPessoa"];
//$id_autenticacao=$_GET["id_a"];
$acao=$_GET["acao"];
//$id=$_GET["id"];
//$id_pessoa=$_GET["id_p"];

// VERIFICACAO 1 - CONFIRMA SENHA
if ($id_pessoa != null && $acao=="confirmaSenha"){
    // RECUPERA DADOS FORMULARIO
    $senha_atual=trim($_POST["senha_atual_"]);
    $senha_atualMD5 = md5($senha_atual);
    $nova_senha=trim($_POST["nova_senha_"]);
    $confirma_senha=trim($_POST["confirma_senha_"]);
    
    // VERIFICA SENHA ATUAL
    include("banco/conecta.php");
    $autentica=mysql_query("select id_pessoa, senha from tb_pessoa where id_pessoa=$id and situacao='a'");
    $dadosAut=mysql_fetch_array($autentica);
    $id_pessoaAut=$dadosAut["id_pessoa"];
    $senha=$dadosAut["senha"];
    
    if(strcmp($senha, $senha_atualMD5)==0){
        
        // VERIFICA SE AS 2 NOVAS SENHAS SAO IGUAIS
        if(strcmp($nova_senha, $confirma_senha)==0){
            $nova_senhaMD5 = md5($nova_senha);  // criptografa a senha
            mysql_query("update tb_pessoa set senha='$nova_senhaMD5' where tb_pessoa.id_pessoa=$id_pessoaAut");
            mysql_query("commit");
            mysql_close();
            echo "<div class=msg><br>.:: Senha alterada com Sucesso ! ::.<br><br></div>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='2; URL=index.php?menu=home'>";	
        } else {
            echo "<div class=msgERRO><br>.:: Nova Senha INCORRETA ! ::.<br><br></div>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=index.php?menu=usuario/alteraSenha&id=$id_pessoaAut'>";    
        }
        
    } else {
            echo "<div class=msgERRO><br>.:: Senha Atual INCORRETA ! ::.<br><br></div>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=index.php?menu=usuario/alteraSenha&id=$id_pessoaAut'>";    
    }
    
}


// ===  FORMULARIO ===

if($acao=="esqueciSenha"){  ?>
  <FORM name="form2" id="form2" METHOD="POST" ACTION="./" enctype="multipart/form-data">
  <table width="500" border="0" class="corpoTab">
    <tr>
      <tr>
        <td><div align="right">E-mail</div></td>
        <td><input type="text" name="email_" class="minusculo" size="40" /></td>
      </tr>
      <td colspan="2">
          <div align="center">
            <br><input type="submit" name="altera" value="Alterar" onclick="Acao('index.php?menu=usuario/usu_altera_senha1&id_p=<?=$id_pessoa?>&acao=confirmaSenha')"/>
          </div>
      </td>
    </tr>
</table>
</FORM>
    
    
    
<?php } elseif($acao=="alteraSenha"){ ?>



<?php }

// DADOS PESSOA
include("banco/conecta.php");
$pessoas=mysql_query("select id_pessoa, nome, data_nasc, email from tb_pessoa where id_pessoa='$id';");
$dados=mysql_fetch_array($pessoas);
    $id_pessoa=$dados["id_pessoa"];
    $nome=$dados["nome"];
    $data_nasc = formataData($dados["data_nasc"], "br");
    $email=$dados["email"];
?>

  <table width="400" border="0" class="corpoTab" cellspacing="5">
    <tr>
        <td align="right"><b>Nome...: </b></td>
        <td><?=$id_pessoa?> - <?=$nome?></td>
    </tr>
    <tr>
        <td align="right"><b>Data Nasc...: </b></td>
        <td><?=$data_nasc?></td>
    </tr>
    <tr>
        <td align="right"><b>E-mail...: </b></td>
        <td><?=$email?></td>
    </tr>
  </table>

<br><br>


<FORM name="upload" id="form1" METHOD="POST" ACTION="./" enctype="multipart/form-data">
  <table width="500" border="0" class="corpoTab">
    <tr>
      <tr>
        <td><div align="right">Senha Atual</div></td>
        <td><input type="password" name="senha_atual_" size="20" /></td>
      </tr>
      <tr>
        <td><div align="right">Nova Senha</div></td>
        <td><input type="password" name="nova_senha_" size="20" /></td>
      </tr>
      <tr>
        <td><div align="right">Confirma Senha</div></td>
        <td><input type="password" name="confirma_senha_" size="20" /></td>
      </tr>
      <td colspan="2">
          <div align="center">
            <br><input type="submit" name="altera" value="Alterar" onclick="Acao('index.php?menu=usuario/alteraSenha&id=<?=$id_pessoa?>&acao=confirmaSenha')"/>
          </div>
      </td>
    </tr>
</table>
</FORM>

<br>


<br><br>



<script type="text/javascript">
    //<![CDATA[

    function Acao(act){
	frm = document.getElementById('form1');
	//frm.action = act + '.php';
	frm.action = act;
	frm.submit();
    }
    
    function Acao2(act){
    	frm2 = document.getElementById('form2');
    	//frm.action = act + '.php';
    	frm2.action = act;
    	frm2.submit();
    }    

    //]]>
</script>


<?php
	// fecha o ELSEIF ELSE
	} else {
                // SEGURANï¿½A - PEGA URL
                $server = $_SERVER['SERVER_NAME'];
                $uri = $_SERVER ['REQUEST_URI'];
                $segurancaURL = "http://" . $server . $uri; 
		//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=usuario/sair&segurancaURL=$segurancaURL'>";
	}
?>