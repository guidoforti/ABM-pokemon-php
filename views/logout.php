<?php
session_start();
session_destroy();

header("Location: pokedexList.php");
exit;