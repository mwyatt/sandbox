<?php

namespace AppName\Controller;


class Content {


    public function all($type) {
        echo '<pre>';
        print_r($type);
        echo '</pre>';
        exit;
        
        return include BASE_PATH . 'app/template/content/all.php';
    }


    public function single($type, $id) { 
        return include BASE_PATH . 'app/template/content/single.php';
    }


    public function singleSubmit($type, $id)
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        
        return "update $type $id";
    }


    public function create($type)
    {
        return "create template $type";
    }


    public function createSubmit($type)
    {
        
    }


    public function delete($id)
    {
        return 'delete';
    }
}
