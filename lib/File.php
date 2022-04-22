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
        $ROOT_FOLDER = __DIR__ . $DS . "..";
        return $ROOT_FOLDER . $DS . join($DS, $path_array);
    }
}