<?php
    include('connection.php');
    $str = file_get_contents("crypt.json");
    $questions = json_decode($str,true);
    //echo print_r($questions);
    $userData = $_SESSION['userData'];
    $email = $userData['email'];
    //print_r($userData);
    if(sizeof($userData)==0){
        header('Location: ./index.php');
    }
    $sql = "SELECT * FROM `leaderboard` WHERE email = '$email';";  
    $result = mysqli_query($con, $sql);
    $vals = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //print_r($vals);  
    if(isset($_POST['increment'])){
        $userAns = strtolower(htmlspecialchars($_POST['answer'])); 
        if($userAns == $questions[$vals[0]['score']]['answer']){
            $currid = $vals[0]['id'];
            $currscore = $vals[0]['score'] + 1;
            // echo $currid . '<br>';
            // echo $currscore. '<br>';
            $sql= "UPDATE `leaderboard` SET `score` = '$currscore', `created_at` = current_timestamp() WHERE `leaderboard`.`id` = $currid;";
            if($con->query($sql) === TRUE){
                if(!isset($_SESSION)){ 
                    session_start(); 
                } 
                $_SESSION['userData'] = $userData; 
                header('Location: ./questions.php');
            }
            else{
                echo "There was an error! Try again!";
            } 
        }
        else{
            if(!isset($_SESSION)){ 
                session_start(); 
            } 
            $_SESSION['userData'] = $userData; 
            header('Location: ./questions.php');
        }
    }
    mysqli_free_result($result);
    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
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
        .mybox{
            margin: 2em 0 2em 0;
        }
        .bts{
            text-align: center;
            padding: 2em;
        }
    </style>   
</head>
<body>
    <div>
        <?php if($vals[0]['score'] < count($questions)){?>
        <h1 align='center'>Question <?php echo $vals[0]['score'] + 1;?></h1>
        <div class="frm">
        <h5 align="center"><?php echo $questions[$vals[0]['score']]['question'];?></h5>
        <form action="questions.php" method='POST'>
            <div class="form-group mybox">  
                <label>Answer</label>  
                <input class="form-control" type = "text" id ="answer" name  = "answer"/>  
            </div>
            <input class="btn btn-primary" type="submit" name="increment" value="Submit"/>
        </form>
        </div>
    <h2 align='center'>Your current score is <?php echo $vals[0]['score'];?></h2>
    <h4 align='center'>Questions Left: <?php echo (count($questions)- $vals[0]['score']);?></h4>
        <?php }
        else{ ?>
        <div class="frm">
            <h1 align="center">Congratulations!</h1>
            <h2 align="center">You have successfully completed the crypt hunt!</h2>
            <div class="bts">
            <a class="btn btn-info" align="center" href="./leaderboards.php">See the Leaderboards</a>
            </div>
        </div>
        <?php }?>     
    </div>
</body>
</html>