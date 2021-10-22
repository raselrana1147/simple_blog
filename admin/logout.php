 <?php 
 		session_start();

        if (isset($_GET['action']) AND $_GET['action']=='logout') {

            session_destroy();
           header("location:login.php");
        }

 ?>