<?php
/*
 * Author: Alex Wenger
 * Date: 11/13/2018
 * Name: User.class.php
 * Description: the User class models a real-world user.
 */

class User{
    
    //private properties of a User object
    private $id, $username, $firstName, $lastName, $phone, $inventory;
    public $inventoryLoaded = false;
    
    //the constructor that initializes all properties
    public function __construct($data) {
        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->firstName = $data["firstName"];
        $this->lastName = $data["lastName"];
        $this->phone = $data["phone"];
        $this->inventory = $data["inventory"];
    }
    
    public function GetId(){
       return $this->id;
    }
    
    public function GetUsername(){
       return $this->username;
    }
    
    public function GetFirstName(){
       return $this->firstName;
    }
    
    public function GetLastName(){
       return $this->lastName;
    }
    
    public function GetPhone(){
       return $this->phone;
    }
    
    public function GetInventory(){
        if (!$this->inventoryLoaded)
            return $this->LoadInventory($this->inventory);
        else
            return $this->inventory;
    }
    
    public function PrintInventory(){
        if ($this->inventoryLoaded){
            $str = "";
            foreach($this->inventory as $item)
                $str .= $item->GetName() . "<br>";
            return $str;
        }else{
            return "Inventory Needs Loaded";
        }
    }
    
    public function LoadInventory(){
        $inventoryArray = json_decode($this->inventory);
        $items = (array)$inventoryArray->inventory;
        $item = (array)$inventoryArray->inventory[0];
        $itemKeys = array();
        
        foreach($items as $key => $val){
            $item = (array)$inventoryArray->inventory[$key];
            $itemKeys[] = key($item);
        }
        
        $inventoryModel = InventoryModel::GetInventoryModel();
        $this->inventory = $inventoryModel->GetInventory($itemKeys);
        
        if (!$this->inventory){
            echo "Failed to load inventory";
            return null;
        }else{
            $this->inventoryLoaded = true;
            return $this->inventory;
        }
    }
}
