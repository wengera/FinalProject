<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataLengthException
 * Date: 12/06/2018
 * Name: Exceptions.class.php
 * Description: This class defines an exception for data length
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