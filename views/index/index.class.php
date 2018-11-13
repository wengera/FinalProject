<?php
/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: index.class.php
 * Description: This class defines the method "display" that displays the home page.
 */

class HomeIndex extends IndexView {

    public function getIcon($user, $index){
        $item = $user->GetItem($index);
        if ($item)
            return $item->GetIcon($index);
        else
            return "";
    }
    
    public function display($user) {
        //display page header
        parent::displayHeader("Home");
        ?>    
        <div id="main-header">This is the main inventory page</div>
        <p> Your inventory will be printed below </p>
        <br>
        <div class="container" id="playerInventoryContainer">
            <div class="row">
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 0) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 1) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 2) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 3) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 4) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 5) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 6) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 7) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 8) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 9) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 10) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 11) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 12) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 13) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 14) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 15) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 16) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 17) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 18) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
                <div class="col-lg-*">
                    <div class="card">
                        <div class="card-body"><img src="<?= self::getIcon($user, 19) ?>" id="itemIcon" alt="itemImg"></div>
                    </div>
                </div>
            </div>
        </div>
<?php
    
    //$userModel->AddUser("wengera", "Alex973062", "Alex", "Wenger", "3174324218", '{"inventory": [{"1": 5}, {"2": 6}]}');
    if (!$user){
        echo "Failed to retrieve user";
    }
?>
        <form action="index.php?action=logout" method="post">
            <input type="submit" name="logout" value="logout" />
        </form>


        <?php
        //display page footer
        parent::displayFooter();
    }

}
