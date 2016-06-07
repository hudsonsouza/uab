<?php 
    $campoFoco = 'login';
?>

<br><br>
    <div class="titulo">ACESSO RESTRITO</div>
<br>

<center>

<br>
<FORM name="formulario" id="form" METHOD=POST ACTION="index.php?menu=usuario/valida_login">
  <table width="450" border="0" class="corpoTab">
  <tr>
    <td width="80"><div align="right">Login: </div></td>
    <td width="53"><input type="text" class="minusculo" id="login_" name="login_" /></td>
  </tr>
  <tr>
    <td><div align="right">Senha: </div></td>
    <td><input type="password" name="senha_" id="senha_" class="campo" /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <br><input name="submit" type="submit" value=".:: OK ::." />
    </div></td>
    </tr>
</table>
</FORM>

<br><br>
	<a href="index.php?menu=usuario/usu_esqueci_senha1">| Esqueci a Senha |</a>
</center>

<br><br>


<script type="text/javascript">
//<![CDATA[
    function campoFoco() {
      document.getElementById("login_").focus(); 
    }
//]]>
</script>
