<?php

namespace Core;

use \Core\FrameworkException;

class Open {


    public static function go() {

        echo 'Cos robie ...<br>';
        throw new FrameworkException('Błąd!!! Wystąpił błąd!');

    }

}