<?php

   // RECEBE ID via GET
   $id=$_GET["id"];
        
   if($id != null) {
        include("banco/conecta.php");
        $pessoas=mysql_query("select * from tb_pessoa where id_pessoa=$id ");
        $dados=mysql_fetch_array($pessoas);
            $id_pessoa=$dados["id_pessoa"];
            $nome=$dados["nome"];
            $sexo=$dados["sexo"];
            $sex_m='';
            $sex_f='';
            if($sexo=="m")
               $sex_m='checked="checked"';
            else
               $sex_f='checked="checked"';
            $data_nasc = formataData($dados["data_nasc_"], "br");
            $fone=$dados["fone_"];
            $email=$dados["email"];
            $cidade=$dados["cidade"];
            $login=$dados["login"];
            $senha=$dados["senha"];
            $permissao=$dados["permissao"];
            $situacao=$dados["situacao"];
            $sit_a='';
            $sit_i='';
            if($situacao=="a")
               $sex_a='checked="checked"';
            else
               $sex_i='checked="checked"';
    }
?>