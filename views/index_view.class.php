<?php
/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: index_view.class.php
 * Description: the parent class for all view classes. The two functions display page header and footer.
 */

class IndexView {

    static public function displayNavBar(){
        ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <!-- Brand/logo -->
            <a class="navbar-brand" href="#">Inventory</a>

            <!-- Links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
            </ul>
          </nav>
    <?php
    }
    //this method displays the page header
    static public function displayHeader($page_title) {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title> <?php echo $page_title ?> </title>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <script>
                    //create the JavaScript variable for the base url
                    var base_url = "<?= BASE_URL ?>";
                </script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
                <style>
                    #itemIcon{
                        width: 130px;
                        height: 130px;
                        margin-top: -15px;
                        margin-left: -15px;
                    }
                    .row{
                        margin-left: 0px;
                        margin-right: 0px;
                    }
                    
                    #playerInventoryContainer{
                        margin-left: 20px;
                        margin-right: 0px;
                        width: 475px;
                    }
                    .card-body{
                        padding: 0px 0px 0px 0px;
                    }
                    .card{
                        margin: 5px 5px 5px 5px;
                        width: 100px; height: 100px;
                        overflow: hidden;
                        border-width: 2px;
                        border-color: rgba(75, 75, 75, 1);
                    }
                    
                </style>
            </head>
            <body>
                <?php self::displayNavBar() ?>
                <div id="top"></div>
                <div id='wrapper'>
                    <div id="banner">
                        <?= $page_title ?>
                    </div>
                    <?php
                }//end of displayHeader function
                
                //this method displays the page footer
                public static function displayFooter() {
                    ?>
                    <br><br><br>
                    <div id="push"></div>
                </div>
                <div id="footer"><br> All Rights Reserved.</div>
            </body>
        </html>
        <?php
    } //end of displayFooter function
}
