<?php
require_once("../Domain/MyDataBase.php");

$config = parse_ini_file("../Config.ini");

$conexion = new myDataBase(
    $config["host"],
    $config["user"],
    $config["pass"],
    $config["database"]
);


?>