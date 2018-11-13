<!DOCTYPE html>
<!--
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
        require_once ("models/Item.class.php");
        require_once ("models/User.class.php");
        require_once ("models/InventoryModel.class.php");
        require_once ("models/UserModel.class.php");
        require_once ("controllers/ApplicationController.class.php");
        require_once ("application/database.class.php");
        require_once ("views/index_view.class.php");
        require_once ("views/index/index.class.php");
        
        $applicationController = new ApplicationController();
        
        if(isset($_GET['action']) && ($_GET['action'] != '')){
            switch ($_GET['action']){
                case "logout":
                    $applicationController->logout();
                    break;
                default:
                    $userModel = UserModel::GetUserModel();
                    $userModel->VerifyUser("wengera", "Alex973062");
                    $applicationController->index();
                    break;
            }
        }else{
            $userModel = UserModel::GetUserModel();
            $userModel->VerifyUser("wengera", "Alex973062");
            $applicationController->index();
        }
        
        
        
        //echo var_dump(array_keys((array)$inventoryArray->inventory)) . "<br>";
        //echo implode(" ", $inventoryArray) . "<br>";
        //echo var_dump($inventoryArray);
        
        //load autoloader
        //require_once ("vendor/autoload.php");
        // put your code here
        ?>
    </body>
</html>
