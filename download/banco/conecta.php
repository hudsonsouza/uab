<?
  // SERVIDOR SEDUC
  // SITE: http://db.paranavai.pr.gov.br/
  // Usuario: seduc
  // Senha: educ01
  // mysql_connect ("localhost", "seduc", "educ01") or die ('Falha na conecção ao Banco de Dados SERVIDOR ' . mysql_error());
  // mysql_select_db ("seduc");

  // LOCALHOST
  //mysql_connect("localhost", "root", "mengao") or die ('Falha na conecção ao Banco de Dados LocalHost ' . mysql_error());
  
  // FORNET
  mysql_connect("localhost", "seduc", "educ01") or die ('Falha na conecção ao Banco de Dados LocalHost ' . mysql_error());
  mysql_select_db("seduc");
?>
