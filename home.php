<?php 
session_start(); 
if(!$_SESSION['logged']){ 
    header("Location: index.html"); 
    exit; 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Chatbox Login</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <style>
body { 
  background-image: url('wall1.jpg');
  background-size:fill;
}
</style>
</head>

<body  onload= "ajax();">

  <nav class=" teal darken-4" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">ChatBox</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#"> Home</a></li>
        <li><a href="logout.php"> Exit</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
         <li><a href="#"> Home</a></li>
        <li><a href="logout.php"> Exit</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  
  <?php
  include 'db.php';
  ?>
  <div class="container" style="" >
     <div id="chat_box" >   
       
   <form method = "post" action="home.php" class="form-horizontal" style="margin-top:50px;">
   
    <div class="input-field">
        <textarea id="message" name="message" class="materialize-textarea"></textarea>
    </div>
    
    
    <div class="input-field ">
      <input id="username" class="black-text" name="username" type="hidden" value="<?php echo $_SESSION['username'];?>" > 
      </div>

    <div>
        <button class="btn waves-effect waves-light  teal darken-4" type="submit" name="submit">Send
    <i class="material-icons right">send</i>
    </button>
    </div>
    <br>
    <br>
    <div id="chat" >
        
        
        </div>
    
  <?php
                    if(isset($_POST['username']) && isset($_POST['message']))
                    {
                        $name =  mysqli_real_escape_string($con,$_POST['username']);
//                        echo $name;
                        $message = $_POST['message'];
//                        echo $message;
                          $secret_key = 'JswnthSv';
                          $secret_iv = 'Jaswanth09Sv'; 
                          $output = false;
                          $encrypt_method = "AES-256-CBC";
                          $key = hash( 'sha256', $secret_key );
                          $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
                          $output = base64_encode( openssl_encrypt( $message, $encrypt_method, $key, 0, $iv ) );
                        $query_1 = "INSERT INTO chat_info (name,msg) VALUES ('$name','$output')";
                        $query_run = mysqli_query($con,$query_1);
                
                        if($query_run)
                        {
                            echo "<audio src = 'sound/134332-facebook-chat-sound.mp3' hidden = 'true' autoplay = 'true' /></audio>";
                        }

                   }
                ?>
                
            </div>
        </div>
    </body>
    <script src="script.js"></script>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script>
    function goBack() {
      window.history.back();
    }
  </script>

  </body>
</html>
