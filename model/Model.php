<?php

/*
 * Etablie la connexion avec la base de donnée en fonction de config/Conf.php
 */

require_once File::build_path(array("config", "Conf.php"));

class Model
{
    private static $pdo = NULL;

    public static function init()
    {
        $hostname = Conf::getHostname();
        $dbname = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $login, $password
                , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getPDO()
    {
        if (is_null(self::$pdo))
            Model::init();
        return self::$pdo;
    }

}