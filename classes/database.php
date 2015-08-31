<?php
session_start();

class Database{
    private $host       = 'localhost';
    private $username   = 'root';
    private $password   = '';
    private $db_name    = 'chat';
 
    private $dbh;
    private $error;
    private $stmt;
 
    public function __construct()
    {
        try
        {
            $this->dbh = new PDO('mysql:host='.  $this->host.'; dbname='.$this->db_name.'', $this->username, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            die('ERROR: ' .$e->getMessage());
        }
    }
    
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }
    
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
              case is_int($value):
                $type = PDO::PARAM_INT;
                break;
              case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
              case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
              default:
                $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    
    public function execute()
    {
        return $this->stmt->execute();
    }
    
    public function fetchAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function fetch()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function rowCount()
    {    
        return $this->stmt->rowCount();
    }

}