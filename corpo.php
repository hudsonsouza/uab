<?php
if ($_GET["menu"] <> null) {
    include ($_GET["menu"] . ".php");
} else {
    //include ("destaque&acao=normal");
    include ("destaque.php");
    //include ("home.php");
}