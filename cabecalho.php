<div id="cabecalho">
    <div id="usuario">
        <br><br><br><br><br><br><br><br><br><br><br>
            <?php
                //$ajustaHora=time()+14400;  // servidor +2h
                $ajustaHora=time()+0;
		$horario = date('H:m:s',$ajustaHora);
		if($horario>='06:00:00' && $horario<='11:59:59') {$periodo = "Bom Dia ";}
		if($horario>='12:00:00' && $horario<='17:59:59') {$periodo = "Boa Tarde ";}
		if($horario>='18:00:00' && $horario<='23:59:59') {$periodo = "Boa Noite ";}
		if($horario>='00:00:00' && $horario<='05:59:59') {$periodo = "Boa Madrugada ";}
		
		if($_SESSION['s_nome'] == ""){
			echo "$periodo <b>Visitante</b>" . "<a href='index.php?menu=usuario/login'> | Entrar |</a>";
                } else {
			$nomeMenu = $_SESSION['s_nome'];
			$idPessoaMenu = $_SESSION['s_idPessoa'];
			echo "$periodo <a href='index.php?menu=cadastro/pessoa&id=$idPessoaMenu' title='Editar Perfil'  alt='Editar Perfil'><b>$nomeMenu</b></a>" . "<a href='index.php?menu=usuario/sair&acao=saindo'> | Sair |</a>";
                        
		}
            ?>        
    </div>
</div>