<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">

</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      <h3><?php echo $fetch['name']; ?></h3>
      <a href="update_profile.php" class="btn">update profile</a>
      <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
      <p>new <a href="login.php">login</a> or <a href="register.php">register</a></p>
   </div>
   <a class="btn btn-first" href="linking/index.php">Upload Aadharcard</a>
   <a class="btn btn-first" href="linking/index.php">Upload pancard</a>
   <a class="btn btn-first" href="linking/index.php">Upload salaryslips</a>
   <form action="action_page.php">

<label for="name">Bank Details</label>
<input type="text" id="name" name="name" placeholder="Your name..">

<label for="email">CTC</label>
<input type="email" id="email" name="email" placeholder="email">

<label for="Message">Message</label>
<textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>

<input type="submit" value="Submit">

</form>

</div>
<a class="btn btn-first" href="panel/index.html">Apply for  Loan</a>

</body>
</html>