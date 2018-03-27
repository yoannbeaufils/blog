<?php
class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=gretaxao_yoannbp4;charset=utf8', 'gretaxao_yoannb', 'yoannb2017',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}
