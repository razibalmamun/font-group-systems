<?php
class JsonPrint implements PrintResponse
{
    public function res($data) {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($data); 
    }
}
