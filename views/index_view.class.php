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
            <a class="navbar-brand" href="index">Inventory</a>

            <!-- Links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index">Home</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php
                    if (session_status() == PHP_SESSION_NONE || !isset($_SESSION['user'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="login">Login</a>
                </li>
                <?php
                    }else{
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout">Logout</a>
                </li>
                <?php
                    }
                ?>
            </ul>
          </nav>
    <?php
    }
    static public function displayFloatingDetails(){
        ?>
        <div id="floatingDetails">
            <div class="card" id="cardDetails">
                <div class="card-body" style="padding-top: 20px">
                  <h4 class="card-title" id="name" style="color:white;"> item</h4>
                  <p class="card-text" id="price" style="color:white;"><b>Price:</b> price</p>
                  <p class="card-text" id="description" style="color:white;"><b>Description:</b> description </p>
                </div>
            </div>
        </div>
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
                    .grid {
                        padding-top: 10px;
                        display: grid;
                        width: 100%;
                        max-width: 750px;
                        margin: 0 auto;
                        grid-template-columns: repeat(6, 1fr);
                        grid-template-rows: repeat(6, 1fr);
                        grid-gap: 2px;
                    }

                    /* items */

                    .grid div {
                      color: white;
                      font-size: 20px;
                      padding: 0px;
                      }
                      
                    #floatingDetails{
                        z-index: 1;
                        position: absolute;
                    }
                    
                    #itemIcon{
                        width: 100px;
                        height: 100px;
                    }
                    .row{
                        margin-left: 0px;
                        margin-right: 0px;
                    }
                    
                    #cardDetails{
                        width:300px;
                        margin-top: 40px;
                        border-color: white;
                        background-color: rgb(70, 70, 70);
                    }
                    
                    #itemIconDetails{
                        width: 300px;
                        height: 300px;
                    }
                    
                    .card{
                        overflow: hidden;
                    }
                    
                    
                    #playerInventoryContainer{
                        padding-top: 40px;
                        border-width: 1px !important;
                        border-color: #ffffff;
                        margin-left: 20px;
                        margin-right: 0px;
                        width: 475px;
                    }
                    #formCard{
                        padding: 10px 10px 10px 10px;
                    }
                    #itemCardBody{
                        padding: 0px 0px 0px 0px;
                        background-color: rgb(70, 70, 70);
                    }
                    #itemCard{
                        -webkit-animation: shrink .1s  normal forwards ease-in-out; /* Safari 4.0 - 8.0 */
                        animation: shrink .1s ;
                        margin: 5px 5px 5px 5px;
                        width: 100px; height: 100px;
                        border-width: 2px;
                        border-color: rgba(200, 200, 200, 1);
                    }
                    
                    @keyframes grow{
                        0%{
                            border-width: 2px;
                        }
                        100%{
                            border-width: 4px;
                        }
                    }
                    
                    @keyframes shrink{
                        0%{
                            border-width: 4px;
                        }
                        100%{
                            border-width: 2px;
                        }
                    }
                    
                    #itemCard:hover { 
                        border-color: #5194ff;
                        -webkit-animation: grow .1s  normal forwards ease-in-out; /* Safari 4.0 - 8.0 */
                        animation: grow 0.1s ;
                        border-width: 4px;
                    }
                    body{
                        background-color: rgb(50, 50, 50) !important;
                    }
                    
                    .container{
                        margin-left: 20px;
                        margin-right: 20px;
                        width: 45vw;
                    }
                    
                    
                </style>
            </head>
            <body>
                <?php self::displayNavBar() ?>
                <div id="top"></div>
                <div id='wrapper'>
                    <div id="banner" style="color: white">
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
                <div id="footer" style="color: white"><br></div>
            </body>
            <script>
                document.addEventListener("mousemove", function(event){
                    document.getElementById("floatingDetails").style.left = event.pageX + 10 + "px";
                    document.getElementById("floatingDetails").style.top = (event.pageY - 10) + "px";
                });
                function toggleFloatingDetails(reveal){
                    document.getElementById("floatingDetails").hidden = !reveal;
                }
                
                function updateDetailBox(json){
                    console.log("json: " + json);
                }
            </script>
        </html>
        <?php
    } //end of displayFooter function
}
