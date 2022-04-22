<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>

    <?php

        class Conf {
            static private $databases = array (
            //Nom de l'hote distant (webinfo pour l'iut)
            //localhost pour le local sur machine perso
            'hostname' => 'localhost',

            //Le nom de la bdd (ici progweb mais sur l'iut martineze)
            'database' => 'progweb',

            //A l'iut martineze, perso : root
            'login' => 'root',

            //A l'iut 7092021, perso : root
            'password' => 'root'
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

            static public function getDebug() {
                return self::$debug;
            }
        }

    ?>

    </body>

</html>