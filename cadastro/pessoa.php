<?php
    $id=$_GET["id"];
    session_start();
    if (!isset($_SESSION['s_login'])) {
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?menu=usuario/login'>";
    } elseif(($_SESSION["s_idPessoa"]==$id) || ($_SESSION["s_permissao"]==3) || ($_SESSION["s_permissao"]==5) || ($_SESSION["s_permissao"]==7) || ($_SESSION["s_permissao"]==9) ){
?>


<br><br>
<div class="titulo">CADASTRO DE PESSOAS</div>
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
	include("cadastro/pessoaRecuperaForm.php");
        $preenchimento=TRUE;
        
        if( !empty($email) ){  // CAMPO EMAIL NAO VAZIO        

                    // VERIFICA EMAIL JA CADASTRADO
                    $verificaEmail=FALSE;
                    include("banco/conecta.php");
                    $qtdEmail = mysql_query("SELECT email FROM tb_pessoa WHERE email='$email';");
                    $ndados=mysql_num_rows($qtdEmail);
                    if($ndados==0)
                       $verificaEmail=TRUE;

            
            if($verificaEmail==TRUE){
            
                    if(!empty($nome) && !empty($sexo) && !empty($data_nasc) && !empty($fone) && !empty($email) && !empty($cidade) && !empty($login) && !empty($senha)){  // CAMPO EMAIL NAO VAZIO        
                            $senhaMD5 = MD5($senha);
                            mysql_query("INSERT INTO tb_pessoa (id_pessoa , nome , sexo , data_nasc , fone , email , cidade , login , senha , permissao , situacao ) VALUES (null, '$nome', '$sexo', '$data_nasc', '$fone', '$email', '$cidade', '$login', '$senhaMD5', 1, 'a' )");
                            mysql_query("commit");
                            mysql_close();
                            echo "<div class=msg><br>.:: Cadastro inserido sucesso ! ::.<br><br></div>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='10; URL=index.php?menu=cadastro/pessoa'>";	
                            $preenchimento=FALSE;

                    } else {
                        // EMAIL JA EXISTENTE
                        echo "<div class=msgERRO><br>.:: O preenchimento de todos os campos são obrigatórios! ::.<br><br></div>";
                    }
            } else {
                // CAMPO EMAIL ESTÁ VAZIO
                echo "<div class=msgERRO><br>.:: EMAIL já cadastrado, informe outro email! ::.<br><br></div>";
            }

        
        } else {
            // CAMPO EMAIL ESTÁ VAZIO
            //echo "<div class=msgERRO><br>.:: O preenchimento de todos os campos são obrigatórios! ::.<br><br></div>";
            echo "<div class=msgERRO><br>.:: O campo EMAIL é obrigatório! ::.<br><br></div>";
        }

                 
} else if ($id != null && $acao=="altera"){
	// echo "CADASTRO ALTERAR";
        include("cadastro/pessoaRecuperaForm.php"); 
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

    
<?php // ============= FORMULARIO ====================
if($preenchimento==TRUE){
    include("cadastro/pessoaRecuperaForm.php");
    $data_nasc = formataData(converteData(trim(strtolower($_POST["data_nasc_"]))),"br");
}
?>    
    
<FORM id="form1" METHOD="POST" ACTION="./">
  <table width="900" border="0" cellspacing="5" class="corpoTab">
      
  <?php if($_SESSION["s_idPessoa"]==$id || $_SESSION["s_permissao"]==9 ){ ?>
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
    <td><div align="right"><b>Sexo: </b></div></td>
    <td>
    	<input type="radio" accesskey="m" name="sexo_" tabindex="1" value="m" <?=$sex_m?> checked="checked" /> Masculino  
    	&nbsp;&nbsp;&nbsp;
    	<input type="radio" accesskey="f" name="sexo_" tabindex="2" value="f" <?=$sex_f?> /> Feminino    
    </td>
  </tr> 
  <td><div align="right"><b>Data de Nasc: </b></div></td>
    <td><input type="text" name="data_nasc_" class="minusculo" maxlength="40" value="<?=($data_nasc==null)?"":$data_nasc?>" size="15"/></td>
  </tr>
  <tr>
    <td><div align="right"><b>Fone: </b></div></td>
    <td><input type="text" name="fone_" class="minusculo" maxlength="40" value="<?=($fone==null)?"":$fone?>" size="15"/></td>
  </tr> 
  <tr>
    <td><div align="right"><b>E-mail: </b></div></td>
    <td><input type="text" name="email_" class="minusculo" maxlength="40" value="<?=($email==null)?"":$email?>" size="40"/>&nbsp; <span class="legenda-form">*</span></td>
  </tr>  
  <tr>
  <tr>
    <td><div align="right"><b>Cidade-UF: </b></div></td>
    <td><input type="text" name="cidade_" class="maiusculo" value="<?=($cidade==null)?"":$cidade?>" size="40" /></td>
  </tr>
  <tr>
    <td><div align="right"><b>Login: </b></div></td>
    <td><input type="text" name="login_" class="minusculo" value="<?=($login==null)?"":$login?>" size="15" <?=($id_pessoa==null)?"":"readonly"?>  /></td>
  </tr>
  <?php if($id==null && $acao==null){ ?>
  <tr>
    <td><div align="right"><b>Senha: </b></div></td>
    <td><input type="text" name="senha_" value="<?=($senha==null)?"":$senha?>" size="15" /></td>
  </tr>
  <? } ?> 


  <?php if($id != null && $_SESSION["s_permissao"]>=5 ){ ?>
  <tr>
      <td><div align="right"><b>Permissão: </b></div></td>
      <td>
          <select name="permissao_" id="permissao_">
          <option value="1" <?=($permissao==1)?"selected='selected'":""?> >UAB</option>
          <option value="2" <?=($permissao==2)?"selected='selected'":""?> >Acadêmico</option>
          <option value="3" <?=($permissao==3)?"selected='selected'":""?> >Tutor</option>
          <option value="5" <?=($permissao==5)?"selected='selected'":""?> >Secretária</option>
          <option value="7" <?=($permissao==7)?"selected='selected'":""?> >Coordenadora</option>
          <option value="9" <?=($permissao==9)?"selected='selected'":""?> >T.I.</option>
        </select>
      </td>
  </tr>   
  <? } ?>
  
  
  <?php if($id != null && $_SESSION["s_permissao"]>=3 ){ ?>
  <tr>
      <td><div align="right"><b>Situação: </b></div></td>
      <td>
          <input type="radio" accesskey="a" name="situacao_" tabindex="1" value="a" <?=$sit_a?> checked="checked" />Ativo  
          &nbsp;&nbsp;&nbsp;
          <input type="radio" accesskey="i" name="situacao_" tabindex="2" value="i" <?=$sit_i?> />Inativo     
      </td>
  </tr>  
  <? } ?> 

  
  <tr>
    <td colspan="2"><div align="center" >
      <br>
      <?php if($id==null) { ?>
        <input type="submit" name="insere" value="Salvar" onclick="Acao('index.php?menu=cadastro/pessoa&id=<?=$idPessoa?>&acao=insere')"/>
      <? } ?> 
        
      
      <?php if(($_SESSION["s_idPessoa"]==$id) || $_SESSION["s_permissao"]==3 || $_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==7 || $_SESSION["s_permissao"]==9){ ?>
        <?php if($id != null) { ?>
            <input type="submit" name="altera" value="Alterar Dados" onclick="Acao('index.php?menu=cadastro/pessoa&id=<?=$id_pessoa?>&acao=altera')"/>
            <? if($_SESSION["s_idPessoa"]==$id || $_SESSION["s_permissao"]==9 ){ ?>
                <input type="submit" name="alteraSenha" value="Alterar Senha" onclick="Acao('index.php?menu=usuario/alteraSenha&id=<?=$id_pessoa?>')"/>
            <? } ?>
               
                
        <? } ?>
      <? if($acao == "inativo" && ($_SESSION["s_permissao"]==3 || $_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==7 || $_SESSION["s_permissao"]==9)){ ?>          
            <input type="submit" name="ativo" value="Ativo" onclick="Acao('index.php?menu=cadastro/pessoa&id=<?=$id_pessoa?>&acao=ativo')"/>
      <? } ?>
      <? if($acao != "inativo" && ($_SESSION["s_permissao"]==3 || $_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==7 || $_SESSION["s_permissao"]==9)){ ?>          
            <input type="submit" name="inativo" value="Inativo" onclick="Acao('index.php?menu=cadastro/pessoa&acao=inativo')"/>
      <? } ?>
            
      <? } ?>
            
            
      <input type="submit" name="limpa"  value="Limpar" onclick="Acao('index.php?menu=cadastro/pessoa')"/>
    
    </div></td>
    </tr>
</table>
</FORM>

<? // ============ CONSULTA =============== ?>


<?php if($_SESSION["s_permissao"]==3 || $_SESSION["s_permissao"]==5 || $_SESSION["s_permissao"]==7 || $_SESSION["s_permissao"]==9 ){ ?>
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



<?php

	// ABRE CONEXAO COM BANCO
	include("banco/conecta.php");
	$pNome=trim(strtoupper($_POST["pNome"])); 
        echo "<br>Pesquisa......: <b>" . $pNome . "</b>";
        
        //REALIZA UM SELECT NA TABELA
        if($acao == "ativo") {
            $pessoas=mysql_query("select * from tb_pessoa where situacao='a' AND nome LIKE '%$pNome%' order by nome asc;");
	} 
        
        if($acao == "inativo") {
            $pessoas=mysql_query("select * from tb_pessoa where situacao='i' AND nome LIKE '%$pNome%' order by nome asc;");
	} 
        
        if($acao == "pesquisa"){
            $pessoas=mysql_query("select * from tb_pessoa where situacao='a' AND nome LIKE '%$pNome%' order by nome asc;");
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
          <td class="titulo_meio" align="center">Nome</td>	  
  	  <td class="titulo_meio" align="center">&nbsp; Sexo &nbsp;</td>
  	  <td class="titulo_meio" align="center">Permissão</td>
  	  <td class="titulo_meio" align="center">Cidade</td>
  	  <td class="titulo_meio" align="center">Telefone</td> 
          <td class="titulo_dir" align="center">E-mail</td> 
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
    $id_pessoa=$dados["id_pessoa"];
    $nome=$dados["nome"];
    $sexo=$dados["sexo"];
        if($sexo=="m")
            $sex="Masc";
        else
            $sex="Fem";
    $cidade=$dados["cidade"];
    $fone=$dados["fone"];
    $email=$dados["email"]; 
    $permissao=$dados["permissao"];
        if($permissao==1)
            $perm="UAB";
        elseif($permissao==2)
            $perm="Acadêmico";
        elseif($permissao==3)
            $perm="Tutor";
        elseif($permissao==5)
            $perm="Secretária";
        elseif($permissao==7)
            $perm="Coordenadora";
        elseif($permissao==9)
            $perm="T.I.";
    
echo "
	<tr $corFundo>
                <td class='$fundo'><a href='index.php?menu=cadastro/pessoa&id=$id_pessoa'>$nome &nbsp;</a></td>
                <td class='$fundo_c'>$sex</td>
                <td class='$fundo'>$perm &nbsp;</td>
                <td class='$fundo'>$cidade &nbsp;</td>
                <td class='$fundo'>$fone &nbsp;</td>
		<td class='$fundo'>$email &nbsp;</td>
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
      document.getElementById("nome_").focus(); 
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