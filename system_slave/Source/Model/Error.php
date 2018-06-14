<?php
/**
 * Created by PhpStorm.
 * User: gustavoweb
 * Date: 23/04/2018
 * Time: 16:02
 */
namespace Model;

class Error {

    private $title;
    private $description;

    public function setError($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function getError()
    {
        return (object) [
            'title' => $this->title,
            'description' => $this->description
        ];
    }

}