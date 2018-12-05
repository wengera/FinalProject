<!DOCTYPE html>
<!-- TEST TEST
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
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
        
        //UserModel::GetUserModel()->AddUser("wengera", "test", "Alex", "Wenger", "3174324218", '{"inventory": [{"1": 5}, {"2": 6}, {"0": 1}, {"4": 3}]}');
        if(isset($_GET['action']) && ($_GET['action'] != '')){
            $applicationController = new ApplicationController();
            switch ($_GET['action']){
                case "logout":
                    $applicationController->logout();
                    break;
                case "login":
                    if(isset($_POST['username']) && isset($_POST['password'])){
                        $applicationController->verifyUser($_POST['username'], $_POST['password']);
                    }
                    break;
                default:
                    if(isset($_GET['user']) && ($_GET['user'] != '')){
                        $applicationController->index();
                    }else{
                        $applicationController->login();
                    }
                    break;
            }
        }
       
        ?>
    </body>
</html>
