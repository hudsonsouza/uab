<?php
if ($_GET["menu"] <> null) {
    include ($_GET["menu"] . ".php");
} else {
    include ("home.php");
}