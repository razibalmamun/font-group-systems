<?php
class MySQL implements DB
{
    protected $host = 'localhost';
    protected $username = 'root';
    protected $password;
    protected $dbname = 'font_group';

    /**
     * @param $mySql
     */
    /*public function __construct($mySql) {
        $this->host = $mySql['host'];
        $this->username = $mySql['username'];
        $this->password = $mySql['password'];
        $this->dbname = $mySql['dbname'];
    }*/

    /**
     * @return mixed|void
     */
    public function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=UTF8";
        try {
            $pdo = new PDO($dsn, $this->username, $this->password);
            if ($pdo) {
                // echo "Connected to the $this->dbname database successfully!";
                return $pdo;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}