<?php
    include('connection.php');
    $str = file_get_contents("instructions.json");
    $inst = json_decode($str,true);
    //print_r($inst);
    $count = sizeof($inst);
?>


<html>  
<head>  
    <title>Crypt Hunt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
    <style>
        .frm{
            margin: auto;
            margin-top: 2em;
            margin-bottom: 2em;
            padding: 1em 3em 1em 3em;
            width: 600px;
            background-color: lightgrey;
        }
        .errorbox{
            margin: -0.5em 0 0.5em 0;
            color:red;
        }
        .bts{
            padding-top: 1em;
            padding-bottom: 1em;
            margin: auto;
            width: 400px;
            display: flex;
            justify-content: space-between;
        }
    </style> 
</head>  
<body>  
    <h1 align='center'>Welcome to Crypt Hunt</h1>
    <div class = "frm">  
        <h2 align="center">Instructions</h2>
        <div class="list-group">
        <ul>
        <?php for($i=0;$i<$count;$i++){ ?>
            <li><?php echo $inst[$i]["instruction"];?></li>
    <?php } ?> 
        </ul>
    <h2 style ="color:orangered;" align="center"> So what are you waiting for?</h3>
    <h1 style ="color:green;" align="center">Ready? Set? Go!</h1>        
    <div class="bts">
    <a class="btn btn-primary" align="center" href="./signup.php">Click here to Sign Up</a>
    <a class="btn btn-primary" align="center" href="./login.php">Click here to Log In</a>  
    </div>
    <a class="btn btn-info" align="center" href="./leaderboards.php">See the Leaderboards</a>
    </div> 
</body>     
</html>