<?php
    $id=$_GET["id"];
    session_start();
    if (!isset($_SESSION['s_login'])) {
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?menu=usuario/login'>";
    } elseif(($_SESSION["s_idPessoa"]==$id) || ($_SESSION["s_permissao"]==3) || ($_SESSION["s_permissao"]==5) || ($_SESSION["s_permissao"]==7) || ($_SESSION["s_permissao"]==9) ){
?>


<br><br>
<div id="titulo2">CADASTRO DE PESSOAS</div>
<br>
<center>

<?php 

$acao=$_GET["acao"];


if($id != null){
    include("cadastro/pessoaRecuperaDB.php");
}


if($id==null && $acao==null){
	echo "NOVO CADASTRO<br><br>";

        
} else if ($id==null && $acao=="insere"){
	include("cadastro/pessoaRecuperaFormulario.php");
        
        if(!empty($nome) && !empty($sexo) && !empty($data_nasc) && !empty($fone) && !empty($email) && !empty($cidade) && !empty($login) && !empty($senha)){  // CAMPO EMAIL NAO VAZIO        

                    // VERIFICA EMAIL JA CADASTRADO
                    $verificaEmail=FALSE;
                    include("banco/conecta.php");
                    $qtdEmail = mysql_query("SELECT email FROM tb_pessoa WHERE email='$email';");
                    $ndados=mysql_num_rows($qtdEmail);
                    if($ndados==0)
                       $verificaEmail=TRUE;

            if($verificaEmail==TRUE){
                    $senhaMD5 = $senha;
                    mysql_query("INSERT INTO tb_pessoa (id_pessoa , nome , sexo , data_nasc , fone , cidade , login , senha , permissao , situacao ) VALUES (null, '$nome', '$sexo', '$data_nasc', '$fone', '$email', '$cidade', '$login', '$senhaMD5', 1, 'a' )");
                    mysql_query("commit");
                    mysql_close();
                    echo "<div class=msg><br>.:: Cadastro inserido sucesso ! ::.<br><br></div>";
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?menu=cadastro/pessoaAutenticacao&id=$ultimo_id'>";	


            } else {
                // EMAIL JA EXISTENTE
                echo "<div class=msgERRO><br>.:: E-MAIL já cadastrado, tente novamente! ::.<br><br></div>";
            


        } else {
            // CAMPO EMAIL ESTÁ VAZIO
            echo "<div class=msgERRO><br>.:: O preenchimento de todos os campos são obrigatórios! ::.<br><br></div>";
        }

                 
} else if ($id != null && $acao=="altera"){
	// echo "CADASTRO ALTERAR";
        include("cadastro/pessoaRecuperaFormulario.php"); 
        include("banco/conecta.php");
	mysql_query("update tb_pessoa set nome='$nome', sexo='$sexo', data_nasc='$data_nasc', fone='$fone', email='$email', cidade='$cidade', permissao='$permissao', situacao='$situacao' where tb_pessoa.id_pessoa='$id_pessoa' limit 1") or die(mysql_error());
	mysql_query("commit");
        mysql_close();
	echo "<div class=msg><br>.:: Cadastro alterado com sucesso ! ::.<br><br></div>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='2; URL=index.php?menu=cadastro/pessoa'>";	

                 
} else if ($acao=="exlui"){
	include("banco/conecta.php");
        mysql_query("update tb_pessoa set situacao='i' where tb_pessoa.id_pessoa='$id_pessoa' limit 1;");
	mysql_query("commit");
        mysql_close();
        echo "<div class=msg><br>.:: Cadastro excluido com sucesso ! ::.<br><br></div>";
	echo "<meta HTTP-EQUIV='refresh' CONTENT='2; URL=index.php?menu=cadastro/pessoa'>";
			
} else {
	//echo "OPÇÃO INVALIDA";
}

    

?>

    
<? // ============= FORMULARIO ====================?>    
   
<? 
    echo "<div class=msg>.:: Etapa: 1/5 - Dados Pessoais ::.<br><br></div>";
?>    
    
<FORM id="form1" METHOD="POST" ACTION="./">
  <table width="900" border="0" cellspacing="5" class="corpoTab">
 
   <? if($id_pessoa != null){ ?>
      <tr>
          <td><div align="right"><b>Foto: </b></div></td>
          <td><img src="<?=$foto?>" width="100" border="1"></td>      
            
      </tr> 
   <? } ?>    
      
  <? if($_SESSION["s_idPessoa"]==$id || $_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==10){ ?>
      <tr>
        <td><div align="right"><b>Código: </b></div></td>
        <td><input type="text" name="id_pessoa_" class="minusculo" value="<?=($id_pessoa==null)?"":$id_pessoa?>" size="5" readonly /></td>
      </tr>     
  <? } ?> 
      
  <tr>
    <td><div align="right"><b>Nome: </b></div></td>
    <td>
        <input type="text" name="nome_" id="nome_" class="maiusculo" value="<?=($nome==null)?"":$nome?>" size="40" /></td>
  </tr>
  <tr>
    <td><div align="right"><b>Apelido: </b></div></td>
    <td><input type="text" name="apelido_" class="campo" value="<?=($apelido==null)?"":$apelido?>" size="10" /></td>
  </tr>        
  <tr>
    <td><div align="right"><b>Cidade-UF: </b></div></td>
    <td><input type="text" name="cidade_" class="maiusculo" value="<?=($cidade==null)?"":$cidade?>" size="40" /></td>
  </tr>
  <tr>
    <td><div align="right"><b>IES / Propriedade / Empresa: </b></div></td>
    <td><input type="text" name="propriedade_" class="maiusculo" value="<?=($propriedade==null)?"":$propriedade?>" size="40" /></td>
  </tr>
  
  <!-- JQuery Combobox [Categoria/Subcategoria] -->    
  <script type="text/javascript"> 
     $(document).ready(function(){
        $('#id_categoria_').change(function(){
            $('#id_subcategoria_').load('treinamento/subcategoria.php?id_categoria='+$('#id_categoria_').val() );
        });
     });
  </script> 
  
   <tr>
    <td><div align="right"><b>Categoria:</b></div></td>
    <td>
            <select name="id_categoria_" id="id_categoria_">
                <option value="0">--- Selecione ---</option>
                <?
                include("banco/conecta.php");
                $categorias=mysql_query("select * from tb_categoria order by categoria asc;");
                while($dados1 = mysql_fetch_array($categorias)) {
                        $id_categoria = $dados1['id_categoria'];
                        $categoria = $dados1['categoria'];
                        ?>
                           <option value="<?=$id_categoria?>" <?=($id_categoria==$pes_id_categoria)?"selected='selected'":""?> > <?=$categoria?> </option>
                        <?
                }
                ?>
            </select>
    </td>  
  </tr>
  
<? if($pes_id_categoria == null) { // QUANDO É SELECIONADO ALGO EM 'CATEGORIA' ?>
  <tr>
    <td><div align="right"><b>Subcategoria:</b></div></td>
    <td>
            <select name="id_subcategoria_" id="id_subcategoria_">
                <option value="0" disabled="disabled">Aguardando Categoria...</option> 
            </select>
    </td>  
  </tr>
  
<? } else { // VEM DIRETO DO BANCO, SEM A SELECAO DA 'CATEGORIA' ?>
  <tr>
    <td><div align="right"><b>Subcategoria:</b></div></td>
    <td>
            <select name="id_subcategoria_" id="id_subcategoria_">
                <?
                include("banco/conecta.php");
                $subcategorias=mysql_query("select * from tb_subcategoria where sub_id_categoria='$pes_id_categoria' order by subcategoria asc;");
                while($dados2 = mysql_fetch_array($subcategorias)) {
                        $id_subcategoria = $dados2['id_subcategoria'];
                        $subcategoria = $dados2['subcategoria'];
                        ?>
                           <option value="<?=$id_subcategoria?>" <?=($id_subcategoria==$pes_id_subcategoria)?"selected='selected'":""?> > <?=$subcategoria?> </option>
                        <?
                }
                ?>    
            </select>
    </td> 
  </tr>
<? } ?>
  
  <tr>
    <td><div align="right"><b>Fone Celular: </b></div></td>
    <td><input type="text" name="fone_cel_" class="minusculo" maxlength="40" value="<?=($fone_cel==null)?"":$fone_cel?>" size="15"/></td>
  </tr> 
  <tr>
    <td><div align="right"><b>E-mail: </b></div></td>
    <td><input type="text" name="email_" class="minusculo" maxlength="40" value="<?=($email==null)?"":$email?>" size="40"/>&nbsp; <span class="legenda-form">*</span></td>
  </tr>  
  <tr>
    <td><div align="right"><b>Data de Nascimento: </b></div></td>
    <td><input type="text" name="data_nasc_" class="minusculo" maxlength="40" value="<?=($data_nasc==null)?"":$data_nasc?>" size="15"/></td>
  </tr>
  <tr>
    <td><div align="right"><b>Facebook: </b></div></td>
    <td><input type="text" name="facebook_" class="campo" maxlength="40" value="<?=($facebook==null)?"":$facebook?>" size="40"/></td>
  </tr>    
  <tr>
    <td><div align="right"><b>Sexo: </b></div></td>
    <td>
    	<input type="radio" accesskey="m" name="sexo_" tabindex="1" value="m" <?=$sex_m?> /> Masculino  
    	&nbsp;&nbsp;&nbsp;
    	<input type="radio" accesskey="f" name="sexo_" tabindex="2" value="f" <?=$sex_f?> /> Feminino    
    </td>
  </tr> 
  <? if($_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==10){ ?>
  <tr>
    <td><div align="right"><b>Prova: </b></div></td>
    <td>
    	<input type="radio" accesskey="s" name="prova_" tabindex="1" value="s" <?=$prova_s?> /> Sim  
    	&nbsp;&nbsp;&nbsp;
    	<input type="radio" accesskey="n" name="prova_" tabindex="2" value="n" <?=$prova_n?> /> Não    
    </td>
  </tr> 
 
  <?
	include("banco/conecta.php");
        $agendamentos = mysql_query("select descricao from tb_prova_agenda where id_prova_agenda='$id_prova_agenda';");
        $dados4=mysql_fetch_array($agendamentos);
            $descricao=$dados4["descricao"];  
  ?>
  <tr>
       <td><div align="right"><b>Prova Agendada: </b></div></td>
       <td><a href='index.php?menu=treinamento/provaAgendamento&id=<?=$id_prova_agenda?>&acao=altera'><?=$id_prova_agenda."-".$descricao?></a></td>      
       <!-- <td><input type="text" name="id_prova_agenda_" class="maiusculo" value="<?=$id_prova_agenda .'-'. $descricao?>" size="40" readonly /></td> -->
            
  </tr>   
  
  
  <tr>
    <td><div align="right"><b>Certificado: </b></div></td>
    <td>
    	<input type="radio" accesskey="s" name="certificado_" tabindex="1" value="s" <?=$certificado_s?> /> Sim  
    	&nbsp;&nbsp;&nbsp;
    	<input type="radio" accesskey="n" name="certificado_" tabindex="2" value="n" <?=$certificado_n?> /> Não    
    </td>
  </tr>  
  <tr>
    <td><div align="right"><b>Data de Cadastro: </b></div></td>
    <td><input type="text" name="data_cad_" class="minusculo" maxlength="40" value="<?=($data_cad==null)?"":$data_cad?>" size="20" readonly/></td>
  </tr>
  <tr>
    <td><div align="right"><b>Data Últ. Alteração: </b></div></td>
    <td><input type="text" name="data_alt_" class="minusculo" maxlength="40" value="<?=($data_alt==null)?"":$data_alt?>" size="20" readonly/></td>
  </tr>
  <? } ?>

  <? if($_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==10){ ?>
  <tr>
    <td valign="top"><div align="right" vertical-align="top"><b>Observação: </b></div></td>
    <td>
    	 <textarea cols="44" rows="5" class="campo" name="observacao_" style="overflow:inherit; border:1px solid #c3c3c3;"><?=($observacao==null)?"":$observacao?></textarea>
    </td>
  </tr> 
  <? } ?>
  
  <tr>
    <td><div align="right"></div></td>
    <td>
         <span class="legenda-form">* Campo obrigratório.</span>
         <br><span class="legenda-form">IES: Instituição de Ensino Superior.</span>
    </td>
  </tr>  
  
  <tr>
    <td colspan="2"><div align="center" >
      <br>
      <? if($id==null) { ?>
        <input type="submit" name="insere" value="Salvar" onclick="Acao('index.php?menu=cadastro/pessoa&id=<?=$idPessoa?>&acao=insere')"/>
      <? } ?> 
      <? if(($_SESSION["s_idPessoa"]==$id) || $_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==10){ ?>
        <? if($id != null) { ?>
            <input type="submit" name="altera" value="Alterar Dados" onclick="Acao('index.php?menu=cadastro/pessoa&id=<?=$id_pessoa?>&acao=altera')"/>
            <? if($_SESSION["s_idPessoa"]==$id){ ?>
                <input type="submit" name="alteraSenha" value="Alterar Senha" onclick="Acao('index.php?menu=usuario/usu_altera_senha1')"/>
            <? } ?>
            <? if($_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==10){ ?>
                <input type="submit" name="relatorio" value="Relatório" onclick="Acao('index.php?menu=treinamento/relatIndividual&id=<?=$id_pessoa?>')"/>
                <input type="submit" name="export_relatorio" value="Export.Relatório" onclick="Acao('index.php?menu=treinamento/relatExportacaoIndividual&id=<?=$id_pessoa?>')"/>
                <input type="submit" name="bloquear" value="Bloquear" onclick="Acao('index.php?menu=cadastro/pessoa&idex=<?=$id_pessoa?>&acao=bloqueia')"/>
                <input type="submit" name="reenvio" value="Reenviar Senha" onclick="Acao('index.php?menu=cadastro/pessoaReenviaSenha&id=<?=$id_pessoa?>')"/>
            <? } ?>
            <? if($_SESSION["s_idPessoa"]==$id || $_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==10){ ?>
                <input type="submit" name="foto" value="Foto" onclick="Acao('index.php?menu=cadastro/pessoaFoto&id_p=<?=$id_pessoa?>&acao=alteraFoto')"/>
            <? } ?>
                
                
        <? } ?>
      <? if($acao == "inativo" && ($_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==10)){ ?>          
            <input type="submit" name="ativo" value="Ativo" onclick="Acao('index.php?menu=cadastro/pessoa&id=<?=$id_pessoa?>&acao=ativo')"/>
      <? } ?>
      <? if($acao != "inativo" && ($_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==10)){ ?>          
            <input type="submit" name="temporario" value="Temporário" onclick="Acao('index.php?menu=cadastro/pessoaTemporario')"/>
            <input type="submit" name="inativo" value="Inativo" onclick="Acao('index.php?menu=cadastro/pessoaInativo')"/>
      <? } ?>
      <? if($_SESSION["s_permissao"]==10){ ?>          
            <!-- <input type="submit" name="avancado" value="Avançado" onclick="Acao('index.php?menu=cadastro/pessoaAutenticacao&id=<?=$id_pessoa?>')"/> -->
      <? } ?>
            
      <? } ?>
      <input type="submit" name="limpa"  value="Limpar" onclick="Acao('index.php?menu=cadastro/pessoa')"/>
    </div></td>
    </tr>
</table>
</FORM>

<? // ============ CONSULTA =============== ?>


<? if($_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==10){ ?>
<br><br>
<FORM id="form" method="POST" action="index.php?menu=cadastro/pessoa&acao=pesquisa"> 
<table width="100" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td align="right">Nome: </td>
    <td>
		<input tabindex="1" type="text" name="pNome" size="20" class="maiusculo" />	</td>
    <td rowspan="2"> 
                <input tabindex="2" type="submit" name="pesquisar" value="::: Pesquisar :::" />
    </td>
  </tr>

</table>
</FORM>



<?

	// ABRE CONEXAO COM BANCO
	include("banco/conecta.php");
	$pNome=trim(strtoupper($_POST["pNome"])); 
        echo "<br>Pesquisa......: <b>" . $pNome . "</b>";
        
        //REALIZA UM SELECT NA TABELA
        if($acao == "ativo") {
            $pessoas=mysql_query("select P.*, A.situacao, A.id_pessoa from tb_pessoa P, tb_autenticacao A where P.id_pessoa=A.id_pessoa and A.situacao='a' order by P.nome asc");
	} 
        
        if($acao == "inativo") {
            $pessoas=mysql_query("select P.*, A.situacao, A.id_pessoa from tb_pessoa P, tb_autenticacao A where P.id_pessoa=A.id_pessoa and A.situacao='i' order by P.nome asc");
	} 
        
        if($acao == "pesquisa"){
            $pessoas=mysql_query("select P.*, A.situacao, A.id_pessoa from tb_pessoa P, tb_autenticacao A where (P.id_pessoa=A.id_pessoa and A.situacao='a' AND nome LIKE '%$pNome%') order by P.nome asc;");
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
          <td class="titulo_meio" align="center">Foto</td>	  
          <td class="titulo_meio" align="center">Nome</td>	  
          <td class="titulo_meio" align="center">Apelido</td>
  	  <td class="titulo_meio" align="center">Sexo</td>
  	  <td class="titulo_meio" align="center">Propriedade</td>
  	  <td class="titulo_meio" align="center">Cidade</td>
  	  <td class="titulo_meio" align="center">Telefone</td> 
          <td class="titulo_dir" align="center">E-mail</td> 
</tr>
</thead>
<tbody align="left">
<?php
    for ($i=0;$i<$ndados;$i++){
    //DECOBRIR O TAMANHO DO ARRAY
    $dados=mysql_fetch_array($pessoas);
    //POVOAR A TABELA COMO DADOS VINDOS DO BANCO
    $id_pessoa=$dados["id_pessoa"];
    $nome=$dados["nome"];
    $apelido=$dados["apelido"];
    $propriedade=$dados["propriedade"];
    $foto=$dados["foto"];
    $cidade=$dados["cidade"];
    $fone_cel=$dados["fone_cel"];
    $email=$dados["email"]; 
    $sexo=$dados["sexo"];
echo "
	<tr $corFundo>
		<td class='conteudo_c'>&nbsp;<img src='$foto' width='30' border='1'>&nbsp;</td>
                <td><a href='index.php?menu=cadastro/pessoa&id=$id_pessoa'>$nome &nbsp;</a></td>
                <td>$apelido &nbsp;</td>
                <td class='conteudo_c'>$sexo</td>
                <td>$propriedade &nbsp;</td>
                <td>$cidade &nbsp;</td>
                <td>$fone_cel &nbsp;</td>
		<td>$email &nbsp;</td>
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
    
    r.field.fone_cel_ = "\\d-() ";
    r.mask.fone_cel_ = "(##) #####-####";  

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
      document.getElementById("nome_").focus(); 
    }    

    //]]>
</script>

<?
	// fecha o ELSEIF ELSE
	} else {
                // SEGURANï¿½A - PEGA URL
                $server = $_SERVER['SERVER_NAME'];
                $uri = $_SERVER ['REQUEST_URI'];
                $segurancaURL = "http://" . $server . $uri; 
		//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=usuario/sair&segurancaURL=$segurancaURL'>";
	}
?>