<?php
$insert=false;
// $emailc=false;
$signin=false;
$inslog=false;
$login=false;
global $de;
$passe=false;
$pri=false;
// session_start();
//generating connection with the database cude
  global $query1,$conn;
$server="localhost";
$username="root";
$password="";

$db="cude";
$conn=mysqli_connect($server,$username,$password,$db);
//Storing the sign_in details of the user in user_details table under cude database.
// $signin=false;

if(isset($_POST['name'])){
 $insert=true;
 $name=$_POST['name'];
$gender=$_POST['gender'];
$password=$_POST['password'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$regno=$_POST['regno'];
//Now we are checking if the password is matching with confirm password entered by the user.
/*In the user_details table we have seven columns(Name,Registration number,email,gender,password,phone number,serial number,
)*/
$conpassword=$_POST['conpassword'];
if($password!=$conpassword){
  $passe=true;
// echo "<p class='match'>The two passwords do not match</p>";
 }
//If not then we insert the details into the table named as 'user_details' using INSERT INTO command.
else{
  $email1 =$email;
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
// check if the primary key already exists in the table
$query4 = "SELECT * FROM user_details WHERE Reg_no = '$regno'";
$resultp = $conn->query($query4);
if (mysqli_num_rows($resultp)>0) {
   $pri=true;
//  echo " <p class='match'>The primary key value entered already exists</p>"; 
} 
else {
  // the primary key doesn't exist, proceed with
$query="INSERT INTO `user_details` (`Name`, `Reg_No`, `Mobile_No`, `gender`,`email`,`Password`) VALUES ( '$name', '$regno', '$phone', '$gender','$email', '$password');";
 $signin=true;
  //generating a query on the connection with the database.  
if($conn->query($query)==true){
    //echo"SUCCESSFULL";
  }
else{
   // echo "ERROR:$sql<br"
}// echo "<p class='match'You have signed up successfully.</p>";
       }
     }
    }

if(isset($_POST['regno1'])){
  $inslog=true;
    $server="localhost";
    $username="root";
    $password="";
    $db="cude";
    $conn=mysqli_connect($server,$username,$password,$db);
    $regno1=$_POST['regno1'];
    $password1=$_POST['password1'];
   /*In login_details table we have seven columns (out_time,in_time,location,registration number,Password,serial number,email)*/
    //Declaring a variable that selects the row containing registration number and password from the sign in table(user_details).
    $query1="SELECT * FROM `user_details` WHERE `Reg_no`=? ";
  //Storing the login_in details of the user in login_details table under cude database in mysql.
//using $_POST commands we retreive the data from the respective forms in html created above.
$results=mysqli_query($conn,$query1);
mysqli_stmt_bind_param($results, "s", $regno1);
mysqli_stmt_execute($results);
$resultt = mysqli_stmt_get_result($results);
$row = mysqli_fetch_assoc($resultt);
$hashed_password = $row['Password'];
//checking if there there is a row that contains same registration number and password in user_details as entered by the user in login_details
//using mysqli_num_rows.

  if (password_verify($password1, $hashed_password)) {
   
  
//We declare a variable $statement and it is responsible for fetching the email address and pasting it in login_details.
$statement = mysqli_prepare($conn, "SELECT `email` FROM user_details WHERE Reg_No = ?");
//This is used for binding/connecting $statement and $regno1.
mysqli_stmt_bind_param($statement, "s", $regno1);
// Now we are executing the query.
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $email=$row['email'];
    $log="INSERT INTO `login_details` (`out_time`, `Reg_no`, `in_time`, `Password`,`email`) VALUES (current_timestamp(), '$regno1', current_timestamp(), '$password1','$email');";
    $login=true;
     if($conn->query($log)==true){
       $myDate = new DateTime('now', new DateTimeZone('Asia/Calcutta'));
     
         $start_time = new DateTime('10:00 PM', new DateTimeZone('Asia/Calcutta'));
             
              $end_time = new DateTime('6:00 AM', new DateTimeZone('Asia/Calcutta'));
$de=false;
// echo "Start time: " . $start_time->format('h:i A') . "<br>";
// echo "End time: " . $end_time->format('h:i A') . "<br>";
// echo " current time: " . $myDate->format('h:i A') . "<br>";
     if ($myDate >= $start_time && $myDate <= $end_time) {
        $server="localhost";
    $username="root";
    $password="";
    $db="cude";
     $conn=mysqli_connect($server,$username,$password,$db);
$late="INSERT INTO  `late_entries` (`Reg_no`,`Date_time`) VALUES ('$regno1',current_timestamp());";
           if($conn->query($late)==true){
                       }
  // echo "<p class='match'>You have exceeded the in time</p>";
        }
      else {
      $de=true;
     // echo "<p class='match'>You have successfully completed your daily entry</p>";
        } } }}}
      
  else{
     //  echo "<p class='match'>Entered details are invalid</p>";
    }
  }
?>





<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <style>
      .match{
    text-align:center;
    margin:auto;
    font-size:22px;
    color:darkred;
   }

</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <section id="section-6">
        <!-- Section title -->
        
        <!--Section: Demo-->
        <section class="pb-4">
      <div class="bg-white border rounded-5">
        
        <section class="w-100 px-4 py-5 gradient-custom" style="border-radius: .5rem .5rem 0 0;">
          <style>
            .gradient-custom {
              /* fallback for old browsers */
              background: #6a11cb;
    
              /* Chrome 10-25, Safari 5.1-6 */
              background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
    
              /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
              background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
            }
          </style> 
          <form method="post" action="index5.php">
          <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-6">
              <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
    
                  <div class="mb-md-5 mt-md-4 pb-5">
    
                    <h2 class="fw-bold mb-2 text-uppercase">Signin</h2>
                    <p class="text-white-50 mb-5">Please enter your entries!</p>
    
                    <div class="form-outline form-white mb-4">
                      <input type="text" id="typeEmailX" class="form-control form-control-lg" name="name"required>
                      <label class="form-label" for="typeEmailX" style="margin-left: 0px;">Name</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 40px;"></div><div class="form-notch-trailing"></div></div></div>
                    <div class="form-outline form-white mb-4">
                        <input type="text" id="typeEmailX" class="form-control form-control-lg" name="regno"required>
                        <label class="form-label" for="typeEmailX" style="margin-left: 0px;">Registration No.</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 40px;"></div><div class="form-notch-trailing"></div></div></div>
                      <div class="form-outline form-white mb-4">
                        <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email"required>
                        <label class="form-label" for="typeEmailX" style="margin-left: 0px;">Email</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 40px;"></div><div class="form-notch-trailing"></div></div></div>
                      <div class="form-outline form-white mb-4">
                        <input type="gender" id="typeEmailX" class="form-control form-control-lg" name="gender"required>
                        <label class="form-label" for="typeEmailX" style="margin-left: 0px;">Gender</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 40px;"></div><div class="form-notch-trailing"></div></div></div>
                      <div class="form-outline form-white mb-4">
                      
                        <input type="tel" id ="typePhone" class="form-control form-control-lg" name="phone" pattern="[0-9]{10p}"required>
                        <label class="form-label" for="phone" style="margin-left: 0px;">Phone No.</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 40px;"></div><div class="form-notch-trailing"></div></div></div>
                      <div class="form-outline form-white mb-4">
                        <input type="password" id="typeEmailX" class="form-control form-control-lg" name="password"required>
                        <label class="form-label" for="typeEmailX" style="margin-left: 0px;">Password</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 40px;"></div><div class="form-notch-trailing"></div></div></div>
            
                    <div class="form-outline form-white mb-4">
                      <input type="password" id="typePasswordX" class="form-control form-control-lg" name="conpassword" required>
                      <label class="form-label" for="typePasswordX" style="margin-left: 0px;"> Confirm Password</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 64px;"></div><div class="form-notch-trailing"></div></div></div>
    
                   
                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign In</button>
                    </form><?php
                    if($insert==true){
                        if($pri==true){
                     echo " <p class='match'>The primary key value entered already exists</p>"; 
                   }
                   else{

                     if($passe==true){
                       echo "<p class='match'>The two passwords does not match</p>";
                     }
                     else{
                 if($signin==true){
                     echo "<p class='match'>You have signed up successfully.</p>";
                   }
                   else{
                  //echo "<p class='match'>Regitration number already exists</p><br>"; 
                   
                 }
                   }
                
                   }
                   }
                   ?>
                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                      <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                      <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                      <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                    </div>
    
                  </div>
    
                  <!-- <div>
                    <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a></p>
                  </div> -->
    
                </div>
              </div>
            </div>
          </div>
        </section>
        
        
        
        <div class="p-4 text-center border-top mobile-hidden">
          <a class="btn btn-link px-3 collapsed" data-mdb-toggle="collapse" href="#example6" role="button" aria-expanded="false" aria-controls="example6" data-ripple-color="hsl(0, 0%, 67%)" >
            <i class="fas fa-code me-md-2"></i>
            <!-- <span class="d-none d-md-inline-block">
              Show code
            </span> -->
          </a>
          
          
            <a class="btn btn-link px-3" data-ripple-color="hsl(0, 0%, 67%)" >
              <i class="fas fa-file-code me-md-2 pe-none"></i>
              <!-- <span class="d-none d-md-inline-block export-to-snippet pe-none">
                Edit in sandbox
              </span> -->
            </a>
          
        </div>
        
        
      </div>
    </section>
    
        <!--Section: Demo-->
    
        <!--Section: Code-->
        <section>
          <section class="collapse" id="example6" >
            <div class="pb-4">
              
    
    
    
    
    
    
    
    
    
      
    
      <div class="docs-pills border mobile-hidden">
        <div class="d-flex justify-content-between py-2" style="padding-left: .6rem;">
          <ul class="nav nav-pills p-2" role="tablist">
            
              
              
              
              <li class="nav-item" role="presentation"><a class="nav-link  active show " data-mdb-toggle="tab" href="#mdb_f5d2f5982c58d61349d7518374034a2b85770a9a" role="tab" aria-selected="true">HTML</a></li>
              
            
              
              
              
              <li class="nav-item" role="presentation"><a class="nav-link " data-mdb-toggle="tab" href="#mdb_ec66fb5c339c4f66f72f2d2db155cbe6114f9987" role="tab" aria-selected="false" tabindex="-1">CSS</a></li>
              
            
            
            
          </ul>
        </div>
        <div class="tab-content">
          
              
    
    
    
    
    <div class="tab-pane fade  active show " id="mdb_f5d2f5982c58d61349d7518374034a2b85770a9a" role="tabpanel">
        <div class="code-toolbar"><pre class="grey lighten-3 mb-0 line-numbers  language-html"><code class=" language-html"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>section</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>vh-100 gradient-custom<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
      <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>container py-5 h-100<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
        <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>row d-flex justify-content-center align-items-center h-100<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
          <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>col-12 col-md-8 col-lg-6 col-xl-5<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
            <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>card bg-dark text-white<span class="token punctuation">"</span></span><span class="token style-attr language-css"><span class="token attr-name"> <span class="token attr-name">style</span></span><span class="token punctuation">="</span><span class="token attr-value"><span class="token property">border-radius</span><span class="token punctuation">:</span> 1rem<span class="token punctuation">;</span></span><span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
              <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>card-body p-5 text-center<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
    
                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>mb-md-5 mt-md-4 pb-5<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
    
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>h2</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>fw-bold mb-2 text-uppercase<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Login<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>h2</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>text-white-50 mb-5<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Please enter your login and password!<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span>
    
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>form-outline form-white mb-4<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>input</span> <span class="token attr-name">type</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>email<span class="token punctuation">"</span></span> <span class="token attr-name">id</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>typeEmailX<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>form-control form-control-lg<span class="token punctuation">"</span></span> <span class="token punctuation">/&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>label</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>form-label<span class="token punctuation">"</span></span> <span class="token attr-name">for</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>typeEmailX<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Email<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>label</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
    
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>form-outline form-white mb-4<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>input</span> <span class="token attr-name">type</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>password<span class="token punctuation">"</span></span> <span class="token attr-name">id</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>typePasswordX<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>form-control form-control-lg<span class="token punctuation">"</span></span> <span class="token punctuation">/&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>label</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>form-label<span class="token punctuation">"</span></span> <span class="token attr-name">for</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>typePasswordX<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Password<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>label</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
    
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>small mb-5 pb-lg-2<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>text-white-50<span class="token punctuation">"</span></span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>#!<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Forgot password?<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span>
    
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>button</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>btn btn-outline-light btn-lg px-5<span class="token punctuation">"</span></span> <span class="token attr-name">type</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>submit<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Login<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>button</span><span class="token punctuation">&gt;</span></span>
    
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>d-flex justify-content-center text-center mt-4 pt-1<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>#!<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>text-white<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>i</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>fab fa-facebook-f fa-lg<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>i</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>#!<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>text-white<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>i</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>fab fa-twitter fa-lg mx-4 px-2<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>i</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>#!<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>text-white<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>i</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>fab fa-google fa-lg<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>i</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
    
                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
    
                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>p</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>mb-0<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Don't have an account? <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>#!<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>text-white-50 fw-bold<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Sign Up<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span>
                  <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>p</span><span class="token punctuation">&gt;</span></span>
                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
    
              <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
            <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
          <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
        <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
      <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>section</span><span class="token punctuation">&gt;</span></span><span aria-hidden="true" class="line-numbers-rows"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span></code></pre><div class="toolbar"><div class="toolbar-item"><button class="btn-copy-code btn btn-sm" data-mdb-ripple-color="dark" data-mdb-ripple-unbound="true">Copy</button></div></div></div>
    </div>
    
              
    
    
    
    
    <div class="tab-pane fade " id="mdb_ec66fb5c339c4f66f72f2d2db155cbe6114f9987" role="tabpanel">
        <div class="code-toolbar"><pre class="grey lighten-3 mb-0 line-numbers  language-css"><code class=" language-css"><span class="token selector">.gradient-custom</span> <span class="token punctuation">{</span>
    <span class="token comment">/* fallback for old browsers */</span>
    <span class="token property">background</span><span class="token punctuation">:</span> <span class="token color">#6a11cb</span><span class="token punctuation">;</span>
    
    <span class="token comment">/* Chrome 10-25, Safari 5.1-6 */</span>
    <span class="token property">background</span><span class="token punctuation">:</span> <span class="token gradient"><span class="token function">-webkit-linear-gradient</span><span class="token punctuation">(</span>to right<span class="token punctuation">,</span> <span class="token function">rgba</span><span class="token punctuation">(</span>106<span class="token punctuation">,</span> 17<span class="token punctuation">,</span> 203<span class="token punctuation">,</span> 1<span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token function">rgba</span><span class="token punctuation">(</span>37<span class="token punctuation">,</span> 117<span class="token punctuation">,</span> 252<span class="token punctuation">,</span> 1<span class="token punctuation">)</span><span class="token punctuation">)</span></span><span class="token punctuation">;</span>
    
    <span class="token comment">/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */</span>
    <span class="token property">background</span><span class="token punctuation">:</span> <span class="token gradient"><span class="token function">linear-gradient</span><span class="token punctuation">(</span>to right<span class="token punctuation">,</span> <span class="token function">rgba</span><span class="token punctuation">(</span>106<span class="token punctuation">,</span> 17<span class="token punctuation">,</span> 203<span class="token punctuation">,</span> 1<span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token function">rgba</span><span class="token punctuation">(</span>37<span class="token punctuation">,</span> 117<span class="token punctuation">,</span> 252<span class="token punctuation">,</span> 1<span class="token punctuation">)</span><span class="token punctuation">)</span></span>
    <span class="token punctuation">}</span><span aria-hidden="true" class="line-numbers-rows"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span></code></pre><div class="toolbar"><div class="toolbar-item"><button class="btn-copy-code btn btn-sm" data-mdb-ripple-color="dark" data-mdb-ripple-unbound="true">Copy</button></div></div></div>
    </div>
    
              
        </div>
      </div>
    
      
    
     </div>
          </section>
        </section>
        
      </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>
