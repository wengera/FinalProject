<?php

/*
 * Author: Alex Wenger
 * Date: 11/06/2018
 * File: UserModel.class.php
 * Description: the book model
 * 
 */

class UserModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    static private $_user = NULL;
    private $tblUser;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getBookModel method must be called.
    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblUser = $this->db->getUserTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initialize book categories
        /*
        if (!isset($_SESSION['book_categories'])) {
            $categories = $this->get_book_categories();
            $_SESSION['book_categories'] = $categories;
        }
        */
    }

    //static method to ensure there is just one BookModel instance
    public static function GetUserModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }

    /*
     * the GetInventory method retrieves all items from the database and
     * returns an array of Item objects if successful or false if failed.
     */
    
    public static function GetUser(){
        return self::$_user;
    }

    public function VerifyUser($username, $password) {   
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "SELECT id, username, firstName, lastName, phone, inventory FROM " . $this->tblUser .
                " WHERE username = '" . $username . "'";
        
        //execute the query
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false. 
        if (!$query)
            return false;
        
        //if the query succeeded, but no item was found.
        if ($query->num_rows == 0)
            return 0;
        
        //handle the result
        //create an array to store all returned books
        $user = null;

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $user = new User((array)$obj);
        }
        
        self::$_user = $user;
        
        if ($user){
            $cookie_name = "user";
            $cookie_value = $user->GetUsername();
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        }
    }
    
    //Returns the user's inventory
    public function GetInventory(){
        $this->_user->LoadInventory();
        $this->_user->GetInventory();
    }
    
    public function AddUser($username, $password, $firstName, $lastName, $phone, $inventory) {
        //SQL select statement
        $id = $this->generateId();
        $password = password_hash($password , PASSWORD_DEFAULT);
        if ($id >= 0){
            $sql = "INSERT INTO " . $this->db->getUserTable() . " VALUES (" . $id . ", '" . $username . "', '" . $password . "', '" . $firstName . "', '" . $lastName . "', '" . $phone . "', '" . $inventory . "')";

            //execute the query
            $query = $this->dbConnection->query($sql);

            return $query;
        }else{
            return false;
        }
        
    }
    
    public function GenerateId(){
        $sql = "SELECT id";
        $sql .= " FROM " . $this->db->getUserTable();
        
        $query = $this->dbConnection->query($sql);
        
        if ($query){
            return $query->num_rows + 1;
        }else{
            return -1;
        }
    }

}
