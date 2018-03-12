<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piort Wróblewski.
 *
 */

namespace Models;

use Core\ModelClasses\DataModel;

/**
 * Data from Trello API
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class TrelloDataModel extends DataModel {
    
    
    private $trelloApiKey = "";
    private $trelloApiToken = "";
    
    public function __construct() {
        
        $this->trelloApiKey = \Core\Config::get("TRELLO_API_KEY");
        $this->trelloApiToken = \Core\Config::get("TRELLO_API_TOKEN");
        
        $this->content = $this->getCards('5aa0f4a7ac12824509cc5422');
    }
    
    private function getDataFromAPI($url, $args) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_VERBOSE, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_HTTPGET, 1);

        if (count($args)) {
            curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($args));
        }

        $data = curl_exec($c);
        echo curl_error($c);
        curl_close($c);
        return json_decode($data);
    }
    
    private function getCards($listId, $args = false) {
        if (!$args) {
            $args = array();
        } elseif (!is_array($args)) {
            $args = array($args);
        }
        
        $url = 'https://api.trello.com/1/lists/' . $listId . '/cards/?key=' . $this->trelloApiKey . '&token=' . $this->trelloApiToken;
        $dataFromAPI = $this->getDataFromAPI($url, $args);
        
        $tableOfObjects = [];
        
        for ($i = 0; $i < count($dataFromAPI); $i++) {
            $tableOfObjects[$i] = new \StdClass();
            $tableOfObjects[$i]->id = $dataFromAPI[$i]->id;
            $tableOfObjects[$i]->name = $dataFromAPI[$i]->name;
            $tableOfObjects[$i]->desc = $dataFromAPI[$i]->desc;
            $tableOfObjects[$i]->url = $dataFromAPI[$i]->url;
            $tableOfObjects[$i]->idMembers = $dataFromAPI[$i]->idMembers;
            $tableOfObjects[$i]->idChecklists = $dataFromAPI[$i]->idChecklists;
            $tableOfObjects[$i]->labels = $dataFromAPI[$i]->labels;
        }
        $content = '<div>';
            for ($i = 0; $i < count($tableOfObjects); $i++) {
                $content .= '<h3>'.($i+1).'. '.$tableOfObjects[$i]->name.'</h3>';
                $content .= '<p>'.$tableOfObjects[$i]->desc.'</p>';
                if (count($tableOfObjects[$i]->idChecklists) > 0) {
                    $content .= '<p>Zadania:</p><ul>';
                    for ($j = 0; $j < count($tableOfObjects[$i]->idChecklists); $j++) {
                        $content .= '<div>'.$this->getCheckLists($tableOfObjects[$i]->idChecklists[$j]).'</div>';
                    }
                    $content .='</ul>';
                }
            }
        $content .= '</div>';
        
        return $content;
    }
   
    
    private function getCheckLists($idCheckList, $args = false) {
        if (!$args) {
            $args = array();
        } elseif (!is_array($args)) {
            $args = array($args);
        }

        $url = 'https://api.trello.com/1/checklists/' . $idCheckList . '/?key=' . $this->trelloApiKey . '&token=' . $this->trelloApiToken;
        $dataFromAPI = $this->getDataFromAPI($url, $args);
        
        //var_dump($dataFromAPI);
        //exit();
        
        $content = '';
        $tableOfObjects = [];
        if ($dataFromAPI !== '') {
            
            $content .= '<strong>'.$dataFromAPI->name.':</strong>';
            for ($i = 0; $i < count($dataFromAPI->checkItems); $i++) {
                $tableOfObjects[$i] = new \stdClass();
                $tableOfObjects[$i]->name = $dataFromAPI->checkItems[$i]->name;
                $tableOfObjects[$i]->state = $dataFromAPI->checkItems[$i]->state;
                if ($tableOfObjects[$i]->state === 'complete') {
                    $content .= '<p><input type="checkbox" checked>'.$tableOfObjects[$i]->name.'</p>';
                } else {
                    $content .= '<p><input type="checkbox">'.$tableOfObjects[$i]->name.'</p>';
                }
            }
            
            //for ($i = 0; $i < count($dataFromAPI); $i++) {
                //$tableOfObjects[$i] = new \stdClass();
                //$tableOfObjects[$i]->id = $dataFromAPI[$i]->id;
                //$content .= $dataFromAPI[$i]->id.'<br>';
               
//                $tableOfObjects[$i]->name = $dataFromAPI[$i]->name;
//                $tableOfObjects[$i]->state = $dataFromAPI[$i]->state;
//                $tableOfObjects[$i]->nameData = $dataFromAPI[$i]->nameData;
            //}
//            for ($i = 0; $i < count($tableOfObjects); $i++) {
//                $content .= '<p>';
//                if ($tableOfObjects[$i]->state !== 'incomplete') {
//                    $content .= ' <input type="checkbox" checked>';
//                }
//                else {
//                    $content .= ' <input type="checkbox">';
//                }
//                $content .= $tableOfObjects[$i]->name.'</p>';
//            }
        }
        return $content;
    }
    
    private function getCheckListChecked($idCheckList, $args = false) {
        if (!$args) {
            $args = array();
        } elseif (!is_array($args)) {
            $args = array($args);
        }

        $url = 'https://api.trello.com/1/checklists/' . $idCheckList . 'checkItems/?key=' . $this->trelloApiKey . '&token=' . $this->trelloApiToken;
        $dataFromAPI = $this->getDataFromAPI($url, $args);
        var_dump($dataFromAPI);
    }
    
}
