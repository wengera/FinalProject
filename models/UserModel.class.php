<?php

/*
 * Author: Alex Wenger, Kevin June
 * Date: 12/1/2018
 * File: UserModel.class.php
 * Description: the user model
 * 
 */

class UserModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
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
    
    //Returns vendor user
    public function GetVendor(){
        $sql = "SELECT id, username, firstName, lastName, phone, inventory, level, coins FROM " . $this->tblUser .
                " WHERE username = 'vendor'";
        
        try{
            //execute the query
            $query = $this->dbConnection->query($sql);
        }catch(DatabaseException $e){
           return false;
        }catch(Exception $e){
            return false;
        }

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
        
        return $user;
        
    }
    
    //returns admin user (function used only for very specific places)
    public function GetAdmin(){
        $sql = "SELECT id, username, firstName, lastName, phone, inventory, level, coins FROM " . $this->tblUser .
                " WHERE username = 'admin'";
        
        try{
            //execute the query
            $query = $this->dbConnection->query($sql);
        }catch(DatabaseException $e){
           return false;
        }catch(Exception $e){
            return false;
        }

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
        
        return $user;
        
    }
    
    
    //Returns user based on provided username
    public function GetUser($username) {
        
        $sql = "SELECT id, username, password, firstName, lastName, phone, inventory, level, coins FROM " . $this->tblUser .
                " WHERE username = '" . $username . "'";
        
        try{
            //execute the query
            $query = $this->dbConnection->query($sql);
        }catch(DatabaseException $e){
           return false;
        }catch(Exception $e){
            return false;
        }

        // if the query failed, return false. 
        if (!$query)
            return false;
        
        //if the query succeeded, but no item was found.
        if ($query->num_rows == 0)
            return 0;
        
        $user = $query->fetch_assoc();
        
        return new User((array)$user);
    }

    //Verifies a user (login)
    public function VerifyUser($username, $password) {
        
        $sql = "SELECT id, username, password, firstName, lastName, phone, inventory, level, coins FROM " . $this->tblUser .
                " WHERE username = '" . $username . "'";
        
        try{
            //execute the query
            $query = $this->dbConnection->query($sql);
        }catch(DatabaseException $e){
           return false;
        }catch(Exception $e){
            return false;
        }

        
        // if the query failed, return false. 
        if (!$query)
            return false;
        
        //if the query succeeded, but no item was found.
        if ($query->num_rows == 0)
            return 0;
        
        $user = $query->fetch_assoc();
        
        if (password_verify($password, $user['password'])){
            
            $user = new User((array)$user);
            
            if ($user){
                $cookie_name = "user";
                $cookie_value = $user->GetUsername();
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                
                session_start();
                $_SESSION['user'] = $user->GetUsername();
                $_SESSION['time'] = time() + (86400 * 30);

                
            }
            
            return true;
        }else{
            return false;
        }
    }
    
    //Returns the user's inventory
    public function GetInventory(){
        $this->_user->LoadInventory();
        $this->_user->GetInventory();
    }
    
    //Updates the user's balance
    public function UpdateBank($id, $balance){        
        if ($id >= 0){
            $sql = "UPDATE " . $this->db->getUserTable() . " SET coins='" . $balance . "' WHERE id=" . $id . ";";

            //execute the query
            $query = $this->dbConnection->query($sql);

            return $query;
        }else{
            return false;
        }
    }
    
    //Creates a new user
    public function AddUser($username, $password, $firstName, $lastName, $phone, $inventory) {
            
        if (!is_numeric($phone))
            throw new DataTypeException();
        
        if (strlen("" . $phone) < 7)
            throw new DataLengthException();
        
        if (!$this->UserExists($username)){
            try{
                $id = $this->generateId();
                $password = password_hash($password , PASSWORD_DEFAULT);
                if ($id >= 0){
                    $sql = "INSERT INTO " . $this->db->getUserTable() . " VALUES (" . $id . ", '" . $username . "', '" . $password . "', '" . $firstName . "', '" . $lastName . "', '" . $phone . "', '" . $inventory . "', '" . 1 . "', '" . 1500 . "')";


                        //execute the query
                        $query = $this->dbConnection->query($sql);


                    return $query;
                }else{
                    return false;
                }
            }catch(DatabaseException $e){
                return false;
            }catch(Exception $e){
                return false;
            }
        }else{
            return false;
        }
        
        
    }
    
    //Checks to see if a user exists
    public function UserExists($username){
        $sql = "SELECT username";
        $sql .= " FROM " . $this->db->getUserTable() . " WHERE username='" . $username. "';";
        
        try{
            $query = $this->dbConnection->query($sql);
        }catch(DatabaseException $e){
           return false;
        }catch(Exception $e){
            return false;
        }

        if ($query->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    
    
    //Generates a valid user id to be used to insert a new user into the table
    public function GenerateId($last=0){
            $sql = "SELECT id";
            $sql .= " FROM " . $this->db->getUserTable() . " WHERE id=" . $last;
            
            try{
                $query = $this->dbConnection->query($sql);
            }catch(DatabaseException $e){
               return false;
            }catch(Exception $e){
                return false;
            }
            
            if ($query->num_rows > 0){
                return $this->GenerateId($last + 1);
            }else{
                return $last;
            }
    }

}
