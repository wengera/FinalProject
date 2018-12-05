<?php
/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: index.class.php
 * Description: This class defines the method "display" that displays the home page.
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
                            
                            <!--
                            <form method="post" action="index.php?action=login">
                                <div><input type="text" name="username" style="width: 99%" required="" placeholder="Username"></div>
                                <div><input type="password" name="password" style="width: 99%" required="" placeholder="Password"></div>
                                <div><input type="submit" class="button" value="Login"></div>
                            </form>
                            -->
                        </div>
                    </div>
               </div>
                <div class="col-lg-4">
                    
                </div>
            </div>
        </div>
        <!--
            <form action="index.php?action=logout" method="post">
                <input type="submit" name="logout" value="logout" />
            </form>
        -->

        <?php
        //display page footer
        parent::displayFooter($errorMsg);
    }

}
