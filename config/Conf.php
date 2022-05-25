<?php

/*
 * Répertorie les informations concernant la base de données
 */

class Conf
{
    static private $databases = array(
        //Nom de l'hote distant (webinfo pour l'iut)
        //localhost pour le local sur machine perso
        'hostname' => 'webinfo.iutmontp.univ-montp2.fr',

        //Le nom de la bdd (ici progweb mais sur l'iut martineze)
        'database' => 'martineze',

        //A l'iut martineze, perso : root
        'login' => 'martineze',

        //A l'iut 7092021, perso : root
        'password' => '7092021'
    );

    static public function getLogin()
    {
        return self::$databases['login'];
    }

    static public function getHostname()
    {
        return self::$databases['hostname'];
    }

    static public function getDatabase()
    {
        return self::$databases['database'];
    }

    public static function getPassword()
    {
        return self::$databases['password'];
    }

    // la variable debug est un boolean
    static private $debug = True;

    static public function getDebug()
    {
        return self::$debug;
    }
}

?>
