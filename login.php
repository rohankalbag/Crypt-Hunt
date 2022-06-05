<?php
    include('connection.php');
    $email = $name = $password = $college = '';  
    $errors = array('email'=>'', 'password'=>'');
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
        //password
        if(empty($_POST['password'])){
            $errors['password'] = "A password is required! <br>";
        }
        else{
            $password = htmlspecialchars($_POST['password']);
        }

        if(!array_filter($errors)){
            //To prevent sql injection
            $sanitised_password = mysqli_escape_string($con,$password);
            $sanitised_email = mysqli_escape_string($con,$email);
            //if no errors
            $sql = "SELECT * FROM `leaderboard` WHERE email = '$sanitised_email';";  
            $result = mysqli_query($con, $sql);   
            $count = mysqli_num_rows($result);
            if($count==0){
                echo "Are you new here? Sign up instead!";
            }
            else{
                if(!isset($_SESSION)){ 
                    session_start(); 
                  } 
                $vals = mysqli_fetch_all($result, MYSQLI_ASSOC);
                if($vals[0]['password']==$sanitised_password){
                    $_SESSION['userData'] = $vals[0];
                    header('Location: ./questions.php');
                }
                else{
                    echo "Incorrect Password! Try Again!".'<br>';
                }
            }
            mysqli_free_result($result);
            mysqli_close($con);
        }
    }
?>


<html>  
<head>  
    <title>Login</title>
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
        <h1>Login</h1>
        <!-- Form for Signup   -->
        <form name="f2" action = "login.php" method = "POST">  
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
            <p>     
                <input class="btn btn-primary" type =  "submit" id = "btn" name = "submit" />  
            </p>  
            <a href="./index.php">New here? Click here to Sign up</a> 
        </form> 
    </div>    
</body>     
</html>