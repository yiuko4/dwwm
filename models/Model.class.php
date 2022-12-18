<?php

abstract class Model{
    private static $pdo;

    private static function setBdd(){
        self::$pdo = new PDO("mysql:host=localhost;dbname=flo&lestortues;charset=utf8", "root", "");
        //OVH
        //self::$pdo = new PDO("mysql:host=yiukoftfboutique.mysql.db;dbname=yiukoftfboutique;charset=utf8", "yiukoftfboutique", "2945aC6818");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function getBdd(){
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
}

