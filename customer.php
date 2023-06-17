<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);


    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Negative values cannot be transferred!")'; 
        echo '</script>';
    }    
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance!")';  
        echo '</script>';
    }
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Zero value cannot be transferred!')";
         echo "</script>";
     }
    else {

                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);

                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Hurray! Transaction is Successful');
                                     window.location='transactions.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

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
	<div class="container">i      
    <h2 style="text-align:center;">Easy Fund Transfer...!</h2>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
           <h3 style="margin:10px 150px;font-size:20px;color:white;"> From:</h3>
        <table id="customers">
  <tr>
    <td style="font-weight:bold;">Account No:</td>
    <td ><?php echo $rows['id'] ?></td>
    </tr>
    <tr>
    <td style="font-weight:bold;">Account Holder Name:</td>
    <td ><?php echo $rows['name']?></td>
            </tr>
    <tr>
    <td style="font-weight:bold;">Email Id:</td>
    <td ><?php echo $rows['email']?></td>
            </tr>
            <tr>
    <td style="font-weight:bold;">Balance:</td>
    <td ><?php echo $rows['balance']?></td>
    
  </tr>
  
            </table>
        </div>
        <br>
        <h3 style="margin:10px 150px;font-size:20px;color:white;">Transfer To:</h3>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose account</option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
       
            <label style="color : black;margin:10px 150px;color:white;"><b>Amount (Rs.):</b></label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="btn mt-3" name="submit" type="submit" id="myBtn" >Transfer Money</button>
            </div>
        </form>
    </div>
    

</body>
</html>