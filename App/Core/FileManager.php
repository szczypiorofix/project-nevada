<?php
/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Core;

use PDO;

/**
 * This is file manager class.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class FileManager {

    private $file = null;
    private $targetFile = null;
    private $db = null;
    private $errorMsg = '';
    private $error = false;
    private $filename = null;

    public function __construct($db) {
        $this->db = $db;
    }

    public function checkFileToUpload($file, $id) {
        $data = ["error" => false, "msg"=> $this->errorMsg, "filename"=> 'default.jpg'];
        if ($file['name'] !== '') {
            $this->file = $file;
            $this->targetFile = DIR_UPLOADS_IMAGES.$this->file['name'];
            $imageFileType = pathinfo($this->targetFile, PATHINFO_EXTENSION);
            $isImage = getimagesize($this->file['tmp_name']);
            $this->error = true;

            if ($isImage && ($imageFileType === "jpg" || $imageFileType === "png" || $imageFileType === "jpeg" || $imageFileType === "gif")) {
                if ($this->file["size"] <= 5000000) {
                    if (move_uploaded_file($file['tmp_name'], $this->targetFile)) {
                        $this->filename = basename($this->file['name']);
                        if (!is_null($id)) {
                            try {
                                $queryTags = $this->db['db']->prepare('UPDATE `posts` SET `image`=:image WHERE `id`=:id');
                                $queryTags->bindValue(':id', $id, PDO::PARAM_INT);
                                $queryTags->bindValue(':image', $this->filename, PDO::PARAM_STR);
                                $queryTags->execute();
                            } catch (FrameworkException $exc) {
                                $this->errorMsg = $exc->getMessage();
                            }
                            $this->error = false;
                        }
                    }
                } else {
                    $this->errorMsg = 'Podany plik jest zbyt duży (> 5MB)!';
                }
            } else {
                $this->errorMsg = 'Podany plik nie jest obrazem!';
            }
            $data = ["error" => $this->error, "msg"=> $this->errorMsg, "filename"=> $this->filename];
        }
        return $data;
    }
}