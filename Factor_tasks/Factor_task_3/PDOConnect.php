<?php
// Класс для осуществления подключения к БД
class PDOConnect {   

    private $connectionString;
    private $BDName;
    private $DBPass;
    private $dbh; 
    private $options;

    public function __construct( ) {
        $this->connectionString = 'mysql:host=localhost;dbname=factor_task_3';
        $this->BDName =  'root';
        $this->DBPass = '';
        $this->options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    }

    public function SetConnectionString($newConnectionString)
    {
        $connectionString = $newConnectionString;
    }
    public function SetBDName($newBDName)
    {
        $BDName = $newBDName;
    }
    public function SetDBPass($newDBPass)
    {
        $BDName = $newBDName;
    }
    public function Connect() { 
        try {

            $this->dbh = new PDO($this->connectionString, $this->BDName, $this->DBPass,$this->options);


        } catch (PDOException $e) {
            echo  "Error!: " . $e->getMessage() . "<br/>"; // catching some errors if they will be

        }
        return $this->dbh ;
    }
}
