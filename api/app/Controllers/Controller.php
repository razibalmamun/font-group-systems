<?php
class Controller
{
    public function response($data) {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($data); 
    }
}
