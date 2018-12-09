<?php

/*
 * Author: Alex Wenger, Kevin June
 * Date: 12/1/2018
 * File: database.class.php
 * Description: Description: the Database class sets the database details.
 * 
 */

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'project_db',
        'tblUser' => 'user',
        'tblIcon' => 'icon',
        'tblItem' => 'item'
    );
    
    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct() {
        $this->objDBConnection = @new mysqli(
                $this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']
        );
        
        if (mysqli_connect_errno() != 0) {
            $message = "Connecting database failed: " . mysqli_connect_error() . ".";
            include 'error.php';
            exit();
        }
    }

    //static method to ensure there is just one Database instance
    static public function getDatabase() {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection() {
        return $this->objDBConnection;
    }

    //returns the name of the table that stores movies
    public function getUserTable() {
        return $this->param['tblUser'];
    }

    //returns the name of the table that stores books
    public function getIconTable() {
        return $this->param['tblIcon'];
    }

    //returns the name of the table storing games
    public function getItemTable() {
        return $this->param['tblItem'];
    }
}
