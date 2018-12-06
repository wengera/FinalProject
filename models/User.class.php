<?php
/*
 * Author: Alex Wenger
 * Date: 11/13/2018
 * Name: User.class.php
 * Description: the User class models a real-world user.
 */

class User{
    
    //private properties of a User object
    private $id, $username, $firstName, $lastName, $phone, $inventory, $icon, $level, $coins;
    public $inventoryLoaded = false;
    
    //the constructor that initializes all properties
    public function __construct($data) {
        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->firstName = $data["firstName"];
        $this->lastName = $data["lastName"];
        $this->phone = $data["phone"];
        $this->inventory = $data["inventory"];
        $this->level = $data["level"];
        $this->coins = $data["coins"];
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
    
    public function GetCoins(){
       return $this->coins;
    }
    
    public function GetLevel(){
       return $this->level;
    }
    
    public function GetInventory(){
        if (!$this->inventoryLoaded)
            return $this->LoadInventory($this->inventory);
        else
            return $this->inventory;
    }
    
    public function GetItem($index){
        if ($index < sizeof($this->inventory))
            return $this->inventory[$index];
        else
            return "";
    }
    
    public function GetItemById($id){
        $length =sizeof($this->inventory);
        foreach($this->inventory as $item){
            if ($item->GetId() == $id){
                return $item;
            }
        }
        return null;
    }
    
    public function GetItemIndex($id){
        $length =sizeof($this->inventory);
        $counter = 0;
        foreach($this->inventory as $item){
            if ($item->GetId() == $id){
                return $counter;
            }
            $counter += 1;
        }
        return -1;
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
    
    public function AddItem($id){
        $inv = $this->GetInventory();
        
        $inventoryModel = InventoryModel::GetInventoryModel();
        $index = $this->GetItemIndex($id);
        if ($index == -1){
            $item = clone $inv[0];
            $item->SetId($id);
            $item->SetCount(1);
            $inv[] = $item;
        }else{
            $x = 0;
            while ($x < count($inv)){
                if ($inv[$x]->GetId() == $id){
                    $inv[$x]->SetCount($inv[$x]->GetCount() + 1);
                    break;
                }
                $x += 1;
            }
        }
        
        $inventoryModel->UpdateInventory($this->GetId(), $this->ToJson($inv));
    }
    
    public function ToJson($inv){
        $string = '{"inventory": [';
        $flag = true;
        foreach($inv as $key){
            //'{"$key->GetId()": 1}'
            if (!$flag)
                $string .= ",";
            
            $string .= '{"' . $key->GetId() . '": ' . $key->GetCount() ."}";
            
            $flag = false;
        }
        
        $string .= ']}';
        return $string;
        //$array["id"] = $this->id;
        //return json_encode($array);
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
        $this->inventory = $inventoryModel->GetInventory($itemKeys, $items);
        
        if (!$this->inventory){
            echo "Failed to load inventory";
            return null;
        }else{
            $this->inventoryLoaded = true;
            return $this->inventory;
        }
    }
}
