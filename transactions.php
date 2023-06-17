<!DOCTYPE html>
<html>
<head>
 <title></title>
 <link rel="stylesheet" type="text/css" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>

<header class="site-header clearfix">
 <nav>
 <img src="IMG/logo.png" width="100px" height="65px">
   <h1>INDIAN BANK</h1>
   
  </div><br> 
  <div class="menu"> 
   <ul>
    <li><a href="index.php">Home</a></li> 
    <li><a href="user.php">User </a></li> 
    <li><a href="transactions.php"> User history</a></li>
    
   </ul>
  </div>
 </nav>

	<div class="container">
    <h2 style="text-align:center;">Transfer History</h2>
        
    <table id="customers">
  <tr>
    <th>Sr No.</th>
    <th>Sender Name</th>
    <th>Receiver Name</th>
    <th>Amount Transfer</th>
    <th>Date & Time</th>
  </tr>
       
        
        <?php

            include 'config.php';

            $sql ="select * from transaction";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

                    <tr style="color : white;">
                        <td ><?php echo $rows['sno'] ?></td>
                        <td ><?php echo $rows['sender']?></td>
                        <td ><?php echo $rows['receiver']?></td>
                        <td ><?php echo $rows['balance']?></td>
                        <td ><?php echo $rows['datetime']?></td>
                      
                    </tr>
                
        <?php
            }

        ?>
    </table>

    
</div>
</body>
</html>