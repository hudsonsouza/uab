<?php 
    $id=$_GET["id"];
    $acao=$_GET["acao"];
?>
<br><br>
<div class="titulo">
	DESTAQUE
</div>
<br><br><br>

<?php
    include("banco/conecta.php");
    if($acao == "pesquisa"){
        $pessoas=mysql_query("select * from tb_noticia where situacao='a' AND autor LIKE '%$pNome%' order by data, titulo asc;");
    } else if($acao == "normal") {
        $pessoas=mysql_query("select * from tb_noticia where situacao='a' AND destaque='s' order by data, titulo asc;");
        //$pessoas=mysql_query("select id_noticia, data, autor, titulo, SUBSTRING(texto, 1, 10) from tb_noticia where situacao='a' AND destaque='s' order by data, titulo asc;");
    } else if($acao == "integra") {
        $pessoas=mysql_query("select * from tb_noticia where id_noticia='$id';");
    }
?>

<table border="0" class="noticia_destaque">
<tbody align="left">
<?php
    $ndados=mysql_num_rows($pessoas);
    for ($i=0;$i<$ndados;$i++){
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
            <td class='noticia_texto'>$texto2...<br><br><br></td>
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
?>
</tbody>
</table>    



<?php
// ==============  LISTA DE NOTICIAS ====================



?>



<?php if($acao=="integra") { ?>
    <br><br>
    <center>
        <a href="index.php?menu=destaque&acao=normal">| Destaques |</a>
    </center>
<?php } ?>

<br>
