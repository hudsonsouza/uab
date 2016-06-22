<?php 
  session_start(); 
?>


        <div id="menu-celula">
            <ul id="barra" class="menubar" style="text-align:center">

                <li class="menuvertical"><a href='index.php?menu=home' alt="Página Principal" title="Página Principal">Home</a></li> 

                    <?php
                            if( ($_SESSION['s_permissao'] >= 1) &&  ($_SESSION['s_permissao'] <= 9) ){
                                    include('menu_privado.php');
                            };
                    ?>
               
               <li class="menuvertical"><a href='index.php?menu=destaque&acao=normal' alt="Destaques" title="Destaques">Destaques</a></li> 
               <li class="menuvertical"><a href='index.php?menu=localizacao' alt="Localização" title="Localização">Localização</a></li> 
               <li class="menuvertical"><a href='index.php?menu=historico' alt="Histórico" title="Histórico">Histórico</a></li> 
               <li class="menuvertical"><a href='index.php?menu=norma' alt="Normas" title="Normas">Normas</a></li> 
               <li class="menuvertical"><a href='index.php?menu=legislacao' alt="Legislação" title="Legislação">Legislação</a></li> 
               <li class="menuvertical"><a href='index.php?menu=estrutura' alt="Estrutura" title="Estrutura">Estrutura</a></li> 
               <li class="menuvertical"><a href='index.php?menu=equipe' alt="Equipe" title="Equipe">Equipe</a></li> 
               <li class="menuvertical"><a href='index.php?menu=parceiro' alt="Parceiros" title="Parceiros">Parceiros</a></li> 
               <li class="menuvertical"><a href='index.php?menu=download' alt="Downloads" title="Downloads">Downloads</a></li> 

               <li class="menuvertical"><a href="#">Cursos</a>
                  <ul id="nav" class="menu">
                        <li class="submenu"><a href='index.php?menu=curso/divulgacao' alt="Divulgação" title="Divulgação">Divulgação</a></li> 
                        <li class="submenu"><a href='index.php?menu=curso/tecnico' alt="Técnico" title="Técnico">Técnico</a></li> 
                        <li class="submenu"><a href='index.php?menu=curso/graduacao' alt="Graduação" title="Graduação">Graduação</a></li> 
                        <li class="submenu"><a href='index.php?menu=curso/especializacao' alt="Especialização" title="Especialização">Especialização</a></li> 
                  </ul>
               </li>               

               <li class="menuvertical"><a href="#">Administrativo</a>
                  <ul id="nav" class="menu">
                        <li class="submenu"><a href='index.php?menu=administrativo/demanda' alt="Demanda" title="Demanda">Demanda</a></li> 
                        <li class="submenu"><a href='index.php?menu=curso/telefone' alt="Telefone" title="Telefone">Telefone</a></li> 
                  </ul>
               </li>               

               <li class="menuvertical"><a href='index.php?menu=contato' alt="Contato" title="Contato">Contato</a></li> 
            </ul>
        </div>
