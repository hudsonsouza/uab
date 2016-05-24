<br>
<div class="titulo">
	Contatos
</div>

<br>

<center>	

  <FORM id="form" action="http://php.fornet.com.br/cgi-bin/formmail.cgi" method="POST"> 
    <INPUT type="hidden" name="recipient" value="uab@paranavai.pr.gov.br">
    <INPUT type="hidden" name="subject" value="Contato Via Internet">
    <INPUT type="hidden" name="env_report" value="REMOTE_HOST">
    <INPUT type="hidden" name="title" value="UAB - Polo Paranavaí">
    <INPUT type="hidden" name="return_link_title" value="VOLTAR">	
    <INPUT type="hidden" name="return_link_url" value="http://www.paranavai.pr.gov.br/uab/index.php"> 

	

		<table width="680" border="0" align="center" cellspacing="10" bgcolor="#FFFFFF">
            <tr>
              <td width="255" bordercolor="#FFFFFF"><div align="right"><strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Nome :</font></strong></div></td>
              <td width="418" bordercolor="#FFFFFF"><div align="left">
                <input name="NOME" type="text" id="NOME" size="50" maxlength="100">
              </div></td>
            </tr>
            <tr>
              <td width="255" bordercolor="#FFFFFF"><div align="right"><strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">E-mail :</font></strong></div></td>
              <td width="418" bordercolor="#FFFFFF"><div align="left">
                <input class="minusculo" name="E-MAIL" type="text" id="E-MAIL" size="50" maxlength="100">
              </div></td>
            </tr>
            <tr>
              <td width="255" bordercolor="#FFFFFF"><div align="right"><strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Fone :</font></strong></div></td>
              <td width="418" bordercolor="#FFFFFF"><div align="left">
                <input name="FONE" type="text" id="FONE" size="14" maxlength="120">
              </div></td>
            </tr>
            <tr>
              <td width="255" valign="top" bordercolor="#FFFFFF"><div align="right"><strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Assunto :</font></strong></div></td>
              <td width="418" bordercolor="#FFFFFF"><div align="left">
                <input name="ASSUNTO" type="text" id="ASSUNTO" value="" size="50" maxlength="100">
              </div></td>
            </tr>
            <tr>
              <td width="255" valign="top" bordercolor="#FFFFFF"><div align="right"><strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Mensagem :</font></strong></div></td>
              <td bordercolor="#FFFFFF"><div align="left">
                  <textarea name="MENSAGEM" cols="65" rows="10" id="MENSAGEM"></textarea>
              </div></td>
            </tr>
            <tr>
              <td colspan="3" bordercolor="#FFFFFF"><div align="right"></div>                
              <div align="center">
                <input type="submit" value="Enviar">
                &nbsp;&nbsp;&nbsp;
                <input  type="reset" value="Limpar">
                <br>
              </div></td>
            </tr>
    </table>
</FORM>
   
</center>

<br><br>
          <script type="text/javascript">
            //<![CDATA[

            var r = new Restrict("form");

            r.field.FONE = "\\d-() ";
            r.mask.FONE = "(##) ####-####";
    
            r.onKeyRefuse = function(o, k){
            o.style.backgroundColor = "#F0B7A4";
            }
            r.onKeyAccept = function(o, k){
            if(k > 30)
            o.style.backgroundColor = "#FFFFFF";
            }
            r.start();

            //]]>
        </script>