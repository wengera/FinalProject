<?php
/*
 * Author: Alex Wenger, Kevin June
 * Date: 12/8/2018
 * Name: registration.class.php
 * Description: This class defines the method "display" that displays the registration page.
 */

class RegisterView extends IndexView {
    
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
                            
                            <form method="get" action="addUser">
                                <div class="form-group">
                                  <label for="regUsername">Username:</label>
                                  <input type="text" name="regUsername" class="form-control" id="regUsername">
                                </div>
                                <div class="form-group">
                                  <label for="regPassword">Password:</label>
                                  <input type="password" name="regPassword" class="form-control" id="regPassword">
                                </div>
                                <div class="form-group">
                                  <label for="fname">First Name:</label>
                                  <input type="text" name="fname" class="form-control" id="fname">
                                </div>
                                <div class="form-group">
                                  <label for="lname">Last Name:</label>
                                  <input type="text" name="lname" class="form-control" id="lname">
                                </div>
                                <div class="form-group">
                                  <label for="phone">Phone:</label>
                                  <input type="text" name="phone" class="form-control" id="phone">
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
