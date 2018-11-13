<?php
/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: index.class.php
 * Description: This class defines the method "display" that displays the home page.
 */

class HomeIndex extends IndexView {

    public function display($user) {
        //display page header
        parent::displayHeader("Home");
        ?>    
        <div id="main-header">This is the main inventory page</div>
        <p> Your inventory will be printed below </p>
        <br>
<?php
    
    //$userModel->AddUser("wengera", "Alex973062", "Alex", "Wenger", "3174324218", '{"inventory": [{"1": 5}, {"2": 6}]}');
    if (!$user){
        echo "Failed to retrieve user";
    }
    
    echo $user->PrintInventory() . "<br>";
?>

        <?php
        //display page footer
        parent::displayFooter();
    }

}
