<?php

/*
 * Author: Alex Wenger
 * Date: 11/13/2018
 * File: inventory_controller.class.php
 * Description: the inventory controller
 *
 */

class InventoryController {

    private $inventoryModel;

    //default constructor
    public function __construct() {
        //create an instance of the BookModel class
        $this->book_model = InventoryModel::getInventoryModel();
    }

    //index action that displays all books
    public function index() {
        //retrieve all books and store them in an array
        $inventory = $this->inventory_model->list_book();

        if (!inventory) {
            //display an error
            $message = "There was a problem displaying books.";
            $this->error($message);
            return;
        }

        // display all books
        $view = new InventoryIndex();
        $view->display($books);
    }

    //show details of a book
    public function detail($id) {
        //retrieve the specific book
        $book = $this->book_model->view_book($id);

        if (!$book) {
            //display an error
            $message = "There was a problem displaying the book id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display book details
        $view = new BookDetail();
        $view->display($book);
    }

    //display a book in a form for editing
    public function edit($id) {
        //retrieve the specific book
        $book = $this->book_model->view_book($id);

        if (!$book) {
            //display an error
            $message = "There was a problem displaying the book id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new BookEdit();
        $view->display($book);
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new InventoryError();

        //display the error page
        $error->display($message);
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }

}
