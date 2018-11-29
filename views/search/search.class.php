<?php
/*
 * Author: Alex Wenger
 * Date: 11/27/2018
 * Name: search.class.php
 * Description: This page allows the user to search for possible in-game items
 */

class SearchIndex extends IndexView {

    public function getIcon($item){
        return $item->GetIcon();
    }
    
    public function display($results, $snackbarMessage) {
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
                        if ($results != null){
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
                        }

                        ?>
                    </section>
                    <form method="post" action="search">
                        
                        <div class="form-group">
                            <label style="color: white;" for="searchUser">Search:</label> <br />
                            <div class="form-check-inline">
                            <label class="form-check-label" style="color:white;">
                                <input type="radio" class="form-check-input" name="optradio" value="name" checked>Name
                              </label>
                            </div>
                            <div class="form-check-inline">
                              <label class="form-check-label" style="color:white;">
                                <input type="radio" class="form-check-input" name="optradio" value="description" >Description
                              </label>
                            </div>
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
        parent::displayFooter($snackbarMessage);
    }

}
