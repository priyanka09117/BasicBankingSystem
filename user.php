<!DOCTYPE html>
<?php
    include 'config.php';
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
?>
 
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
<h2 style="text-align:center;">Customers Details</h2>
<table id="customers">
  <tr>
    <th>Account No.</th>
    <th>Account Holder Name</th>
    <th>Email Id</th>
    <th>Balance</th>
    <th>Transfer</th>
  </tr>
  <?php 
    while($rows=mysqli_fetch_assoc($result)){
    ?>
                    <tr style="color : white;">
                        <td ><?php echo $rows['id'] ?></td>
                        <td ><?php echo $rows['name']?></td>
                        <td ><?php echo $rows['email']?></td>
                        <td ><?php echo $rows['balance']?></td>
                        <td><a href="customer.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class="btn" style="background-color : #74b9ff;">Transfer money</button></a></td> 
                    </tr>
                    <?php
                    }
                ?>
  </table>

</div>

</body>
</html>