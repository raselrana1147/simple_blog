<?php
         

   if ($_SERVER['REQUEST_METHOD']=="POST") {
         $c_name=htmlspecialchars(trim(stripcslashes($_POST['c_name'])));
         $c_id=htmlspecialchars(trim(stripcslashes($_POST['c_id'])));

         if (empty($c_name)) {
           echo "<script>error_meesage('Category name is required')</script>";
         }else{
            $update="UPDATE categories set c_name='$c_name' where id='$c_id'";
            $query_update=mysqli_query($connection,$update);
            
           if ($query_update) {
             echo "<script>success_meesage('Successfully update')</script>";
           }else{
              echo mysqli_error($connection);
           }
            
                    
         } 
    }

 ?>