<?php
define('USER',"root");
define('PASSWD',"");
define('SERVER',"localhost");
define('BASE',"bdjoueurs");

$dsn = "mysql:host=".SERVER.";dbname=".BASE;
try{
    //$con = new PDO($dsn, USER, PASSWD);
    $Con = new PDO($dsn ,USER, PASSWD);

   // $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $Con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}

catch(PDOException $e){

    printf("Echec de la connexion: %s\n", $e->getMessage());
    exit();

}

if ($Con == null) 
{ echo("eror") ; }
   


?>