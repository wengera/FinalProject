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
    
    public function display($user, $vendor) {
        //display page header
        parent::displayHeader("");
        parent::displayFloatingDetails();
        ?>    

         

        <div class="container-fluid">
            <div class="row">
            <div class="col-lg-5">
                <div class="container-fluid" id="playerInventoryContainer">
                <h2 style="color: white;"> <?= $user->GetUsername() ?> </h2>
                <section class="grid">
                    <?php
                        try{
                            $inventory = $user->GetInventory();
                            $size = count($inventory);
                            $counter = 0;
                            while ($counter < $size){?>
                                    <div class="card" id="itemCard"><div class="card-body" id="itemCardBody">
                                            <form method="POST" action="details">
                                                <input type="hidden" name="itemId" value="<?= $user->GetItem($counter)->GetId() ?>" />
                                                <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseenter="updateDetailBox('<?= $user->GetItem($counter)->ToJson() ?> ')" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, $counter) ?>" id="itemIcon" alt="" />
                                            </form>
                                        </div>
                                    </div>
                               <?php
                                $counter += 1;
                            }
                        }catch (Exception $e){
                            echo "what";
                        }
                    
                              
                    ?>
                </section>
                <div class="form-group">
                    <label style="color: white;" for="searchUser">Search:</label>
                    <input type="text" class="form-control" id="searchUser">
                  </div>
                </div>
            </div>
                <div class="col-lg-2">
                </div>
            <div class="col-lg-5">
                <div class="container-fluid" id="playerInventoryContainer">
                    <h2 style="color: white;"> <?= $vendor->GetUsername() ?> </h2>
                    <section class="grid">
                        <?php
                            try{
                                $inventory = $vendor->GetInventory();
                                $size = count($inventory);
                                $counter = 0;
                                while ($counter < $size){?>
                                        <div class="card" id="itemCard"><div class="card-body" id="itemCardBody">
                                                <form method="POST" action="details">
                                                    <input type="hidden" name="itemId" value="<?= $vendor->GetItem($counter)->GetId() ?>" />
                                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseenter="updateDetailBox('<?= $vendor->GetItem($counter)->ToJson() ?> ')" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, $counter) ?>" id="itemIcon" alt="" />
                                                </form>
                                            </div>
                                        </div>
                                   <?php
                                    $counter += 1;
                                }
                            }catch (Exception $e){
                                echo "what";
                            }


                        ?>
                    </section>
                    <div class="form-group">
                        <label style="color: white;" for="searchVendor">Search:</label>
                        <input type="text" class="form-control" id="searchVendor">
                    </div>
                </div>
            </div>
        </div>
<?php
    
    
    if (!$user){
        echo "Failed to retrieve user";
    }
?>
        
        

        <?php
        //display page footer
        parent::displayFooter();
    }

}
