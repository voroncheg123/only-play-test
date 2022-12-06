<?php
declare(strict_types=1);

class Loader
{
    public static function loadClasses(): void
    {
        $classes = scandir(__DIR__);
        foreach ($classes as $class){
            $classFile = __DIR__.'/'.$class;
            if(is_file($classFile)){
                require_once $classFile;
            }
        }
    }
}