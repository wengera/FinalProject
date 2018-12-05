<?php
/*
 * Author: Alex Wenger
 * Date: 11/27/2018
 * Name: index.class.php
 * Description: This page displays the inventory of both the user and the vendor
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
                    <div class="row">
                        <div class="col-lg-5">
                           
                        </div>
                        <div class="col-lg-5">
                             <h2 style="color:white;margin-top: 20px;"> <?= $user->GetCoins() ?> <i class="fa fa-ils" aria-hidden="true"></i></h1>
                        </div>
                        <div class="col-lg-5">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h1 style="color:white;margin-top: 20px;"> Shop </h1>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-lg-5">
                            
                        </div>
                        <div class="col-lg-5">
                            <h2 style="color:white;margin-top: 20px;"> Level <?= $user->GetLevel() ?> <i class="fa fa-level-up" aria-hidden="true"></i> </h1>
                        </div>
                        <div class="col-lg-5">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">

                    <div class="container-fluid" id="playerInventoryContainer">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">

                                    </div>
                                    <div class="col-lg-4">
                                         <h2 style="color: transparent;"> <?= $user->GetUsername() ?> </h2>
                                    </div>
                                    <div class="col-lg-4">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">                        
                            <section class="grid">
                                <?php
                                    try{
                                        $inventory = $user->GetInventory();
                                        $size = count($inventory);
                                        $counter = 0;
                                        while ($counter < $size){?>
                                                <div class="card" id="itemCard"><div class="card-body" id="itemCardBody">
                                                        <form method="get" action="details">
                                                            <input type="hidden" name="itemId" value="<?= $user->GetItem($counter)->GetId() ?>" />
                                                            <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseenter="getItemFloatingDetails('<?= $user->GetItem($counter)->getId() ?> ')" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, $counter) ?>" id="itemIcon" alt="" />
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
                <div class="col-lg-5">
                    <div class="container-fluid" id="playerInventoryContainer">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h3 style="color:white;"> <?= $vendor->GetCoins() ?> <i class="fa fa-ils" aria-hidden="true"></i></h1>
                                    </div>
                                    <div class="col-lg-4">
                                    </div>
                                    <div class="col-lg-4">
                                         <h3 style="color: white;"> Shopkeeper </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">    
                                <section class="grid">
                                    <?php
                                        try{
                                            $inventory = $vendor->GetInventory();
                                            $size = count($inventory);
                                            $counter = 0;
                                            while ($counter < $size){?>
                                                    <div class="card" id="itemCard"><div class="card-body" id="itemCardBody">
                                                            <form method="get" action="details">
                                                                <input type="hidden" name="itemId" value="<?= $vendor->GetItem($counter)->GetId() ?>" />
                                                                <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseenter="getItemFloatingDetails('<?= $vendor->GetItem($counter)->getId() ?> ')" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, $counter) ?>" id="itemIcon" alt="" />
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
                            </div>
                        </div>
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
