<?php

/*
 * Author: Alex Wenger
 * Date: 11/13/2018
 * File: ApplicationController.class.php
 * Description: the application controller
 *
 */

class ApplicationController {

    private $userModel;
    private $inventoryModel;
    //default constructor
    public function __construct() {
        //create an instance of the UserModel class
        $this->userModel = UserModel::GetUserModel();
        $this->inventoryModel = InventoryModel::GetInventoryModel();
    }

    //index action that displays all books
    public function index() {  
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['user'])){
            $user = $this->userModel->GetUser($_SESSION['user']);
            $user->LoadInventory();
            $vendor = $this->userModel->GetVendor();
            $vendor->LoadInventory();
            $view = new HomeIndex();
            $view->display($user, $vendor);
        }else{
            $this->login();
        }
        
    }
    
    //index action that displays all books
    public function search() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['user'])){
            $view = new SearchIndex();

            $results = array();

            if(isset($_POST['searchValue'])){
                $searchBy = "name";
                if (isset($_POST['optradio']))
                    $searchBy = strtolower($_POST['optradio']);

                $results = $this->inventoryModel->SearchItems($_POST['searchValue'], $searchBy);
                
                if ($results == null)
                    $view->display($results, "Items not found");
                else
                    $view->display($results, null);
            }else
                $view->display($results, null);
            
        }else{
            $this->login();
        }
    }
    
    public function create(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
            $view = new CreateItem();
            $view->display(null);
        }else{
            $this->login();
        }
    }
    
    public function createItem(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['user'])){
            if(isset($_POST['name']) && !empty($_POST["name"]) && isset($_POST['price']) && !empty($_POST["price"]) && isset($_POST['description']) && !empty($_POST["description"]) && isset($_POST['iconId']) && !empty($_POST["iconId"])){
                 if ($this->inventoryModel->CreateItem($_POST['name'], $_POST['price'], $_POST['description'], $_POST['iconId'])){
                    $view = new CreateItem();
                    $view->display(null);
                 }else{
                    $view = new CreateItem();
                    $view->display("Unable to create item.");
                }
            }else{
                $view = new CreateItem();
                $view->display("Missing form data.");
            }
        }else{
            $this->login();
        }
    }
    
    public function logout() {  
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['user'])){
            session_destroy();
        }
        
        $this->login();
    }
    
    public function verifyUser(){
        if(isset($_POST['username']) && isset($_POST['password'])){
             if ($this->userModel->VerifyUser($_POST['username'], $_POST['password']))
                $this->index();
            else
                $this->error("Login Failed");           
        }else
            $this->error("Login Failed");
    }

    //show details of a book
    public function registration() {
        $view = new Register();
        $view->display();
    }
    
    public function details() {  
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_POST["itemId"])) {
            $view = new DetailsView();
            $view->display($this->inventoryModel->GetItem($_POST['itemId']));
        }else{
            $view = new LoginView();
            $view->display();
        }
    }

    //display a login form
    public function login() {  
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION["user"])) {
            $this->index();
        }else{
            $view = new LoginView();
            $view->display(null);
        }
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new InventoryError();

        //display the error page
        $error->display($message);
    }

}
