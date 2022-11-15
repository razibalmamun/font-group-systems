<?php
class MySQL implements DB
{
    protected $host = 'localhost';
    protected $username = 'root';
    protected $password;
    protected $dbname = 'font_group';

    public function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=UTF8";
        try {
            $pdo = new PDO($dsn, $this->username, $this->password);
            if ($pdo) {
                return $pdo;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}