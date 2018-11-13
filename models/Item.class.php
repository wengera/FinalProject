<?php
/*
 * Author: Alex Wenger
 * Date: 11/13/2018
 * Name: Item.class.php
 * Description: the Item class models a digital-world item.
 */

class Item implements Serializable{
    
    //private properties of a Book object
    private $id, $price, $name, $description, $icon_id;
    
    //the constructor that initializes all properties
    public function __construct($data){
        $this->id = $data["id"];
        $this->price = $data["price"];
        $this->name = $data["name"];
        $this->description = $data["description"];
        $this->icon_id = $data["icon_id"];
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
    
    public function serialize() {
        return serialize([$this->id, $this->price, $this->name, $this->description, $this->icon_id]);
    }
    public function unserialize($data) {
        $this->id = $data["id"];
        $this->price = $data["price"];
        $this->name = $data["name"];
        $this->description = $data["description"];
        $this->icon_id = $data["icon_id"];
    }
}