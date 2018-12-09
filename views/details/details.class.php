<?php
/*
 * Author: Alex Wenger, Kevin June
 * Date: 11/15/2018
 * Name: details.class.php
 * Description: This class defines the method "display" that displays the details page
 */

class DetailsView extends IndexView {
    public function display($item) {
        //display page header
        parent::displayHeader("");
        ?>    
        <div class="container-fluid">
            <div class="row"></div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="card" id="cardDetails">
                        <img class="card-img-top" src="../www/img/icons/icon<?= $item->GetIconId() ?>.png" id="itemIconDetails" alt="" >
                        <div class="card-body" id="card-body-details" style="padding-top: 20px">
                          <h4 class="card-title" style="color:white;"><?= $item->GetName() ?></h4>
                          <p class="card-text" style="color:white;"><b>Price:</b> <?= $item->GetPrice() ?></p>
                          <p class="card-text" style="color:white;"><b>Description:</b> <?= $item->GetDescription() ?></p>
                          <?php 
                          if(isset($_SESSION["user"]) && $_SESSION["user"] == "admin"){ 
                              echo '<button type="submit" class="btn btn-primary" id="editButton" onclick="editItem()">Edit</button>';
                          }
                
                        ?>
                          
                        </div>
                        <div class="card-body" id="card-body-edit" style="padding-top: 20px" hidden="true">
                          <form method="get" id="editForm" action="">
                            <div class="form-group">
                                <input type="text" name="id" class="form-control" value="<?= $item->GetId() ?>" id="itemName" hidden="true">
                                <label style="color: white;" for="=itemName">Name:</label> <br />
                                <input type="text" name="name" class="form-control" value="<?= $item->GetName() ?>" id="itemName">
                                <label style="color: white;" for="=itemPrice">Price:</label> <br />
                                <input type="text" name="price" class="form-control" value="<?= $item->GetPrice() ?>" id="itemPrice">
                                <label style="color: white;" for="=itemDescription">Description:</label> <br />
                                <input type="text" name="description" class="form-control" value="<?= $item->GetDescription() ?>" id="itemDescription">
                                <label style="color: white;" for="=itemIconId">Icon ID:</label> <br />
                                <input type="text" name="iconId" class="form-control" value="<?= $item->GetIconId() ?>" id="itemIconId">
                                <br />
                                <button type="button" class="btn btn-primary" id="cancelEditButton" onclick="cancelEdit()">Cancel</button>
                                <button type="button" onclick="submitEdit()" class="btn btn-primary">Submit</button>
                                <button type="button" onclick="deleteItem()" class="btn btn-danger">Delete</button>
                        </form>
                        </div>
                  </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        <script>
            function editItem(){
                var edit = document.getElementById("card-body-edit");
                var normal = document.getElementById("card-body-details");
                edit.hidden = false;
                normal.hidden = true;
            }
            
            function cancelEdit(){
                var edit = document.getElementById("card-body-edit");   
                var normal = document.getElementById("card-body-details");
                var form = document.getElementById("editForm");
                form.setAttribute("action", "");
                edit.hidden = true;
                normal.hidden = false;
            }
            
            function submitEdit(){
                var form = document.getElementById("editForm");
                form.setAttribute("action", "updateItem");
                form.submit();
            }
            
            function deleteItem(){
                var form = document.getElementById("editForm");
                form.setAttribute("action", "deleteItem");
                form.submit();
            }
        </script>
        

        <?php
        //display page footer
        parent::displayFooter();
    }

}
