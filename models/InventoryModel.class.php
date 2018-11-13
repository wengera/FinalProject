<?php

/*
 * Author: Alex Wenger
 * Date: 11/13/2018
 * File: InventoryModel.class.php
 * Description: the inventory model
 * 
 */

class InventoryModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblItem;
    private $tblItemIcon;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getBookModel method must be called.
    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblItem = $this->db->getItemTable();
        $this->tblItemIcon = $this->db->getIconTable();

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
    public static function GetInventoryModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new InventoryModel();
        }
        return self::$_instance;
    }

    /*
     * the GetInventory method retrieves all items from the database and
     * returns an array of Item objects if successful or false if failed.
     */

    public function GetInventory($keys) {
        $in = '(' . implode(',', $keys) .')';
        
        $sql = "SELECT * FROM " . $this->tblItem .
                " WHERE id IN " . $in;
        
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
        $items = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            //$items = new Item(stripslashes($obj->id), stripslashes($obj->price), stripslashes($obj->name), stripslashes($obj->description), stripslashes($obj->icon_id));
            $item = new Item((array)$obj);
            $items[] = $item;
        }
        
        return $items;
    }

}
