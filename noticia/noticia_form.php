<?php
    $id=$_GET["id"];
    $campoFoco = 'data_';
    session_start();
    if (!isset($_SESSION['s_login'])) {
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?menu=usuario/login'>";
    } elseif(($_SESSION['s_permissao']==3)  || ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==7) || ($_SESSION['s_permissao']==9) ){        
?>

<br><br>
    <div class="titulo">NOTÍCIAS</div>
<br>

<center>

<?php
$id=$_GET["id"];
$acao=$_GET["acao"];
$barra="";
$barra1=trim($_POST["barra"]); 
if(!empty($barra1)){
        $barra = $barra1;
}

$barra2=$_GET["barra"];
if(!empty($barra2)){
    $barra = $barra2;
}

if($id != null){
    include("noticia/noticiaRecuperaDB.php");
}

?>

    
<?php // ========= ACOES =============     
    
if($id==null && $acao==null){
    echo "NOVA NOTÍCIA<br><br>";
    
} else if ($id==null && $acao=="insere"){    
    $novoCadastro=TRUE;
    include("noticia/noticiaRecuperaForm.php");
    
    //if(!empty($data) && !empty($autor) && !empty($titulo) && !empty($texto) && !empty($destaque) && !empty($situacao) ){
    if(!empty($data) && !empty($autor) && !empty($titulo) ){
        //include("noticia/noticiaRecuperaForm.php");
        include("banco/conecta.php");
        mysql_query("INSERT INTO tb_noticia (id_noticia, data, autor, titulo, texto, destaque, situacao ) VALUES ( NULL, '$data', '$autor', '$titulo', '$texto', '$destaque', 'a' )");
        mysql_query("commit");
        mysql_close();
        $novoCadastro=FALSE;
        echo "<div class=msg><br>.:: Notícia cadastrada com Sucesso ! ::.<br><br></div>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='2; URL=index.php?menu=noticia/noticia_form&barra=barraFormatacao'>";  
                    
    } else {
        // MSG DE CAMPOS OBRIGATORIOS
        echo "<div class=msgERRO><br>.:: Preencha todos os campos, obrigatóriamente! ::.<br><br></div>";                        
    }    
    
} else if ($id!=null && $acao=="altera"){   
    include("noticia/noticiaRecuperaForm.php"); 
    include("banco/conecta.php");
    mysql_query("update tb_noticia set data='$data', autor='$autor', titulo='$titulo', texto='$texto', destaque='$destaque', situacao='$situacao' where tb_noticia.id_noticia='$id_noticia' limit 1") or die(mysql_error());
    mysql_query("commit");
    mysql_close();
    echo "<div class=msg><br>.:: Notícia alterada com sucesso ! ::.<br><br></div>";
    echo "<meta HTTP-EQUIV='refresh' CONTENT='2; URL=index.php?menu=noticia/noticia_lista&acao=ativo'>";	
    
    
} else if ($id!=null && $acao=="exclui"){  
    include("banco/conecta.php");
    mysql_query("update tb_noticia set situacao='i' where tb_noticia.id_noticia='$id_noticia' limit 1;");
    mysql_query("commit");
    mysql_close();
    echo "<div class=msg><br>.:: Notícia excluida com sucesso ! ::.<br><br></div>";
    echo "<meta HTTP-EQUIV='refresh' CONTENT='2; URL=index.php?menu=noticia/noticia_lista&acao=ativo'>";
    
}

?>    
    
    
<?php // ========= FORMULARIO ============= 


if($novoCadastro==TRUE){
    include_once 'cadastro/pessoaRecuperaForm.php';
    $data = formataData(converteData(trim(strtolower($_POST["data_"]))),"br");
} 

?>    
   
<FORM id="form1" METHOD="POST" ACTION="./">
<table width="930" border="0" cellspacing="5" class="corpoTab">
    <?php if($id != NULL){ ?>
    <tr>
        <td width="200"><div align="right"><b>Código: </b></div></td>
        <td width="730"><input type="text" name="id_noticia_" id="id_noticia_" class="minusculo" value="<?=($id_noticia==null)?"":$id_noticia?>" size="5" readonly /></td>
    </tr>  
    <?php } ?>
    <tr>
      <td><div align="right"><b>Data: </b></div></td>
      <td><input type="text" name="data_" id="data_" class="minusculo" maxlength="10" value="<?=($data==null)?"":$data?>" size="15"/> <span class="legenda-form">dd/mm/aaaa</span></td>
    </tr>    
    <tr>
      <td><div align="right"><b>Autor: </b></div></td>
      <td>
          <input type="text" name="autor_" class="maiusculo" value="<?=($autor==null)?"":$autor?>" size="70" /></td>
    </tr>     
    <tr>
      <td><div align="right"><b>Título: </b></div></td>
      <td>
          <input type="text" name="titulo_" class="maiusculo" value="<?=($titulo==null)?"":$titulo?>" size="130" /></td>
    </tr>     

    <tr>
      <td valign="top" align="right"><b>Texto:</b></td>
      <td>    
          <textarea cols="100" rows="15" class="campo" name="texto_" style="overflow:inherit; border:1px solid #c3c3c3;"><?=($texto==null)?"":$texto?></textarea>
      </td>
    </tr>                     

    <tr>
      <td><div align="right"><b>Destaque: </b></div></td>
      <td>
          <input type="radio" accesskey="s" name="destaque_" tabindex="1" value="s" <?=$dest_s?> checked="checked" /> Sim  
          &nbsp;&nbsp;&nbsp;
          <input type="radio" accesskey="n" name="destaque_" tabindex="2" value="n" <?=$dest_n?> /> Não    
      </td>
    </tr> 
    <tr>
      <td><div align="right"><b>Situação: </b></div></td>
      <td>
          <input type="radio" accesskey="a" name="situacao_" tabindex="1" value="a" <?=$sit_a?> checked="checked" /> Ativo  
          &nbsp;&nbsp;&nbsp;
          <input type="radio" accesskey="i" name="situacao_" tabindex="2" value="i" <?=$sit_i?> /> Inativo    
      </td>
    </tr>     
    
    
    <tr>
       <td colspan="2"><div align="center" >
         <br>
         <?php if($id==NULL){ ?>
           <input type="submit" name="insere" value=" Salvar " onclick="Acao('index.php?menu=noticia/noticia_form&barra=barraFormatacao&id=<?=$id_noticia?>&acao=insere')"/>&nbsp;
         <?php } else {  ?>   
           <input type="submit" name="altera" value=" Alterar " onclick="Acao('index.php?menu=noticia/noticia_form&barra=barraFormatacao&id=<?=$id_noticia?>&acao=altera')"/>&nbsp;
           <input type="submit" name="exclui" value=" Excluir " onclick="Acao('index.php?menu=noticia/noticia_form&barra=barraFormatacao&id=<?=$id_noticia?>&acao=exclui')"/>&nbsp;
         <?php } ?> 
         <input type="submit" name="limpa"  value=" Limpar " onclick="Acao('index.php?menu=noticia/noticia_form&barra=barraFormatacao')"/>
       </td>    
    </tr>    

    </table>
</FORM>      
    
    
    
<script type="text/javascript">
    //<![CDATA[

    var r = new Restrict("form1");  
    
    r.field.data_ = "\\d/";
    r.mask.data_ = "##/##/####";    
        
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
      document.getElementById("data_").focus(); 
    }    

    //]]>
</script>


<?  if($barra == "barraFormatacao") { ?>
            <script type="text/javascript" src="biblioteca/tinymce/js/tinymce/tinymce.min.js"></script>
            <script type="text/javascript">
            tinymce.init({
                selector: "textarea",
                language : 'pt_BR',
                theme: "modern",
                formats : {
                    hudson : {selector : 'h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
                },
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons"
             });
            </script>
        <!-- 
        <script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce_src.js"></script> 
        <? //include("js/tinymce_barra_formatacao.js"); ?>
        -->
<?  } ?>


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