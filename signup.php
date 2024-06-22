<!DOCTYPE html>
<?php require_once("config.php");
?> 
<html>
    <head>
        <title>signup</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background: #fff;">
<div class="container">
  <div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
    </div>
  </div>
  <div class="row">
      <?php
      if(isset($_POST['signup']))
      {
          extract($_POST);
          if(strlen($fname)<3)
          {
              //min
              $error[]='please enter first namer using 3 characters 
              atleast';
          }
          if(strlen($fname)>20){
              //max
              $error[]= 'First Name: max length 20 characters Not allowed';
          }
          if(!preg_match("/^[A-Za-z _]*[A-Za-z ]+[A-Za-z _]*$/",$fname)){
              $error[] = 'Invalid Entry First Name, Please Enter letter
               without any Digit or special symbols like
              (1,2,3#,$,%,&,!,~,^,-,)';
          }
          if(strlen($lname)<3)
          {
              
              $error[]='please enter last name using 3 characters 
              atleast';
          }
          if(strlen($lname)>20){
              
              $error[]= 'Last Name: max length 20 characters Not allowed';
          }
          if(!preg_match("/^[A-Za-z _]*[A-Za-z ]+[A-Za-z _]*$/",$fname)){
              $error[] = 'Invalid Entry last Name, Please Enter letter
               without any Digit or special symbols like
              (1,2,3#,$,%,&,!,~,^,-,)';
          }
          if(strlen($username)<3)
          {
              //min
              $error[]='please enter username using 3 characters 
              atleast';
          }
          if(strlen($fname)>50){
              //max
              $error[]= 'UserName: max length 50 characters Not allowed';
          }
          if(!preg_match("/^^[^0-9][a-z0-9]+([_-]?[a-z0-9])*$/",$username)){
              $error[] = 'Invalid Entry for UserName. Enter Lowercase Letters
              without any space and No number at the start- Eg - myusername,
              okuniqueuser or myusername1234';
          }
          if(strlen($email)>50){
              $error[]= 'Email:Max length 50 Characters NOT allowed';
          }
          if($passwordConfirm ==''){
              $error[] = 'Please confirm the password.';
          }
          if($password != $passwordConfirm){
              $error[] = 'Password do not match.';
          }
          if(strlen($password)<5){
              $error[] = 'the Password is 6 characters long.';
          } 
          if(strlen($password)>20){
              $error[] = 'Password: Max Length 20 Characters Not allowed';
          } 
          $sql="select * from users where (username='$username' or email='$email');";
      $res=mysqli_query($dbc,$sql);
   if (mysqli_num_rows($res) > 0) {
$row = mysqli_fetch_assoc($res);

     if($username==$row['username'])
     {
           $error[] ='Username alredy Exists.';
          } 
       if($email==$row['email'])
       {
            $error[] ='Email alredy Exists.';
          } 
      }
            }  
        if(!isset($error)){
            $date=date('Y-m-d');
                $options = array("cost"=>4);
        $password = password_hash($password,PASSWORD_BCRYPT,$options);

    $result = mysqli_query($dbc,"INSERT into users values ('','$fname','$lname,'$username','$email','$password','$date')");
          
          if($result)
        {
            $done=2;
        }    
    else{
        $error[] = 'Failed : Something went wrong';
    } 
        }
         }
      ?>
    <div class="col-sm-4">
        <?php
        if(isset($error))
        {
            foreach($error as $error)
            {
                echo '<p class="errmsg">&#x26A0;'.$error.'</p>';
            }
        }
        ?>
    </div>
    <div class="col-sm-4"> 
        <?php if(isset($done))
        { ?>
        <div class="successmsg"><span style="font-size:100px;">&#9989;<span>
            <br> You have Registered successfully . <br> 
        <a href="login.php" style="color:#fff;">Login here... </a> </div>
    <?php }
    else { ?>
        <div class="signup_form">
    <form action="" method="POST">
  <div class="mb-3">
    <label class="label_txt">First Name</label>
    <input type="text" class="form-control" name="fname" value="<?php if(
    isset($error)) { echo $fname;}?> required="">
  </div>
  <div class="mb-3">
  <label class="label_txt">Last Name</label>
  <input type="text" class="form-control" name="lname"value="<?php if(
    isset($error)) { echo $lname;}?>  required="">
  </div>
  <div class="mb-3">
  <label class="label_txt">UserName</label>
  <input type="text" class="form-control" name="username" value="<?php if(
    isset($error)) { echo $username;}?>  required="">
  </div>
  <div class="mb-3">
  <label class="label_txt">Email</label>
  <input type="email" class="form-control" name="email" value="<?php if(
    isset($error)) { echo $email;}?>  required="">
  </div>
  <div class="mb-3">
  <label class="label_txt">Password</label>
  <input type="password" class="form-control" name="password" required="">
  </div>
  <div class="mb-3">
  <label class="label_txt"> Confirm Password</label>
  <input type="password" class="form-control" name="passwordConfirm" required="">
  </div>
  <button type="submit" name="signup" class=" form-btn btn btn-primary">SignUp</button>
  <p>Have an account?  <a href="login.php">Log in</a> </p> 
  <?php } ?>
</form>
</div>
</div>

<div class="col-sm-4">
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </html>