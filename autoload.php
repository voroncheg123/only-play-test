<?php

    spl_autoload_register(function ($class) {
        require PROJECT_ROOT.'/classes/' . $class . '.php';
    });
