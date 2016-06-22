<?php
    $id=$_GET["id"];
    $acao=$_GET["acao"];
    $campoFoco = 'pNome';
    session_start();
    if (!isset($_SESSION['s_login'])) {
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?menu=usuario/login'>";
    } elseif(($_SESSION['s_permissao']==3)  || ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==7) || ($_SESSION['s_permissao']==9) ){        
?>

<br><br>
    <div class="titulo">NOTÍCIAS</div>
<br>

<center>


    
    
    
    
<? // ============ BOTAO NOVA NOTICIA =============== ?>

<FORM id="form" method="POST" action="index.php?menu=noticia/noticia_form&barra=barraFormatacao"> 
<table width="100" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td>
	<input tabindex="2" type="submit" name="novaNotica" value="::: Criar Nova Notícia :::" />
    </td>
</table>
</FORM>    

<?php if($acao=="inativo"){ ?>
    <FORM id="form" method="POST" action="index.php?menu=noticia/noticia_lista&acao=ativo"> 
    <table width="65" border="0" cellspacing="4" cellpadding="0">
      <tr>
        <td>
            <input tabindex="2" type="submit" name="inativo" value=" Ativo " />
        </td>
    </table>
    </</FORM>     
<?php } else {?>
    <FORM id="form" method="POST" action="index.php?menu=noticia/noticia_lista&acao=inativo">
    <table width="65" border="0" cellspacing="4" cellpadding="0">
      <tr>
        <td>
            <input tabindex="2" type="submit" name="inativo" value=" Inativo " />
        </td>
    </table>
    </FORM>   
<?php } ?>    
    
<? // ============ CONSULTA =============== ?>


<?php if($_SESSION["s_permissao"]==3 || $_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==7 || $_SESSION["s_permissao"]==9 ){ ?>
<br><br>
<?php 
    if($acao=="inativo"){
        $ac="inativo";
    }else{
        $ac="ativo";
    }
?>
<FORM id="form2" method="POST" action="index.php?menu=noticia/noticia_lista&acao=<?=$ac?>"> 
<table width="100" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td align="right">Nome: </td>
    <td>
		<input tabindex="1" type="text" name="pNome" id="pNome" size="20" class="maiusculo" />	</td>
    <td rowspan="2"> 
                <input tabindex="2" type="submit" name="pesquisar" value=" Pesquisar : " />
    </td>
  </tr>

</table>
</FORM>



<?php

	// ABRE CONEXAO COM BANCO
	include("banco/conecta.php");
	$pNome=trim(strtoupper($_POST["pNome"])); 
        echo "<br>Pesquisa......: <b>" . $pNome . "</b>";
        
        //REALIZA UM SELECT NA TABELA
        if($acao == "ativo") {
            $pessoas=mysql_query("select * from tb_noticia where situacao='a' AND autor LIKE '%$pNome%' OR situacao='a' AND titulo LIKE '%$pNome%' order by data desc, titulo asc;");
	} 
        
        if($acao == "inativo") {
            $pessoas=mysql_query("select * from tb_noticia where situacao='i' AND autor LIKE '%$pNome%' OR situacao='i' AND titulo LIKE '%$pNome%' order by data desc, titulo asc;");
	} 
        
        if($acao == "pesquisa"){
            $pessoas=mysql_query("select * from tb_noticia where situacao='a' AND autor LIKE '%$pNome%' OR situacao='a' AND titulo LIKE '%$pNome%' order by data desc, titulo asc;");
        }
        
	//DESCOBRE A QTD DE LINHAS DE DADOS
        if( $pessoas )
	$ndados=mysql_num_rows($pessoas);
  	echo "<br><br>Ha <b>$ndados</b> cadastros armazenados ";
  	if($acao=="inativo"){echo" INATIVOS";}
        echo "<br><br>";
?>
<table border="0" class="tabela">
<thead stile="font-weight:bold; text-align: center;">
<tr>
          <td class="titulo_meio" align="center">Data</td>	  
          <td class="titulo_meio" align="center">Autor</td>	  
          <td class="titulo_meio" align="center">Título</td>
          <td class="titulo_meio" align="center">Destaque</td>	  
          <td class="titulo_meio" align="center">Situação</td>	
</tr>
</thead>
<tbody align="left">
<?php
    for ($i=0;$i<$ndados;$i++){
        
    // VARIACAO DA COR DO FUNDO DA LINHA DA TABELA
    if($i%2 == 0){ 
       $fundo='conteudo_branco';
       $fundo_c='conteudo_branco_c';
    } else {
       $fundo='conteudo_cinza';
       $fundo_c='conteudo_cinza_c';
    }        
        
        
    //DECOBRIR O TAMANHO DO ARRAY
    $dados=mysql_fetch_array($pessoas);
    //POVOAR A TABELA COMO DADOS VINDOS DO BANCO
    $id_noticia=$dados["id_noticia"];
    $data = formataData($dados["data"], "br");
    $autor=$dados["autor"];
    $titulo=$dados["titulo"];
    $destaque=$dados["destaque"];
        if($destaque=="s")
            $dest="Sim";
        else
            $dest="Não";
    $situacao=$dados["situacao"];
        if($situacao=="a")
            $sit="Ativo";
        else
            $sit="Inativo";
echo "
	<tr $corFundo>
            <td class='$fundo_c'>&nbsp;$data&nbsp;</td>
            <td class='$fundo'>&nbsp;$autor&nbsp;</td>
            <td class='$fundo'><a href='index.php?menu=noticia/noticia_form&barra=barraFormatacao&id=$id_noticia'>&nbsp;$titulo &nbsp;</a></td>
            <td class='$fundo_c'>&nbsp;$dest&nbsp;</td>
            <td class='$fundo_c'>&nbsp;$sit&nbsp;</td>
        </tr>
	";
	}
?>
</tbody>
</table>    

<? } ?>

<br>


<? // ================= CONDIÇÕES ======================= ?>


<br><br>
	<a href="index.php?menu=home">| Voltar |</a>
</center>	

<br><br>

<!-- === MASCARA PARA OS CAMPOS DOS FORMULARIOS === -->

<script type="text/javascript">
    //<![CDATA[

    var r = new Restrict("form1");  

    r.field.data_nasc_ = "\\d/";
    r.mask.data_nasc_ = "##/##/####";
    
    r.field.fone_ = "\\d-() ";
    r.mask.fone_ = "(##) #####-####"; 
    
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
      document.getElementById("pNome").focus(); 
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