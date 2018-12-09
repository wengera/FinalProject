<?php
/*
 * Author: Alex Wenger, Kevin June
 * Date: 11/15/2018
 * Name: index.class.php
 * Description: The login view for the application
 */

class LoginView extends IndexView {
    
    public function display($errorMsg) {
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
                            
                            <form method="get" action="verifyUser">
                                <div class="form-group">
                                  <label for="username">Username:</label>
                                  <input type="text" name="username" class="form-control" id="username">
                                </div>
                                <div class="form-group">
                                  <label for="password">Password:</label>
                                  <input type="password" name="password" class="form-control" id="password">
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
        parent::displayFooter($errorMsg);
    }

}
