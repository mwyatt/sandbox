<?php

namespace AppName\Controller;


class Content {


    public function all($type) {
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
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        $id = 5;

        $this->singleSubmit($type, $id)        
    }


    public function delete($id)
    {
        return 'delete';
    }
}
