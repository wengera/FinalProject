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
        <p> hi </p>
        <?php
        //load application settings
        require_once ("application/config.php");
        require_once ("models/Item.class.php");
        require_once ("models/User.class.php");
        require_once ("models/InventoryModel.class.php");
        require_once ("models/UserModel.class.php");
        require_once ("application/database.class.php");
        $userModel = UserModel::GetUserModel();
        //$userModel->AddUser("wengera", "Alex973062", "Alex", "Wenger", "3174324218", '{"inventory": [{"1": 5}, {"2": 6}]}');
        
        $user = $userModel->GetUser("wengera", "Alex973062");
        if ($user){
            echo "Retrieved User <br>";
        }else{
            echo "Failed to retrieve user";
        }
        echo $user->GetUsername() . "<br>";
        echo $user->PrintInventory() . "<br>";
        $user->GetInventory();
        echo $user->PrintInventory();
        //echo var_dump(array_keys((array)$inventoryArray->inventory)) . "<br>";
        //echo implode(" ", $inventoryArray) . "<br>";
        //echo var_dump($inventoryArray);
        
        //load autoloader
        //require_once ("vendor/autoload.php");
        // put your code here
        ?>
    </body>
</html>
