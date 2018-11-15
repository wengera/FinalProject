<?php
/*
 * Author: Alex Wenger
 * Date: Mar 6, 2016//
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
                        <div class="card-body" style="padding-top: 20px">
                          <h4 class="card-title" style="color:white;"><?= $item->GetName() ?></h4>
                          <p class="card-text" style="color:white;"><b>Price:</b> <?= $item->GetPrice() ?></p>
                          <p class="card-text" style="color:white;"><b>Description:</b> <?= $item->GetDescription() ?></p>
                        </div>
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
