<?php
class DBConnection
{
    public function connect(DB $DB) {
        return $DB->connect();
    }
}