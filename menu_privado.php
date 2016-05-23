<?php
    session_start();
    if (!isset($_SESSION['s_login'])) {
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?menu=usuario/login'>";
    } elseif( ($_SESSION['s_permissao']==3) || ($_SESSION['s_permissao']==4) || ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==10) ){
?>


<? if( ($_SESSION['s_permissao']>=4) && ($_SESSION['s_permissao']<=10) ){ ?>

   <li class="menuvertical"><a href="#">Cadastro</a>
      <ul id="nav" class="menu">
      <? if( ($_SESSION['s_permissao']>=4) && ($_SESSION['s_permissao']<=10) ){ ?> 
        <li class="submenu"><a href='index.php?menu=cadastro/pessoa' alt="Avaliador" title="Avaliador">Avaliador</a></li> 
        <li class="submenu"><a href='index.php?menu=seminario/cadastro' alt="Seminário" title="Seminário">Seminário</a></li> 
      <? } ?>
      <? if( ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==7) || ($_SESSION['s_permissao']==10) ){ ?> 
        <li class="submenu"><a href='index.php?menu=cadastro/categoria' alt="Categoria" title="Categoria">Categoria</a></li> 
      <? } ?>
      <? if($_SESSION['s_permissao']==10){ ?> 
        <li class="submenu"><a href='index.php?menu=cadastro/cultura' alt="Cultura" title="Cultura">Cultura</a></li> 
        <li class="submenu"><a href="#">Imagem</a>
             <ul>
                <li><a href='index.php?menu=treinamento/imagemConsulta' alt="Lista Imagens" title="Lista Imagens">Lista de Imagens</a></li> 
                <li><a href='index.php?menu=treinamento/imagemConsulta&acao=inativo' alt="Lista Imagem Inativa" title="Lista Imagem Inativa">Lista Imagem Inativa</a></li> 
                <li><a href='index.php?menu=treinamento/bcoImagem&acao=confInicial' alt="Uplad" title="Uplad">Upload Imagem</a></li>                 
             </ul> 
        </li>
      <? } ?>  
      <? if($_SESSION['s_permissao']==5 || $_SESSION['s_permissao']==7 || $_SESSION['s_permissao']==10){ ?> 
        <li class="submenu"><a href="#">Prova</a>
             <ul>
                <li><a href='index.php?menu=treinamento/provaAgendamento' alt="Novo Agendamento" title="Novo Agendamento">Novo Agendamento</a></li> 
                <li><a href='index.php?menu=treinamento/provaListaAgendamento' alt="Prova Lista Agendamento" title="Prova Lista Agendamento">Editar Agendamento</a></li> 
                <li><a href='index.php?menu=treinamento/relatProvaAgendamento1' alt="Prova Avaliação" title="Prova Avaliação">Avaliação</a></li>  
             </ul> 
        </li>
      <? } ?> 
      <? if( ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==6) || ($_SESSION['s_permissao']==7) || ($_SESSION['s_permissao']==10) ){ ?> 
        <li class="submenu"><a href="#">Idioma</a>
             <ul>
                <li><a href='index.php?menu=cadastro/idioma' alt="Tipos de Idioma" title="Tipos de Idioma">Tipos de Idioma</a></li> 
                <li><a href='index.php?menu=cadastro/traducao&barra=barraFormatacao' alt="Tradução" title="Tradução">Tradução</a></li> 
             </ul> 
        </li>          
      <? } ?>        
        
        
      
      </ul>
   </li>

<? } ?> 
   


<? if( ($_SESSION['s_permissao']==3) || ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==10) ){ ?>
   <li class="menuvertical"><a href="#">Treinamento</a>
      <ul id="nav" class="menu">
      <li class="submenu"><a href='index.php?menu=treinamento/treinamentoConf' alt="Configuração do Treinamento" title="Configuração do Treinamento">Início</a></li>
      <li class="submenu"><a href='index.php?menu=treinamento/provaAgendaUsuario' alt="Agendamento de Prova" title="Agendamento de Prova">Agendamento de Prova</a></li>
      </ul>
   </li>
<? } ?> 
   
   
   <?
   // MENU PRIVADO DE PROVA DO USUÁRIO ABILITADO
   $id_pessoa = $_SESSION['s_idPessoa'];
   include("banco/conecta.php");
   $pessoas=mysql_query("SELECT id_pessoa, prova, id_prova_agenda FROM tb_pessoa where id_pessoa='$id_pessoa' limit 1;");
   if($pessoas){
        $dados = mysql_fetch_array($pessoas);
        $id_pessoa=$dados["id_pessoa"];
        $prova=$dados["prova"];
        $id_prova_agenda=$dados["id_prova_agenda"];
   }
   
   if($prova=="s"){
       //include("banco/conecta.php");
       $provas=mysql_query("SELECT data_inicio, data_termino FROM tb_prova_agenda where id_prova_agenda='$id_prova_agenda' limit 1;");
       if($provas){
            $dados2 = mysql_fetch_array($provas);
            $data_inicio = formataData($dados2["data_inicio"], "usa");
            $data_termino = formataData($dados2["data_termino"], "usa");
       }

       $data_hj = data_aaaammdd();
       $pessoa="false";
       $_SESSION["s_avaliador"]="false";
       if( ($data_hj >= $data_inicio) && ($data_hj <= $data_termino) ) { 
           $pessoa="true"; 
           $_SESSION["s_avaliador"]="true";
               if( ($_SESSION['s_permissao']==3 && $pessoa=="true") ){ ?>
                    <li class="menuvertical"><a href='index.php?menu=treinamento/prova&idpa=<?=$id_prova_agenda?>&id=<?=$id_pessoa?>' alt="Prova" title="Prova">Prova</a></li> 
<?             }
       }
   }
?>
  
                    
   
   <?
   // MENU PRIVADO MEMBRO NBA
   
   $categoria1=="NBA-UEM";
   $_SESSION['s_nba_uem'] == "s";
   
   ?>                   
                    
<? if( ($_SESSION['s_nba_uem'] == "s") && ($_SESSION['s_permissao']==3) || ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==10) ){ ?>
   <li class="menuvertical"><a href="#">Membro NBA</a>
      <ul id="nav" class="menu">
      <li class="submenu"><a href='index.php?menu=cadastro/pessoaNBA' alt="Membro NBA" title="Mambro NBA">Ficha Cadastral</a></li>
      <li class="submenu"><a href='index.php?menu=cadastro/pessoaNBAMembroAtivo' alt="Membro Ativo" title="Mambro Ativo">Membro Ativo</a></li>
      <li class="submenu"><a href='index.php?menu=cadastro/pessoaNBAMembroEgresso' alt="Membro Egresso" title="Mambro Egresso">Membro Egresso</a></li>
      <li class="submenu"><a href='index.php?menu=cadastro/pessoaNBAMembroInativo' alt="Membro Inativo" title="Mambro Inativo">Membro Inativo</a></li>

      
      </ul>
   </li>   
<? } ?>    
                    
              
                   
<? if( ($_SESSION['s_permissao']==3) || ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==10) ){ ?>
   <li class="menuvertical"><a href="#">Relatórios</a>
      <ul id="nav" class="menu">
      <li class="submenu"><a href='index.php?menu=treinamento/relatRankingComExperiencia' alt="Ranking Com Experiência" title="Ranking Com Experiência">Ranking Com Experiência</a></li>
      <li class="submenu"><a href='index.php?menu=treinamento/relatRankingSemExperiencia' alt="Ranking Sem Experiência" title="Ranking Sem Experiência">Ranking Sem Experiência</a></li>
      <li class="submenu"><a href='index.php?menu=treinamento/relatIndividual&id=<?=$_SESSION["s_idPessoa"]?>' alt="Relatório Individual" title="Relatório Individual">Relatório Individual</a></li>
      <? if( ($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==7) || ($_SESSION['s_permissao']==10) ){ ?> 
        <li class="submenu"><a href='index.php?menu=treinamento/relatGeralDetalhado' alt="Relatório Geral Detalhado" title="Relatório Geral Detalhado">Relatório Geral Detalhado</a></li> 
        <li class="submenu"><a href='index.php?menu=treinamento/relatGeralAgrupado' alt="Relatório Geral Agrupado" title="Relatório Geral Agrupado">Relatório Geral Agrupado</a></li> 
        <li class="submenu"><a href='index.php?menu=treinamento/relatExportacaoGeral' alt="Relatório Exportação Geral" title="Relatório Exportação Geral">Relat Exportação Geral</a></li> 
        <li class="submenu"><a href='index.php?menu=treinamento/relatExportacaoIndividual&id=<?=$_SESSION["s_idPessoa"]?>' alt="Relatório Exportação Individual" title="Relatório Exportação Individual">Relat Exportação Individual</a></li> 
        <li class="submenu"><a href='index.php?menu=treinamento/relatCatSubcatPessoa' alt="Relatório Categoria e Subcategoria - Geral" title="Relatório Categoria e Subcategoria - Geral">Relatório de Categoria</a></li> 
        <li class="submenu"><a href='index.php?menu=treinamento/relatProvaAgendamento1' alt="Relatório Prova Agendamento" title="Relatório Prova Agendamento">Relatório de Provas</a></li> 
        <li class="submenu"><a href='index.php?menu=suporte/relatControleAcesso' alt="Controle de Acesso" title="Controle de Acesso">Relat Controle de Acesso</a></li> 
      <? } ?>
      </ul>
   </li>   
<? } ?>    
   
   
   
   
   
<? if(($_SESSION['s_permissao']==10)){ ?>

   <li class="menuvertical"><a href="#">Suporte</a>
      <ul id="nav" class="menu">
            <li class="submenu"><a href='index.php?menu=suporte/pessoaPermissoes' alt="Membros" title="Membros">Membros Permissões</a></li> 
            <li class="submenu"><a href='index.php?menu=bkp/backup' alt="Backup" title="Backup">Backup Automático</a></li> 
            <li class="submenu"><a href='index.php?menu=banco/backup' alt="Backup" title="Backup">Backup</a></li> 
            <li class="submenu"><a href='index.php?menu=banco/backup-consulta' alt="Backup" title="Backup">Consulta Backup</a></li> 
            <li class="submenu"><a href='index.php?menu=suporte/quemSou' alt="Quem sou eu" title="Quem sou eu">Quem Sou</a></li> 
            <li class="submenu"><a href='index.php?menu=suporte/imprimePDF' title="Imprime PDF" alt="Imprime PDF">Imprime PDF</a></li>
            <li class="submenu"><a href='index.php?menu=treinamento/relatIndividualPdf' title="Relat. Individual PDF" alt="Relat. Individual PDF">Relat. Individual PDF</a></li>
            <li class="submenu"><a href='http://www.hudsonss.com.br/sitav/suporte/excel1.php' title="Excel" alt="Excel">Excel 1</a></li>
            <li class="submenu"><a href='index.php?menu=suporte/excel2' title="Excel" alt="Excel">Excel 2</a></li>
            <li class="submenu"><a href='index.php?menu=suporte/contato2' title="Contato 2" alt="Contato 2">Contato 2</a></li>
            <li class="submenu"><a href='index.php?menu=suporte/acertoTP' title="TP" alt="TP">Acerto TP</a></li>
      </ul>
   </li>

<? } ?>

    
    
<? if(($_SESSION['s_permissao']==5) || ($_SESSION['s_permissao']==6) || ($_SESSION['s_permissao']==10)){ ?>

   <li class="menuvertical"><a href="#">Seminário</a>
      <ul id="nav" class="menu">
            <li class="submenu"><a href='index.php?menu=seminario/cadastro' alt="Cadastro" title="Cadastro">Cadastro</a></li> 
            <li class="submenu"><a href='index.php?menu=seminario/agenda' alt="Agenda" title="Agenda">Agenda</a></li> 
            <li class="submenu"><a href='index.php?menu=seminario/avaliacao' alt="Avaliação" title="Avaliação">Avaliação</a></li> 
            <? if( $_SESSION['s_permissao']==5 || $_SESSION['s_permissao']==10 ){ ?>
                <li class="submenu"><a href='index.php?menu=seminario/relatCatSubcatSeminario' alt="Relatório Categoria e Subcategoria - Geral" title="Relatório Categoria e Subcategoria - Geral">Relatório de Categoria</a></li>                
                <li class="submenu"><a href='index.php?menu=seminario/configuracao' alt="configuracao" title="Configuração">Configuração</a></li> 
            <? } ?>
      </ul>
   </li>

<? } ?>
 
   
   
<? if( $_SESSION['s_permissao']==3 || $_SESSION['s_permissao']==5 || $_SESSION['s_permissao']==7 || $_SESSION['s_permissao']==10 ){ ?>
    <li class="menuvertical"><a href='index.php?menu=chat/index' alt="Chat online" title="Chat online">Chat online</a></li> 
<? } ?>
 
   
   
   
<?
	// fecha o ELSEIF ELSE
	} else {
                // SEGURANCA - PEGA URL
                $server = $_SERVER['SERVER_NAME'];
                $uri = $_SERVER ['REQUEST_URI'];
                $segurancaURL = "http://" . $server . $uri; 
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php?menu=usuario/sair&segurancaURL=$segurancaURL'>";
	}
?>
 
