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

    //private constructor to handle Inventory Model's singleton instances
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
    }

    //Returns an instance of the inventory singleton model
    public static function GetInventoryModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new InventoryModel();
        }
        return self::$_instance;
    }

    /*
     * the GetInventory method retrieves all of a user's items from the database and
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
        
        $items = array();

        //loop through all rows in the returned inventory set
        while ($obj = $query->fetch_object()) {
            $item = new Item((array)$obj);
            $items[] = $item;
        }
        
        return $items;
    }
    
    //Returns an item from the database based on a provided item id
    public function GetItem($key) {
        
        $sql = "SELECT * FROM " . $this->tblItem .
                " WHERE id = " . $key;
        
        //execute the query
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false. 
        if (!$query)
            return false;

        //if the query succeeded, but no item was found.
        if ($query->num_rows == 0)
            return 0;

        $items = array();

        //Retrieve the object
        $obj = $query->fetch_object();
        $item = new Item((array)$obj);
        
        return $item;
    }
    
    public function GetIcon($iconId) {
        return "../" . ICON_IMAGE_URL . 'icon' . $iconId . '.png';
    }

}
