<?php

class DB{
    static public function conectar(){
        require "config.php";
        try{
            $pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$database."", $user , $pass);
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
            $pdo -> exec("set names utf8");
            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }

}
