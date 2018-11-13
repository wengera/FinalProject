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
    
    //default constructor
    public function __construct() {
        //create an instance of the BookModel class
        $this->userModel = UserModel::GetUserModel();
    }

    //index action that displays all books
    public function index() {
        //retrieve all books and store them in an array
        /*$inventory = $this->userModel->Get;

        if (!inventory) {
            //display an error
            $message = "There was a problem displaying books.";
            $this->error($message);
            return;
        }
        */
        $user = $this->userModel->GetUser();
        $user->LoadInventory();
        $view = new HomeIndex();
        $view->display($user);
    }
    
    public function logout() {
        $this->userModel->logout();
        
        if(isset($_COOKIE['user'])){
            unset($_COOKIE['user']);
            setcookie('user', null, -1, "/");
        }
        
        $this->login();
    }

    //show details of a book
    public function registration() {
        $view = new Register();
        $view->display();
    }

    //display a login form
    public function login() {
        if(isset($_COOKIE["user"])) {
            $this->index();
        }else{
            $view = new Login();
            $view->display();
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
