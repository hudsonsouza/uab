<?php
// FUNCOES DO SISTEMA


/*
// TRADUÇÃO DO TEXTO DO WEBSITE
function idiomaArray($num_pagina, $num_frase){
  $sigla_i = $_SESSION['s_sigla'];
  foreach($num_frases AS $nf){
    echo "<br>num_frase...: $nf";
    $tamanhoArray = sizeof($nf);
    echo "<br>tamanho do array de frases...: " . $tamanhoArray;
        //for($i=0; $i<$tamanhoArray; $i++){
            include("banco/conecta.php");
            $idiomas_i=mysql_query("SELECT T.frase FROM tb_idioma I, tb_traducao T WHERE I.sigla='$sigla_i' AND T.num_pagina='$num_pagina' AND T.num_frase='$num_frase' AND I.id_idioma=T.trad_id_idioma;");
            $ndados_i = mysql_num_rows($idiomas_i);
            for($i=0; $i<$ndados_i; $i++){
            $dados_i=mysql_fetch_array($idiomas_i);
                $frase = $dados_i["frase"];
            }
        //}
  }
    //return $sigla_i . $num_pagina . $frase[]; 
    return $frase; 
}
*/



// TRADUÇÃO DO TEXTO DO WEBSITE
function idioma($num_pagina, $num_frase){
    $sigla_s = $_SESSION['s_sigla'];
    include("banco/conecta.php");
    $idiomas_i=mysql_query("SELECT T.frase FROM tb_idioma I, tb_traducao T WHERE I.sigla='$sigla_s' AND T.num_pagina='$num_pagina' AND T.num_frase='$num_frase' AND I.id_idioma=T.trad_id_idioma;");
    $dados_i=mysql_fetch_array($idiomas_i);
        $frase = $dados_i["frase"];
    return $frase; 
}





function mostraErro(){
    $msg = error_reporting(E_ALL ^ E_NOTICE); //forÃ§a sistema a mostrar o erro
    return ($msg); 
}

function nomeCampo($nomeDoCampo){
    return $nomeDoCampo;
}

	
function converteData($data){
    return implode(!strstr($data, '/') ? "/" : "-", array_reverse(explode(!strstr($data, '/') ? "-" : "/", $data)));
}



function uploadImg($imagem,$caminho_img){
    //$Imagem = $_FILES["imagem"];
    $Imagem = $imagem;
        $Tamanhos = getimagesize($Imagem["tmp_name"]);
        $TipoArquivo = $_FILES['Imagem']['type'];
        if(!eregi("^(image)\/(pjpeg|jpeg|jpg|gif|png)$", $TipoArquivo)){
            print("<p align=\"center\"><br><br><span style=\"color:#ff0000;\" >Tipo de arquivo desconhecido!</span></p>");
        } else {
            $Data = date("Ydm-His");  // novo nome da imagem
            $Nome_Imagem = $Imagem["name"];
            $extensao = explode(".", $Nome_Imagem);
            $Extensao = $extensao[1];
            $Pasta = "$caminho_img";
            $Novo_Nome = $Pasta . $Data . "." . $Extensao;
            $caminho = $Novo_Nome;
            move_uploaded_file($Imagem["tmp_name"], $Novo_Nome);
        }
    return ("$Novo_Nome");
}


function upImagemOrig($caminhoArq){
       // UPLOAD DE IMAGEM
       if(isset($_POST['upload'])){
          if(isset($_FILES["img_original_"])){ 
            $Imagem = $_FILES["img_original_"];
            $Tamanhos = getimagesize($Imagem["tmp_name"]);
            if($Tamanhos > 0){
                $TipoArquivo = $_FILES['Imagem']['type'];
                //if(!eregi("^(image)\/(pjpeg|jpeg|jpg|gif|png)$", $TipoArquivo)){
                    //$te = microtime(true);
                    //$micro = sprintf("%06d",($te - floor($te)) * 1000000);
                    //$Data = date("Ymd-His".$micro,$te); // u=milessimo de segundos PHP 5.2.2
                    $Data = date("Ymd-His");   // formato do novo nome do arq: 20120806-152745
                    $Nome_Imagem = $Imagem["name"];
                    $extensao = explode(".", $Nome_Imagem);
                    $Extensao = $extensao[1];
                    //$Pasta = "foto_usuario/";
                    $Pasta = $caminhoArq;
                    $nome_foto = $Pasta . $Data . "." . $Extensao;
                    move_uploaded_file($Imagem["tmp_name"], $nome_foto);
                //} else {
                //    print("<p align=\"center\"><br><br><span style=\"color:#ff0000;\" >Tipo de arquivo desconhecido!</span></p>");
                //    $nome_foto = "extensÃ£o errada"; 
                    //echo "DEU PAU";
                //}  
            }            
          }
        }
        return $nome_foto;
}

//function upImagemProc($caminhoArq){
//       // UPLOAD DE IMAGEM
//       if(isset($_POST['upload'])){
//          if(isset($_FILES["img_processada_"])){ 
//            $Imagem = $_FILES["img_processada_"];
//            $Tamanhos = getimagesize($Imagem["tmp_name"]);
//            if($Tamanhos > 0){
//                $TipoArquivo = $_FILES['Imagem']['type'];
//                //if(!eregi("^(image)\/(pjpeg|jpeg|jpg|gif|png)$", $TipoArquivo)){
//                    //$te = microtime(true);
//                    //$micro = sprintf("%06d",($te - floor($te)) * 1000000);
//                    //$Data = date("Ymd-His".$micro,$te); // u=milessimo de segundos PHP 5.2.2
//                    $Data = date("Ymd-His");   // formato do novo nome do arq: 20120806-152745
//                    $Nome_Imagem = $Imagem["name"];
//                    $extensao = explode(".", $Nome_Imagem);
//                    $Extensao = $extensao[1];
//                    //$Pasta = "foto_usuario/";
//                    $Pasta = $caminhoArq;
//                    $nome_foto = $Pasta . $Data . "." . $Extensao;
//                    move_uploaded_file($Imagem["tmp_name"], $nome_foto);
//                //} else {
//                //    print("<p align=\"center\"><br><br><span style=\"color:#ff0000;\" >Tipo de arquivo desconhecido!</span></p>");
//                //    $nome_foto = "extensÃ£o errada"; 
//                    //echo "DEU PAU";
//                //}  
//            }            
//          }
//        }
//        return $nome_foto;
//}


function upFoto($caminhoArq){
       // UPLOAD DE IMAGEM
       if(isset($_POST['upload'])){
          if(isset($_FILES["foto_"])){ 
            $Imagem = $_FILES["foto_"];
            $Tamanhos = getimagesize($Imagem["tmp_name"]);
            if($Tamanhos > 0){
                $TipoArquivo = $_FILES['Imagem']['type'];
                //if(!eregi("^(image)\/(pjpeg|jpeg|jpg|gif|png)$", $TipoArquivo)){
                    //$te = microtime(true);
                    //$micro = sprintf("%06d",($te - floor($te)) * 1000000);
                    //$Data = date("Ymd-His".$micro,$te); // u=milessimo de segundos PHP 5.2.2
                    $Data = date("Ymd-His");   // formato do novo nome do arq: 20120806-152745
                    $Nome_Imagem = $Imagem["name"];
                    $extensao = explode(".", $Nome_Imagem);
                    $Extensao = $extensao[1];
                    //$Pasta = "foto_usuario/";
                    $Pasta = $caminhoArq;
                    $nome_foto = $Pasta . $Data . "." . $Extensao;
                    move_uploaded_file($Imagem["tmp_name"], $nome_foto);
                //} else {
                //    print("<p align=\"center\"><br><br><span style=\"color:#ff0000;\" >Tipo de arquivo desconhecido!</span></p>");
                //    $nome_foto = "extensÃ£o errada"; 
                    //echo "DEU PAU";
                //}  
            }            
          }
        }
        return $nome_foto;
}



#######




function upArquivo($caminhoArq){
       // VERIFICA SE O ARQUIVO FOI ENVIADO
       if(isset($_POST['upload'])){
          if(isset($_FILES["arq_upload"])){ 
            // NOME DO ARQUIVO VINDO DO FORMULARIO
            $Arquivo = $_FILES["arq_upload"];  
            // NOME TEMPORARIO NO SERVIDOR
            $Tamanhos = getimagesize($Arquivo["tmp_name"]);
            if($Tamanhos > 0){
                $TipoArquivo = $_FILES['arq_upload']['type'];
                //if(!eregi("^(image)\/(pjpeg|jpeg|jpg|gif|png)$", $TipoArquivo)){
                    //$te = microtime(true);
                    //$micro = sprintf("%06d",($te - floor($te)) * 1000000);
                    //$Data = date("Ymd-His".$micro,$te); // u=milessimo de segundos PHP 5.2.2
                    $Data = date("Ymd-His");   // formato do novo nome do arq: 20120806-152745
                    $Nome_Arquivo = $Arquivo["name"];
                    $extensao = explode(".", $Nome_Arquivo);
                    $Extensao = $extensao[1];
                    //$Pasta = "foto_usuario/";
                    $Pasta = $caminhoArq;
                    $nome_arquivo = $Pasta . $Data . "." . $Extensao;
                    move_uploaded_file($Arquivo["tmp_name"], $nome_arquivo);
                //} else {
                //    print("<p align=\"center\"><br><br><span style=\"color:#ff0000;\" >Tipo de arquivo desconhecido!</span></p>");
                //    $nome_foto = "extensÃ£o errada"; 
                    //echo "DEU PAU";
                //}  
            }            
          }
        }
        return $nome_arquivo;
}





function uploadArq($arquivo,$caminho_arq){
        $Imagem = $_FILES["$arquivo"];
        $Tamanhos = getimagesize($Imagem["tmp_name"]);
        $TipoArquivo = $_FILES['Imagem']['type'];
        $Data = date("Ydm-His");   // formato do novo nome do arq
        $Nome_Imagem = $Imagem["name"];
        $extensao = explode(".", $Nome_Imagem);
        $Extensao = $extensao[1];
        $Pasta = "$caminho_arq";
        $Novo_Nome = $Pasta . $Data . "." . $Extensao;
        $Caminho = $Pasta . $Novo_Nome;
        move_uploaded_file($Imagem["tmp_name"], $Novo_Nome);    
    return ($Novo_Nome);
}

// HUDSON EST E ESTA FUNCIONANDO OK!
function upArq($caminhoArq){
    // VERIFICA SE O ARQUIVO FOI ENVIADO
    if(isset($_POST['arq_upload'])){
        if(isset($_FILES["arquivo_"])){
            $Arquivo = $_FILES["arquivo_"];
            $Nome_Arquivo = $Arquivo["name"];
            $Tmp_Nome = $Arquivo["tmp_name"];
            $Tipo_Nome = $Arquivo["type"];
            //$Extensao = substr($Arquivo["name"],-3);  //doc
            //$Extensao = substr($Arquivo["name"],-4);  //docx
            $Tamanho = $Arquivo["size"];
            
            //echo "<br>Nome completo...: " . $Arquivo;
            //echo "<br>Nome do arquivo...: " . $Nome_Arquivo;
            //echo "<br>Nome Temporario...: " . $Tmp_Nome;
            //echo "<br>Tipo Nome...: " . $Tipo_Nome;
            //echo "<br>Extensão...: " . $Extensao;
            //echo "<br>Tamanho...: " . $Tamanho;
            
            // VALIDA EXTENSAO IMAGEM
            //if(!preg_match("^(image)\/(gif|bmp|png|jpg|jpeg)$", $TipoArquivo)){
            
            // VALIDA EXTENSAO ARQUIVOS
            //if(!preg_match("/^application\.(doc|DOC|docx|DOCX|odt|ODT|odp|ODP|ppt|PPT|pptx|PPTX|pps|PPS|ppsx|PPSX|xls|XLS|xlsx|XLSX|ods|ODS|csv|CSV|rtf|RTF|txt|TXT)+$/", $Tipo_Nome)){
            if(!preg_match("/^application\.(pdf|PDF)+$/", $Tipo_Nome)){
                    $Data = date("Ymd-His");   // formato do novo nome do arq: 20120806-152745
                    //$Nome_Imagem = $Imagem["name"];
                    $extensao = explode(".", $Nome_Arquivo);
                    $Extensao = $extensao[1];
                    //$Pasta = "foto_usuario/";
                    $Pasta = $caminhoArq;
                    $nome_arq = $Pasta . $Data . "." . $Extensao;
                    move_uploaded_file($Arquivo["tmp_name"], $nome_arq);
            } 
            
        } else {
            $nome_arq = "FALHA NO UPLOAD ARQUIVO";
            echo "FALHA NO UPLOAD ARQUIVO";
        }
        
    } 
    
    return $nome_arq;
}



function redimensionar($tmp, $name, $largura, $pasta){
    $img = imagecreatefromjpeg($tmp);
        $x = imagesx($img);
        $y = imagesy($img);
        $altura = ($largura*$y) / $x;
        $nova = imagecreatetruecolor($largura, $altura);
        imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
        imagejpeg($nova, "$pasta/$name");
        imagedestroy($img);
        imagedestroy($nova);
    return($name);
}


function formataData($data,$formato){
    if($formato == "br")
        $format = "d/m/Y";
    if($formato == "br-h")
        $format = "H:i:s";
    if($formato == "br-dia")
        $format = "d";  
    if($formato == "br-mes")
        $format = "m";  
    if($formato == "br-ano")
        $format = "Y";  
    if($formato == "br-niver")
        $format = "d/m";     
    if($formato == "br-grafico")
        $format = "d/m";     
    if($formato == "br-niver-extenso")
        $format = "d M";     
    if($formato == "br-dh")
        $format = "d/m/Y H:i:s";
    if($formato == "usa")
        $format = "Y-m-d";
    if($formato == "usa-dh")
        $format = "Y-m-d H:i:s";
 return date($format,strtotime($data));
}        

//$data = date("Y-m-d",strtotime($data));
//$data = date("Y-m-d",strtotime($dados["data"]));
//date("d/m",strtotime($data));


function dataExtenso(){
$mesnome[1] = "Janeiro";
$mesnome[2] = "Fevereiro";
$mesnome[3] = "Março";
$mesnome[4] = "Abril";
$mesnome[5] = "Maio";
$mesnome[6] = "Junho";
$mesnome[7] = "Julho";
$mesnome[8] = "Agosto";
$mesnome[9] = "Setembro";
$mesnome[10] = "Outubro";
$mesnome[11] = "Novembro";
$mesnome[12] = "Dezembro";

$diasemana[0] = "Domingo";
$diasemana[1] = "Segunda-Feira";
$diasemana[2] = "Terça-Feira";
$diasemana[3] = "Quarta-Feira";
$diasemana[4] = "Quinta-Feira";
$diasemana[5] = "Sexta-Feira";
$diasemana[6] = "Sábado";

$ano = date('Y');
$mes = date('n');
$dia = date('d');
$semana = date('w');
    
    $ajustaHora=time()+0;   // localhost +0h
    //$ajustaHora=time()-10800; // HotelWeb-3h
    $porExtenso = 'Paranavaí-PR, ' . $diasemana[$semana] . ' ' . $dia . ' de ' . $mesnome[$mes] . ' de ' . $ano . ' às ' . date("H:i",$ajustaHora);
    
    return $porExtenso;
}

// AJUSTAR HORA SERVIDOR
function ajustaHora(){    
    //return time()+0;     // localhost
    //return time()-10800;   // hoteldaweb -3h
    return time()+0;   // radical 0h
}

function data_ddmmaaaa_hms(){
    $data_atual = date("d/m/Y H:i:s",ajustaHora());
    return $data_atual;
}

function data_aaaammdd_hms(){
    $data_atual = date("Y-m-d H:i:s",ajustaHora());
    return $data_atual;
}

function data_aaaammdd_hms2(){
    $data_atual = date("Y-m-d_H:i:s",ajustaHora());
    return $data_atual;
}

function data_aaaammdd(){
    $data_atual = date("Y-m-d",ajustaHora());
    return $data_atual;
}



function converte_datetime($datetime) {
    if (preg_match("/^\d{4}(-\d{2}){2} (\d{2}:){2}\d{2}$/", $datetime)) {
        $array['dia']     = substr($datetime, 8, 2);
        $array['mes']     = substr($datetime, 5, 2);
        $array['ano']     = substr($datetime, 0, 4);
        $array['hora']    = substr($datetime, 11, 2);
        $array['minuto']  = substr($datetime, 14, 2);
        $array['segundo'] = substr($datetime, 17, 2);
        $array['data']    = $array['dia'] . '/' . $array['mes'] . '/' . $array['ano'];
        $array['horario'] = substr($datetime, 11, 8);
        $array['data_hora'] = $array['data'] . " " . $array['horario'];
        return $array;
    } else {
        return false;
    }
}


function converte_date($data) {
    if (preg_match("/^\d{4}(-\d{2}){2} (\d{2}:){2}\d{2}$/", $data)) {
        $array['dia']     = substr($data, 8, 2);
        $array['mes']     = substr($data, 5, 2);
        $array['ano']     = substr($data, 0, 4);
        $array['data']    = $array['dia'] . '/' . $array['mes'] . '/' . $array['ano'];
        return $array;
    } else {
        return false;
    }
}
    

function diferenca_minuto($datetime_inicio, $datetime_final) {
  //$datetime_inicio = "2013-04-23 13:12:48";
  $conv_datetime = converte_datetime($datetime_inicio);
    $hora_inicio = $conv_datetime['hora'];
    $minuto_inicio = $conv_datetime['minuto'];

  //$datetime_final = "2013-04-23 14:30:50";
  $conv_datetime = converte_datetime($datetime_final);
    $hora_final = $conv_datetime['hora'];
    $minuto_final = $conv_datetime['minuto'];
 
  $diferenca_minuto = ($hora_final * 60 + $minuto_final) - ($hora_inicio * 60 + $minuto_inicio);
  
  return $diferenca_minuto;    
    
}


function diferenca_hora($diferenca_minuto) {
    $diferenca_hora_minuto = floor($diferenca_minuto / 60) . ":" . ($diferenca_minuto % 60);
    return $diferenca_hora_minuto;
}



function duracao_datetime($datetime_inicio, $datetime_final) {
        $array['dia_inicio']     = substr($datetime_inicio, 8, 2);
        $array['mes_inicio']     = substr($datetime_inicio, 5, 2);
        $array['ano_inicio']     = substr($datetime_inicio, 0, 4);
        $array['hora_inicio']    = substr($datetime_inicio, 11, 2);
        $array['minuto_inicio']  = substr($datetime_inicio, 14, 2);
        $array['segundo_inicio'] = substr($datetime_inicio, 17, 2);
        $array['data_inicio']    = $array['mes_inicio'] . '/' . $array['dia_inicio'] . '/' . $array['ano_inicio'];
        $array['horario_inicio'] = substr($datetime_inicio, 11, 8);
        $array['data_hora_inicio'] = $array['data_inicio'] . " " . $array['horario_inicio'];

        $array['dia_final']     = substr($datetime_final, 8, 2);
        $array['mes_final']     = substr($datetime_final, 5, 2);
        $array['ano_final']     = substr($datetime_final, 0, 4);
        $array['hora_final']    = substr($datetime_final, 11, 2);
        $array['minuto_final']  = substr($datetime_final, 14, 2);
        $array['segundo_final'] = substr($datetime_final, 17, 2);
        $array['data_final']    = $array['mes_final'] . '/' . $array['dia_final'] . '/' . $array['ano_final'];
        $array['horario_final'] = substr($datetime_final, 11, 8);
        $array['data_hora_final'] = $array['data_final'] . " " . $array['horario_final'];
        
        //$array['data_hora_duracao'] = datetimediff( $array['data_hora_final'] , $array['data_hora_inicio'] ); // m-d-Y
        //$array['hora_duracao'] = hour(timediff( $array['horario_final'] , $array['horario_inicio'] )); // m-d-Y

        // $idade = datediff("04-25-2011", "05-15-2010");  // m-d-Y
        
        return $array;

}



// Função para calcular horário
function dif_horario($horario1, $horario2) {
    $horario1 = strtotime("1/1/1980 $horario1");
    $horario2 = strtotime("1/1/1980 $horario2");
         
 if ($horario2 < $horario1) {
    $horario2 = $horario2 + 86400;
 }
 
 return ($horario2 - $horario1) / 3600;     
}


// CONTROLE DE ACESSO
function controleAcesso($id_pessoa_aut, $nome, $apelido, $login, $permissao, $fone_cel, $email, $tipo_acesso, $observacao){
    $data_atual = data_aaaammdd_hms();
    $ip_cliente = $_SERVER['REMOTE_ADDR'];
    include("banco/conecta.php");
    mysql_query("INSERT INTO tb_controle_acesso (id_controle_acesso , data , ip_cliente , id_pessoa , nome , apelido , login , permissao , fone_cel, email, tipo_acesso, observacao ) VALUES (null, '$data_atual', '$ip_cliente', '$id_pessoa_aut', '$nome', '$apelido', '$login', '$permissao', '$fone_cel', '$email', '$tipo_acesso', '$observacao' )");
    mysql_query("commit");
    //return;
}

/* 
TIPO DE ACESSO
==============
1- ACESSO RESTRITO ERRO: 'login ou senha vazio'
2- USUÁRIO TEMPORÁRIO
3- ACESSO AVALIADOR
4- ACESSO SiTAV: CADASTRO
5- ACESSO PROFESSOR
6- ACESSO ORIENTADOR
7- ACESSO DESENVOLVEDOR
8- USUÁRIO BLOQUEADO: 'i'
9- ACESSO RESTRITO ERRO: 'login/senha'
*/ 






// RECEBE OS DADOS PARA GERAR O GRAFICO BARRA
//function geraGraficoBarra($superestimado,$preciso,$subestimado){
//    $_SESSION["s_superestimado;"] = $superestimado;
//    $_SESSION["s_preciso;"] = $preciso;
//    $_SESSION["s_subestimado;"] = $subestimado;
//    return NULL; 
//}

/*
// RECEBE OS DADOS PARA GERAR O GRAFICO INDIVIDUAL LINHA
function geraGraficoLinha($tamanhoVetor, $vDataG, $vSuper, $vPreciso, $vSub){
    $_SESSION["s_tamanhoVetor"] = $tamanhoVetor;
    $_SESSION["s_vDataG"] = $vDataG;
    $_SESSION["s_vSuper"] = $vSuper;
    $_SESSION["s_vPreciso"] = $vPreciso;
    $_SESSION["s_vSub"] = $vSub;
    
        $vArray = '$data2[]' . "=array(";
        //$vArray = "array(";
        for($i=0; $i<$tamanhoVetor; $i++){
            $vArray.="array('$vDataG[$i]',$vSub[$i],$vPreciso[$i],$vSuper[$i]),";
        }
        //$arrayPronto = $vArray.");"; 
        $_SESSION["s_arrayPronto"] = $vArray.");";
        //$_SESSION["s_arrayPronto"] = $vArray;
    return NULL; 
}
*/

function validaEmail($email){
    if (ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$", $email ) ) {
       return true;
    } else {
       return false;
    }
}


function geraSenha($tamanho){
  $car_especiais = '!@#$%&*()_-+={[}]?';
  $car_numericos = '0123456789';
  $car_minusc = 'abcdefghijklmnopqrstuvwxyz';
  $car_maiusc = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $carac = '';

# Agora vou fazer um loop preenchendo caracter por caracter atÃ© que chegue ao tamanho desejado.
  for($iop = 0; $iop < $tamanho; $iop++){
    $tmp = rand(1,3);
    if($tmp==1){
      $carac = $car_maiusc;
    } elseif($tmp==2){
      $carac = $car_numericos;
    } elseif($tmp==3){
      $carac = $car_minusc;
    } elseif($tmp==4){  # OPCAO FORA DO LAÃO - $tmp = rand(1,4);
      $carac = $car_especiais; 
    } else{
      $carac = $car_minusc;
    }
    $senha .= substr($carac, rand(0,strlen($carac)-1), 1);
  }
return $senha ;
}


// ==== CALCULOS ====



function vetorReal($tentativa,$severidade_sorteado){
    $vetorReal[$tentativa]=$severidade_sorteado;
    return $vetorReal;
}

function vetorEstimado($tentativa,$estimado){
    $vetorEstimado[$tentativa]=$estimado;
    return $vetorEstimado;
}





?>