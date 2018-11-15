   //formatting to pull session information for $login variable
    $page_title = "$login's Account";
    
    if(empty($login)){
        echo "Please log in and try again.";
        include ('includes/footer.php');
        die;
    }

    //select statement
    $sql = "SELECT * FROM users WHERE username=?";
    
    //prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $login);

    //execute prepared statement
    $execute = $stmt->execute();
    
    //retrieves results
    $results = $stmt->get_result();

    //errors
    if (!$results) {
        $errno = $conn->errno;
        $errmsg = $conn->error;
        $conn->close();
        echo "No user found.  Error:'$errmsg'";
        include ('includes/footer.php');
        die;
    } else {
        $row = $results->fetch_assoc();
    }
    //execute prepared statement
    $execute = $stmt->execute();
    
    //retrieves results
    $results = $stmt->get_result();

    //errors
    if (!$results) {
        $errno = $conn->errno;
        $errmsg = $conn->error;
        $conn->close();
        echo "No user found.  Error:'$errmsg'";
        include ('includes/footer.php');
        die;
    } else {
        $row = $results->fetch_assoc();
?>

    <h2>Account Information</h2>
   

        <form name="accountupdate" action="accountupdate.php" method="POST">
            <table class="table">

                <tr>
                    <th>Username</th>
                    <td><input name="username" value="<?php echo $row['username'] ?>" size="50" readonly/></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><input type="password" name="password" value="" size="50"/></td>
                </tr>  
                <tr>
                    <th>First Name</th>
                    <td><input name="firstName" value="<?php echo $row['firstName']," ", $row['firstname'] ?>" size="50" readonly/></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input name="lastName" value="<?php echo $row['lastName']," ", $row['lastname'] ?>" size="50" readonly/></td>
                </tr>                
                <tr>
                    <th>Email Address</th>
                    <td><input type="email" name="email" value="<?php echo $row['email'] ?>" size="50" required /></td>
                </tr>

                    <th>Phone</th>
                    <td><input type="tel" name="phone" value="<?php echo $row['phone'] ?>" size="50" required /></td>
                </tr>  
            </table>
            <br>

            <input type="submit" value="Update" class="btn bnt-default"/>
            &nbsp;&nbsp;<input type="button" onclick="window.location.href='index.php'" value="Cancel" class="btn bnt-default"/>
            &nbsp;&nbsp;<form action="accountdelete.php">
            <input type ="submit" onclick="window.confirm('Are you sure you want to delete your account?  This action cannot be reversed!')" value="Delete Account" class="btn bnt-default"/>
            </form>
        </form>
        
        <!--Delete account button and script-->

    </div>
            
    
    
<?php
    // clean results
    $results->close();

    // close connection
    $conn->close();