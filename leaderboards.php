<?php 
    include('connection.php');
    //obtain stuff from the database
    $sql = "SELECT * FROM `leaderboard` ORDER BY score DESC, created_at ASC;";  
    $result = mysqli_query($con, $sql);  
    $vals = mysqli_fetch_all($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);
    mysqli_free_result($result);
    mysqli_close($con);  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboards</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      
</head>
<body>
<h1 align="center">Leaderboards</h1>
<div class="table-responsive table-striped">
<table align='center' class="table m-5 p-5">
  <thead class="thead-dark">  
  <tr>
      <th>Rank</th>
      <th>Name</th>
      <th>Email</th>
      <th>Score</th>
    </tr>
  </thead>
    <?php for($i=0;$i<$count;$i++){ ?>
        <tr>
        <td><?php echo $i+1;?></td>
        <td><?php echo $vals[$i]['name'];?></td>
        <td><?php echo $vals[$i]['email'];?></td>
        <td><?php echo $vals[$i]['score'];?></td>
        </tr>
    <?php } ?> 
</table>
</div>
</body>
</html>