<?php

// TB_PESSOA RECUPERA DB
    if($id!=NULL){  // BUSCA TUDO
        include("banco/conecta.php");
        $noticia=mysql_query("select * from tb_noticia where id_noticia=$id ");
        $dados=mysql_fetch_array($noticia);
        $id_noticia=$dados["id_noticia"];
        $data = formataData($dados["data"], "br");
        $autor=$dados["autor"];
        $titulo=$dados["titulo"];
        $destaque=$dados["destaque"];
            $dest_s='';
            $dest_n='';
            if($destaque=="s")
               $dest_s='checked="checked"';
            else
               $dest_n='checked="checked"';        
        $situacao=$dados["situacao"];
            $sit_a='';
            $sit_i='';
            if($situacao=="a")
               $sit_a='checked="checked"';
            else
               $sit_i='checked="checked"';          
    } 