<?php
    include('connection.php');
    $email = $name = $password = $college = '';  
    $errors = array('email'=>'','name'=>'','college'=>'', 'password'=>'');
    if(isset($_POST['submit'])){
        //email
        //htmlspecialchars is used to prevent XSS cross-scripting
        if(empty($_POST['email'])){
            $errors['email'] = "An email is required! <br>";
        }
        else{
            $email = htmlspecialchars($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "Invalid email! <br>";
            }
        }
        //name
        if(empty($_POST['name'])){
            $errors['name'] = "A name is required! <br>";
        }
        else{
            $name = htmlspecialchars($_POST['name']);
            if(!preg_match('/^[a-zA-Z\s]+$/',$name)){
                $errors['name'] = "Invalid name! Letters and spaces only ! <br>";
            }
        }
        //password
        if(empty($_POST['password'])){
            $errors['password'] = "A password is required! <br>";
        }
        else{
            $password = htmlspecialchars($_POST['password']);
        }
        //college name
        if(empty($_POST['college'])){
            $errors['college'] = "A college name is required! <br>";
        }
        else{
            $college = htmlspecialchars($_POST['college']);
            if(!preg_match('/^[a-zA-Z\s]+$/',$college)){
                $errors['college'] = "Invalid college name! Letters and spaces only ! <br>";
            }
        }

        if(!array_filter($errors)){
            //if no errors
            $sql = "SELECT * FROM `leaderboard` WHERE email = '$email';";  
            $result = mysqli_query($con, $sql);   
            $count = mysqli_num_rows($result);
            //To prevent sql injection
            $sanitised_name = mysqli_escape_string($con,$name);
            $sanitised_email = mysqli_escape_string($con,$email);
            $sanitised_college = mysqli_escape_string($con,$college);
            $sanitised_password = mysqli_escape_string($con,$password);
            if($count==0){
                $sql = "INSERT INTO `leaderboard`(`id`, `name`, `email`, `score`, `created_at`, `college`,`password`) VALUES (NULL, '$sanitised_name', '$sanitised_email', '0', current_timestamp(), '$sanitised_college','$sanitised_password');";
                if($con->query($sql) === TRUE){
                    if(!isset($_SESSION)){ 
                        session_start(); 
                    } 
                    $_SESSION['userData'] = ['name'=>$sanitised_name,'college'=>$sanitised_college,'email'=>$sanitised_email,'password'=>$sanitised_password]; 
                    header('Location: ./questions.php');
                }
                else{
                    echo "There was an error! Try again!";
                } 
            }
            else{
                echo "Account already exists! Log in instead!".'<br>';
            }
            mysqli_free_result($result);
            mysqli_close($con);
        }
    }
?>


<html>  
<head>  
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
    <style>
        .frm{
            margin: auto;
            margin-top: 2em;
            margin-bottom: 2em;
            padding: 3em 3em 1em 3em;
            width: 600px;
            background-color: lightgrey;
        }
        .errorbox{
            margin: -0.5em 0 0.5em 0;
            color:red;
        }
    </style> 
</head>  
<body>  
    <h1 align='center'>Welcome to Crypt Hunt</h1>
    <div class = "frm">  
        <h1>Sign up</h1>
        <!-- Form for Signup   -->
        <form name="f1" action = "signup.php" method = "POST">  
            <div class='form-group'>  
                <label> Email: </label>  
                <input class="form-control" type = "email" id ="email" name  = "email" />  
            </div>
            <div class="errorbox">
                <?php echo $errors['email'];?>
            </div>  
            <div class="form-group">  
                <label> Password: </label>  
                <input class="form-control" type = "password" id ="password" name  = "password" />  
            </div>
            <div class="errorbox">
                <?php echo $errors['password'];?>
            </div>
            <div class="form-group">  
                <label> College: </label>  
                <input class="form-control" type = "text" id ="college" name  = "college" />  
            </div>
            <div class="errorbox">
                <?php echo $errors['college'];?>
            </div>   
            <div class="form-group">  
                <label> Name: </label>  
                <input class="form-control" type = "text" id ="name" name  = "name" />  
            </div>
            <div class="errorbox">
                <?php echo $errors['name'];?>
            </div>  
            <p>     
                <input class="btn btn-primary" type =  "submit" id = "btn" name = "submit" />  
            </p>  
            <a href="./login.php">Already have an account? Click here to Log in</a> 
        </form> 
    </div>    
</body>     
</html>