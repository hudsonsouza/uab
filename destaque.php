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
    } else {
        $pessoas=mysql_query("select * from tb_noticia where situacao='a' AND destaque='s' order by data, titulo asc;");
    }
?>

<table border="0" class="noticia_destaque">
<tbody align="left">
<?php
    $ndados=mysql_num_rows($pessoas);
    for ($i=0;$i<$ndados;$i++){
        
//    // VARIACAO DA COR DO FUNDO DA LINHA DA TABELA
//    if($i%2 == 0){ 
//       $fundo='conteudo_branco';
//       $fundo_c='conteudo_branco_c';
//    } else {
//       $fundo='conteudo_cinza';
//       $fundo_c='conteudo_cinza_c';
//    }        
        
        
    //DECOBRIR O TAMANHO DO ARRAY
    $dados=mysql_fetch_array($pessoas);
    //POVOAR A TABELA COMO DADOS VINDOS DO BANCO
    $id_noticia=$dados["id_noticia"];
    $data = formataData($dados["data"], "br");
    $autor=$dados["autor"];
    $titulo=$dados["titulo"];
    $texto=$dados["texto"];
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
echo "
	<tr $corFundo>
            <td class='$noticia_titulo'><a href='index.php?menu=destaque&id=$id_noticia&acao=integra'><b>$titulo</b></a><br></td>
        </tr>
        <tr>
            <td class='$noticia_data_autor'>Autor: $data - $autor<br></td>
        </tr>
        <tr>
            <td class='$noticia_texto'>$texto<br><br><br></td>
        </tr>
	";
	}
?>
</tbody>
</table>    

<? //} ?>

<br>
