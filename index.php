<!DOCTYPE html>
<!-- 

Author: Alex Wenger, Kevin June
Date: 12/1/2018
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //load application settings
        require_once ("application/config.php");

        //load autoloader
        require_once ("vendor/autoload.php");
        
        new Dispatcher();
       
        ?>
    </body>
</html>
