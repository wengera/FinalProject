<?php
/*
 * Author: Alex Wenger, Kevin June
 * Date: 11/29/2018
 * Name: create_item.class.php
 * Description: This class defines the method "createItem" that inserts a new item into the database
 */

class CreateItem extends IndexView {
    
    public function display() {
        //display page header
        parent::displayHeader("");
        ?>    
        <div class="container-fluid" style="margin-top: 40px;">
            <div class="row">
                <div class="col-lg-4">
                    
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            
                            <form method="get" action="createItem">
                                <div class="form-group">
                                  <label for="name">Name:</label>
                                  <input type="text" name="name" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                  <label for="price">Price:</label>
                                  <input type="text" name="price" class="form-control" id="price">
                                </div>
                                <div class="form-group">
                                  <label for="description">Description:</label>
                                  <input type="text" name="description" class="form-control" id="description">
                                </div>
                                <div class="form-group">
                                  <label for="iconId">Icon ID:</label>
                                  <input type="text" name="iconId" class="form-control" id="iconId">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                        </div>
                    </div>
               </div>
                <div class="col-lg-4">
                    
                </div>
            </div>
        </div>

        <?php
        //display page footer
        parent::displayFooter();
    }

}
