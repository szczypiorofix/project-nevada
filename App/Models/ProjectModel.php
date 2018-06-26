<?php
/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Models;

use Core\ModelClasses\DataModel;
use Core\FrameworkException;
use PDO, Date;

/**
 * Description of PostModel
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class ProjectModel extends DataModel {
    
    private $projects = [
        'tequila' => [
            'id' => 0,
            'image' => 'default',
            'update_date' => '2016-03-04, 13:33:23',
            'title' => 'Tequila Platformer',
            'image_description' => 'Opis obrazka',
            'content' => 'Treść projektu Tequila Platformer <br>Kolejna linia...<br> <br>',
            'url' => 'http://localhost',
            'kategorie' => 'projekty',
            'tagi' => 'Java,software'
        ],
        'library' => [
            'id' => 2,
            'image' => 'default',
            'update_date' => '2016-03-04, 13:33:23',
            'title' => 'Biblioteka Szkolna',
            'image_description' => 'Opis obrazka',
            'content' => 'Treść projektu Biblioteka Szkolna.',
            'url' => 'http://localhost',
            'kategorie' => 'projekty',
            'tagi' => 'web,CSS,JavaScript,PHP'
        ],
        'spaceinvaders' => [
            'id' => 3,
            'image' => 'default',
            'update_date' => '2016-03-04, 13:33:23',
            'title' => 'Space Invaders',
            'image_description' => 'Opis obrazka',
            'content' => 'Treść projektu Space Invaders',
            'url' => 'http://localhost',
            'kategorie' => 'projekty',
            'tagi' => 'web,CSS,JavaScript,PHP,NodeJS'
        ],
        'kanciarz' => [
            'id' => 4,
            'image' => 'default',
            'update_date' => '2016-03-04, 13:33:23',
            'title' => 'Kanciarz',
            'image_description' => 'Opis obrazka',
            'content' => 'Treść projektu Kanciarz',
            'url' => 'http://localhost',
            'kategorie' => 'projekty',
            'tagi' => 'web,CSS,JavaScript,PHP,NodeJS'
        ],
        'furyroad' => [
            'id' => 5,
            'image' => 'default',
            'update_date' => '2016-03-04, 13:33:23',
            'title' => 'Fury Road',
            'image_description' => 'Opis obrazka',
            'content' => 'Treść projektu Fury Road.',
            'url' => 'http://localhost',
            'kategorie' => 'projekty',
            'tagi' => 'web,CSS,JavaScript,PHP,NodeJS'
        ]
    ];

    private function getContentOfProject($name) {
        if (isset($this->projects[$name])) {
            return $this->projects[$name];
        } else 
        // DEFAULT "PROJECT NOT FOUND" DATA
        return [
            'id' => 0,
            'image' => 'default',
            'update_date' => date("Y-m-d h:i:sa"),
            'title' => 'Nie znaleziono projektu',
            'image_description' => 'Opis obrazka',
            'content' => 'Projekt o podanej nazwie "'.$name.'" nie istnieje!',
            'url' => 'http://localhost',
            'kategorie' => 'projekty',
            'tagi' => ''
        ];
    }

    function __construct($input) {
        $this->content = $this->getContentOfProject($input);        
    }
    
}
