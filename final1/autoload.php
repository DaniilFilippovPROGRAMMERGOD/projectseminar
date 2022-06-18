<?php

spl_autoload_register(static function (string $classname)
{
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php'; //заменяет слэши под систему
    $file = str_replace('App', 'src', $file);//в строке имени класса меняет app на src
    if (file_exists($file)) {
        require $file; //если файл существует === загружает

        return true;
    }

    return false;
});

