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
              
                  <?php 
                         if(isset($_SESSION["user"])){ 
                              echo '<li class="nav-item"><a class="nav-link" href="search">Search</a></li>';
                          }
                          if(isset($_SESSION["user"]) && $_SESSION["user"] == "admin"){ 
                              echo '<li class="nav-item"><a class="nav-link" href="create">Create Item</a></li>';
                          }
                
                        ?>
              
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
    
    static public function serverMessage($snackBarMessage){
        echo '<script type="text/javascript"> snackbar("', $snackBarMessage,'"); </script>';
    }
    
    static public function displayFloatingDetails(){
        ?>
        <div id="floatingDetails" hidden="true">
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
                <script src="../main.js" type="text/javascript"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
                <style>
                    .grid {
                        padding-top: 10px;
                        display: grid;
                        width: 100%;
                        max-width: 650px;
                        margin: 0 auto;
                        grid-template-columns: repeat(5, 1fr);
                        grid-template-rows: repeat(5, 1fr);
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
                        border-width: 2px;
                        border-color: rgba(200, 200, 200, 1);
                        margin-left: 20px;
                        margin-right: 0px;
                        max-width: 650px;
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
                        background-color: rgb(30, 30, 30) !important;
                    }
                    
                    .container{
                        margin-left: 20px;
                        margin-right: 20px;
                        width: 45vw;
                    }
                    
                    
                    
                    
                    /* The snackbar - position it at the bottom and in the middle of the screen */
                    #snackbar {
                        visibility: hidden; /* Hidden by default. Visible on click */
                        min-width: 250px; /* Set a default minimum width */
                        margin-left: -125px; /* Divide value of min-width by 2 */
                        background-color: #fff; /* White background color */
                        color: #222; /* Black text color */
                        text-align: center; /* Centered text */
                        font-weight: 400;
                        border-radius: 2px; /* Rounded borders */
                        padding: 16px; /* Padding */
                        position: fixed; /* Sit on top of the screen */
                        z-index: 1; /* Add a z-index if needed */
                        left: 50%; /* Center the snackbar */
                        bottom: 30px; /* 30px from the bottom */
                    }

                    /* Show the snackbar when clicking on a button (class added with JavaScript) */
                    #snackbar.show {
                        visibility: visible; /* Show the snackbar */
                        /* Add animation: Take 0.5 seconds to fade in and out the snackbar. 
                       However, delay the fade out process for 2.5 seconds */
                       -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
                       animation: fadein 0.5s, fadeout 0.5s 2.5s;
                    }

                    /* Animations to fade the snackbar in and out */
                    @-webkit-keyframes fadein {
                        from {bottom: 0; opacity: 0;} 
                        to {bottom: 30px; opacity: 1;}
                    }

                    @keyframes fadein {
                        from {bottom: 0; opacity: 0;}
                        to {bottom: 30px; opacity: 1;}
                    }

                    @-webkit-keyframes fadeout {
                        from {bottom: 30px; opacity: 1;} 
                        to {bottom: 0; opacity: 0;}
                    }

                    @keyframes fadeout {
                        from {bottom: 30px; opacity: 1;}
                        to {bottom: 0; opacity: 0;}
                    }
                    
                    
                </style>
            </head>
            <body onload="clearForms()">
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
                <!-- The actual snackbar -->
                <div id="snackbar"></div>
                <div id="footer" style="color: white"><br></div>
            </body>
            
            <script>
                function clearForms()
                {
                  var i;
                  for (i = 0; (i < document.forms.length); i++) {
                    document.forms[i].reset();
                  }
                }
                
                function snackbar(snackBarMessage) {
                    console.log("Snackbar: " + snackBarMessage);
                    // Get the snackbar DIV
                    var x = document.getElementById("snackbar");
                    if (snackBarMessage != "" && snackBarMessage != null){
                        
                        x.innerHTML = snackBarMessage;

                        // Add the "show" class to DIV
                        x.className = "show";

                        // After 3 seconds, remove the show class from DIV
                        setTimeout(function(){ x.className = x.className.replace("show", ""); x.innerHTML = ""; }, 3000);
                    }
                }
                
                document.addEventListener("mousemove", function(event){
                    document.getElementById("floatingDetails").style.left = event.pageX + 10 + "px";
                    document.getElementById("floatingDetails").style.top = (event.pageY - 10) + "px";
                });
                
                function toggleFloatingDetails(reveal){
                    document.getElementById("floatingDetails").hidden = !reveal;
                    //updateDetailBox(GetItemJson("0"));
                }
                
                function getItemFloatingDetails(id){
                    GetItemJson(id);
                }
                
                function updateDetailBox(json){
                    $( "#floatingDetails" ).find( "#name" )[0].innerHTML = json["name"];
                    $( "#floatingDetails" ).find( "#price" )[0].innerHTML = "<b>Price:</b> " + json["price"]
                    $( "#floatingDetails" ).find( "#description" )[0].innerHTML = "<b>Description:</b> " + json["description"];
                }

                
            </script>
        </html>
        <?php
        
    } //end of displayFooter function
}
