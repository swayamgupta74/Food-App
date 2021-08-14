<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $name=$phone=$address=$type="";
$username_err = $password_err = $confirm_password_err = $name_err=$phone_err=$address_err=$type_err="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $type=$_POST["type"];
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        if($type=="Customer")
        $sql = "SELECT c_id FROM customer WHERE c_id = ?";
        else $sql = "SELECT s_id FROM shop WHERE s_id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    //validate phone
    if(empty(trim($_POST["phone"])))
    {
        $phone_err="Please phone";
    }
    else if(!preg_match('/^[0-9_]/', trim($_POST["phone"])) || strlen($_POST["phone"])!=10)
    {
        $phone_err="Please enter valid phone no.";
    }
    else{
        $phone=trim($_POST["phone"]);
    }
    //validate name
    if(empty(trim($_POST["address"])))
    {
        $address_err="Please address";
    }
    else 
    {
        $address=trim($_POST["address"]);
    }
    //validate address
    if(empty(trim($_POST["name"])))
    {
        $name_err="Please name";
    }
    else 
    {
        $name=trim($_POST["name"]);
    }
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) &&empty($address_err)&&empty($phone_err)&&empty($name_err)){
        
        // Prepare an insert statement
        if($type=="Customer")
        $sql = "INSERT INTO customer (c_id, c_password,phone_no, name, address) VALUES (?, ?,?,?,?)";
        else $sql = "INSERT INTO shop (s_id, s_password,phone_no, name, address) VALUES (?, ?,?,?,?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiss", $param_username, $param_password,$param_phone,$param_name,$param_address);
            
            // Set parameters
            $param_username = $username;
            $param_password = $password; 
            $param_name=$name;
            $param_phone=$phone;
            $param_address=$address;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "Registered succesfully";
                header("location:login.html");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    else 
    echo $username_err.$password_err.$confirm_password_err.$name_err.$phone_err.$address_err;
    // Close connection
    mysqli_close($link);
}
else echo"method is  wrong";
?>