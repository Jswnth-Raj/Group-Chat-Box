 <?php
  if(isset($_POST['submit']))
  {
    session_start();

    $u=$_POST['username'];
    $_SESSION['username']=$u;
    $_SESSION['logged']="TRUE";
     header('Location:home.php');
	}
	else
	{
		header('Location:index.php');
	}
  ?>