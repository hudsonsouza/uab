<?php 
    $id=$_GET["id"];
    $acao=$_GET["acao"];
        if($acao==NULL)
            $acao="normal";
?>
<br><br>
<div class="titulo">
	DESTAQUE
</div>
<br>

<?php
    include("banco/conecta.php");
    if($acao == "pesquisa"){
        $pessoas=mysql_query("select * from tb_noticia where situacao='a' AND autor LIKE '%$pNome%' OR titulo LIKE '%$pNome%' order by data, titulo asc;");
    } else if($acao == "normal") {
        $pessoas=mysql_query("select * from tb_noticia where situacao='a' AND destaque='s' order by data desc, titulo asc;");
        //$pessoas=mysql_query("select id_noticia, data, autor, titulo, SUBSTRING(texto, 1, 10) from tb_noticia where situacao='a' AND destaque='s' order by data, titulo asc;");
    } else if($acao == "integra") {
        $pessoas=mysql_query("select * from tb_noticia where id_noticia='$id';");
    }
?>

<table border="0" class="noticia_destaque">
<tbody align="left">
<?php
    $ndados1=mysql_num_rows($pessoas);
    for ($i=0;$i<$ndados1;$i++){
    //DECOBRIR O TAMANHO DO ARRAY
    $dados=mysql_fetch_array($pessoas);
    //POVOAR A TABELA COMO DADOS VINDOS DO BANCO
    $id_noticia=$dados["id_noticia"];
    $data = formataData($dados["data"], "br");
    $autor=$dados["autor"];
    $titulo=$dados["titulo"];
    $texto=$dados["texto"];
        if($acao=="normal"){
            $texto2 = substr("$texto", 0,200); 
        } else if($acao=="integra") {
            $texto2 = $texto;
        }
//    $destaque=$dados["destaque"];
//        if($destaque=="s")
//            $dest="Sim";
//        else
//            $dest="Não";
//    $situacao=$dados["situacao"];
//        if($situacao=="a")
//            $sit="Ativo";
//        else
//            $sit="Inativo";
        
if($acao=="normal"){        
    echo "
	<tr $corFundo>
            <td class='noticia_titulo'><a href='index.php?menu=destaque&id=$id_noticia&acao=integra'><b>$titulo</b></a><br></td>
        </tr>
        <tr>
            <td class='noticia_data_autor'>$data - $autor<br></td>
        </tr>
        <tr>
            <td class='noticia_texto'>$texto2...<br></td>
        </tr>
	";
} else if($acao=="integra") {
    echo "
	<tr $corFundo>
            <td class='noticia_titulo'><a href='index.php?menu=destaque&id=$id_noticia&acao=integra'><b>$titulo</b></a><br></td>
        </tr>
        <tr>
            <td class='noticia_data_autor'>$data - $autor<br><br></td>
        </tr>
        <tr>
            <td class='noticia_texto'>$texto2<br></td>
        </tr>
	";
    
        
}
   
}        

if($acao=="integra") { 
if( ($_SESSION['s_permissao']==3) || ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==7) || ($_SESSION['s_permissao']==9) ){ ?>
<center>
<FORM id="form" method="POST" action="index.php?menu=noticia/noticia_form&barra=barraFormatacao&id=<?=$id_noticia?>"> 
   <table width="130" border="0" cellspacing="4" cellpadding="0">
        <tr>
            <td> 
                <input type="submit" name="alterar" value=".: Alterar Notícia :." />
            </td>
        </tr>
    </table>
</FORM>
</center>
<?php } }

?>
</tbody>
</table>    



<?php
// ==============  LISTA DE NOTICIAS ====================
?>


<? // ============ CONSULTA =============== ?>

<center>

<?php // if($_SESSION["s_permissao"]==3 || $_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==7 || $_SESSION["s_permissao"]==9 ){ ?>
<br><br>
<FORM id="form" method="POST" action="index.php?menu=destaque&acao=pesquisa"> 
<table width="100" border="0" cellspacing="4" cellpadding="0">
      <tr>
        <td align="right">Nome: </td>
        <td>
                    <input tabindex="1" type="text" name="pNome" size="20" class="maiusculo" />	</td>
        <td rowspan="2"> 
                    <input tabindex="2" type="submit" name="Alterar" value=".: Pesquisar :." />
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
            $pessoas1=mysql_query("select * from tb_noticia where situacao='a' AND autor LIKE '%$pNome%' OR situacao='a' AND titulo LIKE '%$pNome%' order by data desc, titulo asc;");
	} 
        
        if($acao == "inativo") {
            $pessoas1=mysql_query("select * from tb_noticia where situacao='i' AND autor LIKE '%$pNome%' OR situacao='i' AND titulo LIKE '%$pNome%' order by data desc, titulo asc;");
	} 
        
        //if($acao == "normal" || $acao == "pesquisa"){
        if($acao == "pesquisa" || $acao == "normal"){
            $pessoas1=mysql_query("select * from tb_noticia where situacao='a' AND autor LIKE '%$pNome%' OR situacao='a' AND titulo LIKE '%$pNome%' order by data desc, titulo asc;");
        }
        
//        if($acao == "normal"){
//            $pessoas1=mysql_query("select * from tb_noticia where situacao='a' order by data desc, titulo asc;");
//        }
        
	//DESCOBRE A QTD DE LINHAS DE DADOS
        if( $pessoas1 )
	$ndados=mysql_num_rows($pessoas1);
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
    $dados=mysql_fetch_array($pessoas1);
    //POVOAR A TABELA COMO DADOS VINDOS DO BANCO
    $id_noticia=$dados["id_noticia"];
    $data = formataData($dados["data"], "br");
    $autor=$dados["autor"];
    $titulo=$dados["titulo"];
echo "
	<tr $corFundo>
            <td class='$fundo_c'>&nbsp;$data&nbsp;</td>
            <td class='$fundo'>&nbsp;$autor&nbsp;</td>
            <td class='$fundo'><a href='index.php?menu=destaque&id=$id_noticia&acao=integra'>&nbsp;$titulo &nbsp;</a></td>
        </tr>
	";
	}
?>
</tbody>
</table>    

<? // } ?>

<br>



<?php if($acao=="integra") { ?>
    <br><br>
    <center>
        <a href="index.php?menu=destaque&acao=normal">| Destaques |</a>
    </center>
<?php } ?>

<br>
