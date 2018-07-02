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
    
    private $projectsData = [];


    function __construct($input) {
        $this->projectsData = [
            'tequila' => [
                'id' => 0,
                'image' => 'tequilaplatformer1.png',
                'update_date' => '2016-03-04, 13:33:23',
                'title' => 'Tequila Platformer',
                'image_description' => 'Opis obrazka',
                'content' => $this->getProjectFileContent('tequila.md'),
                'url' => 'tequila',
                'kategorie' => 'projekty',
                'tagi' => 'Java,software'
            ],
            'spaceinvaders' => [
                'id' => 1,
                'image' => 'spaceinvades1.png',
                'update_date' => '2016-03-04, 13:33:23',
                'title' => 'Space Invaders',
                'image_description' => 'Opis obrazka',
                'content' => $this->getProjectFileContent('spaceinvaders.md'),
                'url' => 'spaceinvaders',
                'kategorie' => 'projekty',
                'tagi' => 'web,CSS,JavaScript'
            ],
            'kanciarz' => [
                'id' => 2,
                'image' => 'kanciarz1.png',
                'update_date' => '2016-03-04, 13:33:23',
                'title' => 'Kanciarz',
                'image_description' => 'Kanciarz',
                'content' => $this->getProjectFileContent('kanciarz.md'),
                'url' => 'kanciarz',
                'kategorie' => 'projekty',
                'tagi' => 'web,CSS,JavaScript,PHP'
            ],
            'furyroad' => [
                'id' => 3,
                'image' => 'furyroad1.png',
                'update_date' => '2016-03-04, 13:33:23',
                'title' => 'Fury Road',
                'image_description' => 'Fury Road',
                'content' => $this->getProjectFileContent('furyroad.md'),
                'url' => 'furyroad',
                'kategorie' => 'projekty',
                'tagi' => 'web,CSS,JavaScript,PHP'
            ]];
        $this->content = $this->getContentOfProject($input);
    }

    private function getProjectFileContent($fileName) {
        if (file_exists(__DIR__.DS."Projects/".$fileName) && is_file(__DIR__.DS."Projects/".$fileName))
            return file_get_contents(__DIR__.DS."Projects/".$fileName, true);
        else
            return 'Nie znaleziono pliku: '.$fileName;
    }
    
    private function getContentOfProject($name) {
        if (isset($this->projectsData[$name])) {
            return $this->projectsData[$name];
        } else 
        // DEFAULT "PROJECT NOT FOUND" DATA
        return [
            'id' => 0,
            'image' => 'default',
            'update_date' => date("Y-m-d h:i:sa"),
            'title' => 'Nie znaleziono projektu',
            'image_description' => 'Opis obrazka',
            'content' => 'Projekt o podanej nazwie "'.$name.'" nie istnieje!',
            'url' => 'https://wroblewskipiotr.pl/',
            'kategorie' => 'projekty',
            'tagi' => ''
        ];
    }
}
