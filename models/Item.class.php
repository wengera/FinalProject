<?php
/*
 * Author: Alex Wenger, Kevin June
 * Date: 12/5/2018
 * Name: Item.class.php
 * Description: the Item class models a digital-world item.
 */

class Item implements Serializable{
    
    //private properties of a Book object
    private $id, $price, $name, $description, $icon_id, $icon, $count = 0;
    
    //the constructor that initializes all properties
    public function __construct($data){
        if ($data != null){
            $this->id = $data["id"];
            $this->price = $data["price"];
            $this->name = $data["name"];
            $this->description = $data["description"];
            $this->icon_id = $data["icon_id"];
        }else{
            $this->id = -1;
            $this->price = 0;
            $this->name = "n/a";
            $this->description = "n/a";
            $this->icon_id = 0;
        }
    }
    /*public function __construct($id, $price, $name, $description, $icon_id) {
        $this->id = $id;
        $this->price = $price;
        $this->name = $name;
        $this->description = $description;
        $this->icon_id = $icon_id;
    }
    */
    
    public function GetId(){
       return $this->id;
    }
    public function SetId($id){
       $this->id = $id;
    }
    
    public function GetPrice(){
       return $this->price;
    }
    
    public function GetName(){
       return $this->name;
    }
    
    public function GetDescription(){
       return $this->description;
    }
    
    public function GetIconId(){
       return $this->icon_id;
    }
    
    public function GetIcon(){
        if (!$this->icon){
            $this->icon = InventoryModel::GetInventoryModel()->GetIcon($this->icon_id);
        }
        
        return $this->icon;
    }
    
    public function GetCount(){
        return $this->count;
    }
    
    public function SetCount($count){
        $this->count = $count;
    }
    
    //returns item as json string
    public function ToJson(){
        $array = [];
        $array["id"] = $this->id;
        $array["price"] = $this->price;
        $array["name"] = $this->name;
        $array["description"] = $this->description;
        $array["iconId"] = $this->icon_id;
        $array["count"] = $this->count;
        return json_encode($array);
    }
    
    //i dont think this is used anymore
    public function serialize() {
        return serialize([$this->id, $this->price, $this->name, $this->description, $this->icon_id]);
    }
    
    //i dont think this is used anymore
    public function unserialize($data) {
        $this->id = $data["id"];
        $this->price = $data["price"];
        $this->name = $data["name"];
        $this->description = $data["description"];
        $this->icon_id = $data["icon_id"];
    }
}
