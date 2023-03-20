<?php
$insert=false;
$emailc=false;
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
    $query1="SELECT * FROM `user_details` WHERE `Reg_no`='$regno1' AND `Password`='$password1'";
    //Storing the login_in details of the user in login_details table under cude database in mysql.
//using $_POST commands we retreive the data from the respective forms in html created above.
$results=mysqli_query($conn,$query1);
//checking if there there is a row that contains same registration number and password in user_details as entered by the user in login_details
//using mysqli_num_rows.
if(mysqli_num_rows($results)>0){
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
     //echo "successful";

     $myDate = new DateTime('now', new DateTimeZone('Asia/Calcutta'));
     
         $start_time = new DateTime('1:00 PM', new DateTimeZone('Asia/Calcutta'));
             
              $end_time = new DateTime('2:00 PM', new DateTimeZone('Asia/Calcutta'));
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
   //echo "<p class='match'>You have exceeded the in time</p>";
          }
      else {
      $de=true;
   //   echo "<p class='match'>You have successfully completed your daily entry</p>";
        } } }}}
  else{
     //  echo "<p class='match'>Entered details are invalid</p>";
    }
  }

// if(isset($_POST['bool'])){
//     $server="localhost";
//     $username="root";
//     $password="";
//     $db="cude";
//     $conn=mysqli_connect($server,$username,$password,$db);
//    $sqllate = "SELECT * FROM `late_entries`";
// $resultl = mysqli_query($conn, $sqllate);
// while ($row = mysqli_fetch_array($resultl)) {
//  echo "<tr>";
//     echo "<td>" . $row['Reg_no'] . "</td>";
//     echo "<td>" . $row['Date_time'] . "</td>";
//     // echo "<td>" . $row['column3'] . "</td>";
//     echo "</tr>";
// }
// mysqli_close($conn);
// }
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <style>
      .body{
        font-display: inline-block;
        font-size: large;
      }
      
        .gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}

.footer {
    display: block;
}

  ment.style {
    width: 280px;
    
}
.p-3 {
    padding: 1rem!important;
}
.flex-shrink-0 {
    flex-shrink: 0!important;
}
.flex-column {
    flex-direction: column!important;
}
.d-flex {
    display: flex!important;
}
.text-bg-dark {
    color: #fff!important;
    background-color: RGBA(33,37,41,var(--bs-bg-opacity,1))!important;
}
*, ::after, ::before {
    box-sizing: border-box;
}
user agent stylesheet
div {
    display: block;
}
.login{
display:inline-flex;
}
ment.style {
    width: 280px;
}
.p-3 {
    padding: 1rem!important;
}
.flex-shrink-0 {
    flex-shrink: 0!important;
}
.flex-column {
    flex-direction: column!important;
}
.d-flex {
    display: flex!important;
}
.text-bg-dark {
    color: #fff!important;
    background-color: RGBA(33,37,41,var(--bs-bg-opacity,1))!important;
}
*, ::after, ::before {
    box-sizing: border-box;
}
::after, ::before {
    box-sizing: border-box;
}

div {
    display: block;
}
.match{
    text-align:center;
    margin:auto;
    font-size:15px;
    color:darkred;
   }




      
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="body">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">CUDE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="final.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index3.html">About us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index4.html">Contact us</a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
    </div>
    <div class="login">
    <div class="bar">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height: 800px;">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="44"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Sidebar</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="final.php" class="nav-link active" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href=""></use></svg>
            Home
          </a>
        </li>
        <li>
          <a href="index6.html" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Rules
          </a>
        </li>
        <li>
          <a href="team.html" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
            Team
          </a>
        </li><ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="http://www.mnnit.ac.in" class="nav-link active" aria-current="page">
              <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
              MNNIT 
            </a>
          </li>
          <li>
            <a href="http://www.mnnit.ac.in/index.php/facilities/hostels" class="nav-link text-white">
              <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
              Hostel
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white">
              <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
              
            </a>
          </li>
        <li>
          <a href="#" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
            
          </a>
        </li>
        <li>
          <a href="#" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
            
          </a>
        </li>
      </ul>
      
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
          <li><a class="dropdown-item" href="#">New project...</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
      </div>
    </div>
    </div>
    
    <section class="h-100 gradient-form" style="background-color: #eee;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">
    
                    <div class="text-center">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                        style="width: 185px;" alt="logo">
                      <h4 class="mt-1 mb-5 pb-1">We are The CAME CHANGERS Team</h4>
                    </div>
    
                    <form  method="post" action="final.php">
                      <p>Please login to your account</p>
    
                      <div class="form-outline mb-4">
                        <input type="text" id="form2Example11" class="form-control"
                           name="regno1"/>
                        <label class="form-label" for="form2Example11">Registration No</label>
                      </div>
    
                      <div class="form-outline mb-4">
                        <input type="password" id="form2Example22" class="form-control"  name="password1"/>
                        <label class="form-label" for="form2Example22">Password</label>
                      </div>
    
                      <div class="text-center pt-1 mb-5 pb-1">
                     <button class="btn btn-outline-light btn-lg px-5" type="submit">Log In</button>
                        <a class="text-muted" href="#!">Forgot password?</a>
                      </div>
    
                      <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">Don't have an account?</p>
                        <button type="button" class="btn btn-outline-danger"><a href="index5.php">Create new</a></button>
                      </div>
    
                    </form>
                    <?php
if($login==true && $inslog==true){
echo "<p class='match'>You have logged in successfully</p>";
if($de==false ){
  echo "<p class='match'>You have exceeded the in time</p>";
}
else{
  
  echo "<p class='match'>You have successfully completed your daily entry</p>";
}
}
if($login==false && $inslog==true){
  echo "<p class='match'>Entered details are invalid</p>";
}

?>



                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                  <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4">CUDE Close Your Daily Entry</h4>
                    <p class="small mb-0">
                        Closing daily entry is a crucial part of a hosteler and CUDE makes this process easier and systematic.
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </section>
    </div>

        
    <footer class="bd-footer py-4 py-md-5 mt-5 bg-body-tertiary">
      <div class="container py-4 py-md-5 px-4 px-md-3 text-body-secondary">
        <div class="row">
          <div class="col-lg-3 mb-3">
            <a class="d-inline-flex align-items-center mb-2 text-body-secondary text-decoration-none" href="https://icons.getbootstrap.com/icons/c-square/" aria-label="Bootstrap">
              <svg xmlns="https://icons.getbootstrap.com/icons/c-square/" width="40" height="32" class="d-block me-2" viewBox="0 0 118 94" role="img"><title>CUDE</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
              <span class="fs-5">CUDE</span>
            </a>
            <ul class="list-unstyled small">
              <li class="mb-2">Designed and built by the students for the students <a href="/docs/5.3/about/team/">CUDE team</a> with the help of <a href="https://github.com/twbs/bootstrap/graphs/contributors">our contributors</a>.</li>
              <li class="mb-2"><a href="https://github.com/twbs/bootstrap/blob/main/LICENSE" target="_blank" rel="license noopener">MNNIT ALLHABAD</a>, docs <a href="https://creativecommons.org/licenses/by/3.0/" target="_blank" rel="license noopener">CC CLUB</a>.</li>
              <li class="mb-2"></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2 offset-lg-1 mb-3">
            <h5>Links</h5>
            <ul class="list-unstyled">
              <li class="mb-2"><a href="final.php">Home</a></li>
              <li class="mb-2"><a href="index6.html">Rules</a></li>
              <li class="mb-2"><a href="/docs/5.3/examples/"></a></li>
              <li class="mb-2"><a href="https://icons.getbootstrap.com/"></a></li>
              <li class="mb-2"><a href="https://themes.getbootstrap.com/"></a></li>
              <li class="mb-2"><a href="https://blog.getbootstrap.com/"></a></li>
              <li class="mb-2"><a href="https://cottonbureau.com/people/bootstrap"></a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2 mb-3">
            <h5>Guides</h5>
            <ul class="list-unstyled">
              <li class="mb-2"><a href="https://www.facebook.com/groups/ccqueries">CC CLUB</a></li>
              <li class="mb-2"><a href="">RISHANK BARUA</a></li>
              <li class="mb-2"><a href="">YASH A.KABRA</a></li>
              <li class="mb-2"><a href="">ADITYA SHRIVASTAVA</a></li>
              <li class="mb-2"><a href="">VAISHNAVI</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2 mb-3">
            <h5>TECH STACK</h5>
            <ul class="list-unstyled">
              <li class="mb-2"><a href="">HTML</a></li>
              <li class="mb-2"><a href="">PHP</a></li>
              <li class="mb-2"><a href="">BOOTSTRAP</a></li>
              <li class="mb-2"><a href="">CSS</a></li>
              <li class="mb-2"><a href="">MYSQL</a></li>
            </ul>
          </div>
          <!-- <div class="col-6 col-lg-2 mb-3">
            <h5>Community</h5>
            <ul class="list-unstyled">
              <li class="mb-2"><a href="https://github.com/twbs/bootstrap/issues">Issues</a></li>
              <li class="mb-2"><a href="https://github.com/twbs/bootstrap/discussions">Discussions</a></li>
              <li class="mb-2"><a href="https://github.com/sponsors/twbs">Corporate sponsors</a></li>
              <li class="mb-2"><a href="https://opencollective.com/bootstrap">Open Collective</a></li>
              <li class="mb-2"><a href="https://stackoverflow.com/questions/tagged/bootstrap-5">Stack Overflow</a></li>
            </ul>
          </div> -->
        </div>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
  </body>
</html>
