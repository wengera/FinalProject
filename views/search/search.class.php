<?php
/*
 * Author: Alex Wenger
 * Date: 11/27/2018
 * Name: search.class.php
 * Description: This page allows the user to search for possible in-game items
 */

header("Cache-Control: no cache");

class SearchIndex extends IndexView {

    public function getIcon($item){
        return $item->GetIcon();
    }
    
    public function display($results) {
        //display page header
        parent::displayHeader("");
        ?>    

         

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="container-fluid" id="playerInventoryContainer">
                    <section class="grid">
                        <?php
                            try{
                                $size = count($results);
                                $counter = 0;
                                while ($counter < $size){?>
                                        <div class="card" id="itemCard"><div class="card-body" id="itemCardBody">
                                                <form method="POST" action="details">
                                                    <input type="hidden" name="itemId" value="<?= $results[$counter]->GetId() ?>" />
                                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseenter="updateDetailBox('<?= $results[$counter]->ToJson() ?> ')" onmouseleave="toggleFloatingDetails(false)" src="<?= $results[$counter]->GetIcon() ?>" id="itemIcon" alt="" />
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
                    <form method="post" action="search">
                        <div class="form-group">
                            <label style="color: white;" for="searchUser">Search:</label>
                            <input type="text" name="searchValue" class="form-control" id="searchUser">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        
        

        <?php
        //display page footer
        parent::displayFooter();
    }

}
