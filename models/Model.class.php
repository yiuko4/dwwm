<?php

abstract class Model{
    private static $pdo;

    private static function setBdd(){
        self::$pdo = new PDO("mysql:host=localhost;dbname=flo&lestortues;charset=utf8", "root", "");
        //self::$pdo = new PDO("mysql:yiukoftfboutique.mysql.db;dbname=yiukoftfboutique;charset=utf8", "yiukoftfboutique", "2945aC6818");
        //self::$pdo = new PDO("mysql:db5010871181.hosting-data.io;port=3306;dbname=dbs9194037;charset=utf8", "dbu2897545", "2945aC68/18");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function getBdd(){
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
}