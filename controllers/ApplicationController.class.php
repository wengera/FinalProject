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

            if(isset($_GET['searchValue'])){
                $searchBy = "name";
                if (isset($_GET['optradio']))
                    $searchBy = strtolower($_GET['optradio']);

                $results = $this->inventoryModel->SearchItems($_GET['searchValue'], $searchBy);
                
                $view->display($results);
                
                if ($results == null)
                    $view->serverMessage("Items not found");
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
            $view->display();
        }else{
            $this->login();
        }
    }
    
    public function createItem(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['user'])){
            if(isset($_GET['name']) && !empty($_GET["name"]) && isset($_GET['price']) && !empty($_GET["price"]) && isset($_GET['description']) && !empty($_GET["description"]) && isset($_GET['iconId']) && !empty($_GET["iconId"])){
                try{
                    $status = $this->inventoryModel->CreateItem($_GET['name'], $_GET['price'], $_GET['description'], $_GET['iconId']);
                    $view = new SearchIndex();
                    $view->display(array());
                     if (!$status)
                        $view->serverMessage("Unable to create item.");
                     else
                        $view->serverMessage("Successfully created item.");
                }catch(DataTypeException $e){
                    $view = new CreateItem();
                    $view->display(array());
                    $view->serverMessage("Invalid Data Type.");
                }catch(DatabaseException $e){
                   $view = new CreateItem();
                    $view->display(array());
                    $view->serverMessage("Unable to connect to database.");
                } catch(Exception $e){
                    $view = new CreateItem();
                    $view->display(array());
                    $view->serverMessage("Error trying to add item.");
                }
            }else{
                $view = new CreateItem();
                $view->display(array());
                $view->serverMessage("Missing form data.");
            }
        }else{
            $this->login();
        }
    }
    
    public function getItemDetails(){
        
        if(isset($_GET['id'])){
            $item = $this->inventoryModel->GetItem($_GET['id'], $_GET['userFlag']);
            echo $item->ToJson();
        }else{
            echo "{}";
        }
    }
    
    public function addItem(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_GET['id'])){
            $user = $this->userModel->GetUser($_SESSION['user']);
            $user->AddItem($_GET['id']);
        }
        
    }
    
    public function updateBank(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if(isset($_SESSION['user']) && isset($_GET['balance'])){
            $user = $this->userModel->GetUser($_SESSION['user']);
            $this->userModel->UpdateBank($user->GetId(), $_GET['balance']);
        }
    }
    
    public function deleteItem(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
            if(isset($_GET['id']) && !empty($_GET["id"])){
                $status = $this->inventoryModel->DeleteItem($_GET['id']);
                $view = new SearchIndex();
                $view->display(array());
                 if (!$status)
                    $view->serverMessage("Unable to delete item.");
                 else
                    $view->serverMessage("Item successfully deleted.");
            }else{
                $view = new DetailsView();
                $view->display($this->inventoryModel->GetItem($_GET['id']));
                $view->serverMessage("Unable to delete item.");
            }
        }else{
            $view = new DetailsView();
            $view->display($this->inventoryModel->GetItem($_GET['id']));
            $view->serverMessage("Must be an administrator to edit items.");
        }
    }
    
    public function updateItem(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
            if(isset($_GET['id']) && !empty($_GET["id"]) && isset($_GET['name']) && !empty($_GET["name"]) && isset($_GET['price']) && !empty($_GET["price"]) && isset($_GET['description']) && !empty($_GET["description"]) && isset($_GET['iconId']) && !empty($_GET["iconId"])){
                try{
                    $status = $this->inventoryModel->UpdateItem($_GET['id'], $_GET['name'], $_GET['price'], $_GET['description'], $_GET['iconId']);
                    $view = new DetailsView();
                    $view->display($this->inventoryModel->GetItem($_GET['id']));
                     if (!$status)
                        $view->serverMessage("Unable to update item.");
                     else
                        $view->serverMessage("Item Successfully updated.");
                }catch(DataTypeException $e){
                    $view = new DetailsView();
                    $view->display($this->inventoryModel->GetItem($_GET['id']));
                    $view->serverMessage($e->getDetails());
                }catch(DatabaseException $e){
                   $view = new Index();
                    $view->display();
                    $view->serverMessage($e->getDetails());
                } catch(Exception $e){
                    $view = new DetailsView();
                    $view->display($this->inventoryModel->GetItem($_GET['id']));
                    $view->serverMessage($e->getDetails());
                }
            }else{
                $view = new DetailsView();
                $view->display($this->inventoryModel->GetItem($_GET['id']));
                $view->serverMessage("Missing form data.");
            }
        }else{
            $view = new DetailsView();
            $view->display($this->inventoryModel->GetItem($_GET['id']));
            $view->serverMessage("Must be an administrator to edit items.");
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
        if(isset($_GET['username']) && !empty($_GET['username']) && isset($_GET['password']) && !empty($_GET['password'])){
             if ($this->userModel->VerifyUser($_GET['username'], $_GET['password']))
                $this->index();
            else{
                $view = new LoginView();
                $view->display(null);
                $view->serverMessage("Login failed.");
            }
        }else{
            $view = new LoginView();
            $view->display(null);
            $view->serverMessage("Missing Form Data.");
        }
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
        if(isset($_GET["itemId"])) {
            $view = new DetailsView();
            $view->display($this->inventoryModel->GetItem($_GET['itemId']));
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
