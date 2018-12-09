<?php

/*
 * Author: Alex Wenger, Kevin June
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
    public function GetInventory($keys, $itemsList) {
        try{
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
                foreach($itemsList as $key => $val){
                    if ($item->GetId() == key($itemsList[$key])){
                        //echo get_object_vars($itemsList[$key])[key($itemsList[$key])] . "<br />"; 
                        $count = get_object_vars($itemsList[$key])[key($itemsList[$key])];
                        $item->SetCount($count);
                        break;
                    }
                }
                $items[] = $item;
            }

            return $items;
        }catch(DatabaseException $e){
           return false;
        } catch(Exception $e){
            return false;
        }
    }
    
    //Returns a list of items depending on search terms
    public function SearchItems($key, $searchBy) {
        try{
            $keys = explode(',', $key);
            $sql = "SELECT * FROM " . $this->tblItem .
                    " WHERE ";

            $flag = true;
            foreach ($keys as $value) {
                if (!$flag)
                    $sql .= " OR ";
                $sql .= $searchBy . " LIKE '%" . trim($value, " ") . "%'";
                $flag = false;
            }
            
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
        }catch(DatabaseException $e){
           return false;
        } catch(Exception $e){
            return false;
        }
    }
    
    //Creates a new item in the item table
    public function CreateItem($name, $price, $description, $iconId) {
            if (!is_numeric($iconId))
                throw new DataTypeException();
            
            if (!is_numeric($price))
                throw new DataTypeException();
            
            //SQL select statement
            $id = $this->GenerateItemId();

            if ($id >= 0){
                $sql = "INSERT INTO " . $this->db->getItemTable() . " VALUES (" . $id . ", '" . $price . "', '" . $name . "', '" . $description . "', '" . $iconId . "')";


                //execute the query
                $query = $this->dbConnection->query($sql);

                return $query;
            }else{
                return false;
            }
        
    }
    
    //Deletes an item from the item database
    public function DeleteItem($id) {
        try{
            if ($id >= 0){
                $sql = "DELETE FROM " . $this->db->getItemTable() . " WHERE id=" . $id . ";";

                //execute the query
                $this->dbConnection->query("SET FOREIGN_KEY_CHECKS=0;");
                $query = $this->dbConnection->query($sql);
                $this->dbConnection->query("SET FOREIGN_KEY_CHECKS=1;");


                return $query;
            }else{
                return false;
            }
        }catch(DatabaseException $e){
           return false;
        } catch(Exception $e){
            return false;
        }
    }
    
    //updates the details of an item in the item database
    public function UpdateItem($id, $name, $price, $description, $iconId) {
        if (!is_numeric($iconId))
            throw new DataTypeException();

        if (!is_numeric($price))
            throw new DataTypeException();
        
        if ($id >= 0){
            $sql = "UPDATE " . $this->db->getItemTable() . " SET price='" . $price . "', name='" . $name . "', description='" . $description . "', icon_id='" . $iconId . "' WHERE id=" . $id . ";";

            //execute the query
            $query = $this->dbConnection->query($sql);

            return $query;
        }else{
            return false;
        }
    }
    
    //updates a user's inventory
    public function UpdateInventory($id, $inventory) {
        
        if ($id >= 0){
            $sql = "UPDATE " . $this->db->getUserTable() . " SET inventory='" . $inventory . "' WHERE id=" . $id . ";";

            //execute the query
            $query = $this->dbConnection->query($sql);

            return $query;
        }else{
            return false;
        }
    }
    
    //Gets Item based on User's inventory
    //Returns an item from the database based on a provided item id
    public function GetItem($key, $userFlag) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            if ($userFlag == "true"){
                $user = UserModel::GetUserModel()->GetUser($_SESSION['user']);
                $user->LoadInventory();
                return $user->GetItemById($key);
            }else{
                $user = UserModel::GetUserModel()->GetVendor();
                $user->LoadInventory();
                return $user->GetItemById($key);
            }
    }
    
    
    //Returns an item from the database based on a provided item id
    public function GetItemBasic($key) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $user = UserModel::GetUserModel()->GetAdmin();
            $user->SetInventory($this->SearchItems("","name"));
            $user->inventoryLoaded = true;
            return $user->GetItemById($key);
            
    }
    
    //Generates a valid id to be used when inserting an item into the item table
    public function GenerateItemId(){
        try{
            $sql = "SELECT id";
            $sql .= " FROM " . $this->db->getItemTable();


                $query = $this->dbConnection->query($sql);


            if ($query){
                return $query->num_rows + 1;
            }else{
                return -1;
            }
        }catch(DatabaseException $e){
           return false;
        } catch(Exception $e){
            return false;
        }
    }
    
    
    //Returns an icon url
    public function GetIcon($iconId) {
        return "../" . ICON_IMAGE_URL . 'icon' . $iconId . '.png';
    }

}
