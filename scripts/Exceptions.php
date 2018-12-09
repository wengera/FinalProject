<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataLengthException
 * Author: Alex Wenger, Kevin June
 * Date: 11/15/2018
 * Name: Exceptions.php
 */

class DatabaseException extends Exception {
    function getDetails() {
        return "Unable to connect to database";
    }
}

class DataTypeException extends Exception {
    function getDetails() {
        return "Invalid Data Type";
    }

}

class DataLengthException extends Exception {
    function getDetails() {
        return "Phone number must be at least 7 numbers.";
    }

}