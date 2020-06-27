<?php


class Db
{
    public static function getConnection(){
        //получение пути до файла с конфигурацией подключения к БД
        $paramsPath = ROOT.'/config/db_params.php';
        //подключаем конфигурацию БД
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->exec("set names utf8");

        return $db;
    }
}