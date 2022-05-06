<?php

/*
 * Permet de créer un chemin absolue peut importe l'ordinateur utilisé
 * et le système d'exploitation.
 */

class File
{
    public static function build_path($path_array)
    {
        $DS = DIRECTORY_SEPARATOR;
        $ROOT_FOLDER = __DIR__ . $DS . '..';
        return $ROOT_FOLDER . $DS . join($DS, $path_array);
    }

    /**
     * Methode in_array récursive afin de parcourir les matrices et pas juste les tableaux
     * @param $needle, l'élément à rechercher
     * @param $haystack, la matrice dans laquelle on effectue la recherche
     * @param $strict, si on veut vérifier si le type correspond en plus de la valeur
     * @return bool, si la matrice contient oui ou non l'élément demandé
     */
    public static function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {  //Pour chacun des éléments dans notre tableau
            /*
             * On vient vérifier la concordance de notre $needle avec l'élément $item puis si $item
             *  est un tableau alors on effectue in_array_r sur les éléments de $item de manière récursive.
             */
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && self::in_array_r($needle, $item, $strict))) {
                return true;    //Si on le trouve alors true
            }
        }
        return false;   //Sinon on return false
    }
}