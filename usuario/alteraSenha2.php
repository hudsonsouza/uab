<?php 
    $campoFoco = 'nova_senha_';
?>

<br><br>
    <div class="titulo">ESQUECI MINHA SENHA</div>
<br>
<center>  

<?php
// RECEBE ID via GET
$id2=$_GET["id2"];

$id_pessoa=$_GET["id3"];
$acao=$_GET["acao"];

// VERIFICACAO 1 - CONFIRMA SENHA
if ($id_pessoa != null && $acao=="confirmaSenha"){
    // RECUPERA DADOS FORMULARIO
    $nova_senha=trim($_POST["nova_senha_"]);
    $confirma_senha=trim($_POST["confirma_senha_"]);
    
    // VERIFICA SE AS 2 NOVAS SENHAS SAO IGUAIS
        if(strcmp($nova_senha, $confirma_senha)==0){
            $nova_senhaMD5 = md5($nova_senha);  // criptografa a senha
            include("banco/conecta.php");
            mysql_query("update tb_pessoa set senha='$nova_senhaMD5' where tb_pessoa.id_pessoa='$id_pessoa'");
            mysql_query("commit");
            mysql_close();
            echo "<div class=msg><br>.:: Senha alterada com Sucesso ! ::.<br><br></div>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='2; URL=index.php?menu=home'>";	
            
        } else {
            echo "<div class=msgERRO><br>.:: Nova Senha INCORRETA ! ::.<br><br></div>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=index.php?menu=usuario/alteraSenha2&id2=$id_pessoa'>";    
        }
}           



// DADOS PESSOA
include("banco/conecta.php");
    $pessoas = mysql_query("select id_pessoa, nome, data_nasc, email from tb_pessoa where id_pessoa='$id2';"); 
    $dados=mysql_fetch_array($pessoas);
        $id_pessoa1=$dados["id_pessoa"]; 
        $nome=$dados["nome"];
        $data_nasc = formataData($dados["data_nasc"], "br");
        $email=$dados["email"]; 
?>

  <table width="600" border="0" class="corpoTab" cellspacing="5">
    <tr>
        <td width="120" align="right"><b>Nome...: </b></td>
        <td width="480"><?=$id_pessoa1?> - <?=$nome?></td>
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

<br>

<FORM name="upload" id="form1" METHOD="POST" ACTION="./" enctype="multipart/form-data">
  <table width="500" border="0" class="corpoTab">
    <tr>
      <tr>
        <td><div align="right">Nova Senha</div></td>
        <td><input type="password" name="nova_senha_" id="nova_senha_" size="20" /></td>
      </tr>
      <tr>
        <td><div align="right">Confirma Senha</div></td>
        <td><input type="password" name="confirma_senha_" size="20" /></td>
      </tr>
      <td colspan="2">
          <div align="center">
            <br><input type="submit" name="altera" value="Alterar" onclick="Acao('index.php?menu=usuario/alteraSenha2&id3=<?=$id_pessoa1?>&acao=confirmaSenha')"/>
          </div>
      </td>
    </tr>
</table>
</FORM>

<br><br>


<!-- === MASCARA PARA OS CAMPOS DOS FORMULARIOS === -->

<script type="text/javascript">
    //<![CDATA[

    var r = new Restrict("form1");  

    // r.field.data_nasc_ = "\\d/";
    // r.mask.data_nasc_ = "##/##/####";
    
    r.onKeyRefuse = function(o, k){
    o.style.backgroundColor = "#F0B7A4";
    }
    r.onKeyAccept = function(o, k){
    if(k > 30)
    o.style.backgroundColor = "#FFFFFF";
    }
    r.start();


    function Acao(act){
	frm = document.getElementById('form1');
	//frm.action = act + '.php';
	frm.action = act;
	frm.submit();
    }  
    
    function campoFoco() {
      document.getElementById("nova_senha_").focus(); 
    }    

    //]]>
</script>
