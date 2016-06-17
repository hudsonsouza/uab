<?php 
    $campoFoco = 'data_nasc';
?>

<br><br>
    <div class="titulo">ESQUECI MINHA SENHA</div>
<br>
<center>
<?php
$acao=$_GET["acao"];

//// COMPARA 2 STRING
//$email1="Hudsonss@gmail.com";
//$email2="hudsonss@gmail.com";
//if(strcmp($email1, $email2)==0)  // COMPARA 2 STRING SAO IGUAIS == 0
//        echo "<br>String iguais";
//else
//        echo "<br>String diferentes";


//// COMPARAR 2 DATAS
//$data1 = '2013-05-21';
//$data2 = '2013-05-22';
//if(strtotime($data1) > strtotime($data2))
//    echo 'A data 1 é maior que a data 2.';
//elseif(strtotime($data1) == strtotime($data2))
//    echo 'A data 1 é igual a data 2.';
//if(strtotime($data1) < strtotime($data2))
//    echo 'A data 1 é menor que a data 2.';




if($acao=="dataEmail"){
    // RECEBE DADOS DO FORMULARIO
    $data_nasc = formataData(converteData(trim(strtolower($_POST["data_nasc_"]))),"usa");
    $email = trim(strtolower($_POST["email_"]));

    if(!empty($data_nasc) && !empty($email)){ 
        include("banco/conecta.php");
        $pessoas = mysql_query("SELECT id_pessoa, data_nasc, email FROM tb_pessoa WHERE email='$email';");
        $ndados=mysql_num_rows($pessoas);   
        $dados=mysql_fetch_array($pessoas);
            $id_pessoa2=$dados["id_pessoa"]; 
            $data_nasc2=$dados["data_nasc"]; 
            $email2=$dados["email"]; 
            

            
        if( ($ndados==1) && (strcmp($email, $email2)==0) && (strtotime($data_nasc)==strtotime($data_nasc2)) ) {  // COMPARA: 2 STRING e 2 DATAS
        
            // REDIRECIONA JA COM USUARIO IDENTIFICADO PARA ALTERACAO
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?menu=usuario/alteraSenha2&id2=$id_pessoa2'>";	
            
        } else {
            echo "<div class=msgERRO><br>.:: Dados de Data Nasc. ou Email incorretos! ::.<br><br></div>";
        }
        
    } else {
       echo "<div class=msgERRO><br>.:: Obrigatório o preenchimento de todos os campos! ::.<br><br></div>"; 
    }    
    
}


?>


<br>
<!-- <FORM name="form1" id="form1" METHOD=POST ACTION="index.php?menu=usuario/alteraSenha&acao=dataEmail"> -->
<FORM name="form1" id="form1" METHOD=POST ACTION="index.php?menu=usuario/esqueciSenha&acao=dataEmail">
  <table width="450" border="0" class="corpoTab">
  <tr>
    <td><div align="right"><b>Data Nasc: </b></div></td>
    <td><input type="text" id="data_nasc_" name="data_nasc_" class="minusculo" maxlength="40" size="15"/> <span class="legenda-form">dd/mm/aaaa</span> </td>
  </tr>
  <tr>
    <td><div align="right"><b>E-mail: </b></div></td>
    <td><input type="text" name="email_" class="minusculo" maxlength="40" size="40"/> <span class="legenda-form">*</span> </td>
  </tr> 
  <tr>
    <td colspan="2"><div align="center">
      <br><input name="submit" type="submit" value=".:: OK ::." />
    </div></td>
    </tr>
</table>
</FORM>

</center>

<br><br>


<!-- === MASCARA PARA OS CAMPOS DOS FORMULARIOS === -->

<script type="text/javascript">
    //<![CDATA[

    var r = new Restrict("form1");  

    r.field.data_nasc_ = "\\d/";
    r.mask.data_nasc_ = "##/##/####";
    
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
      document.getElementById("data_nasc_").focus(); 
    }    

    //]]>
</script>
