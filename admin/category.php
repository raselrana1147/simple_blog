<?= require_once('header.php') ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


 <?php 

           if (isset($_GET["delete"]) AND $_GET['delete'] !=NULL) {
                        $delete_id=base64_decode($_GET["delete"]);
                        $delete_id=preg_replace('/[^a-zA-Z0-9]/','',$delete_id); 
                     
                            $sql="DELETE  FROM categories where id='$delete_id'";
                             $query=mysqli_query($connection,$sql);
                             if ($query !=false) {
                                  echo "<script>success_meesage('Successfully deleted')</script>";
                                  //header('location:category.php');
                             }else{
                                 echo mysqli_error($connection);
                              }     
                    }
                   
         ?>


  <?php 

   if ($_SERVER['REQUEST_METHOD']=="POST" AND isset($_POST["update_form"])) {
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
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-10 offset-1">

            <div class="card">

              <div class="card-header">
                <h3 class="card-title">Category Lists
                  <!-- <a href="" class="btn btn-info btn-sm" ></a> -->
                  
<button style="margin-left: 450px" type="button"
 class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
       Add New
</button>
                </h3>
               
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="data_table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Action</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php 

                        $sql="SELECT * FROM categories ORDER BY id DESC";
                        $query=mysqli_query($connection,$sql);
                        $i=0;
                        while ($data=mysqli_fetch_assoc($query)) {
                        $i++;
                     ?>
                  <tr>
                    <td><?=$i ?></td>
                    <td><?=$data['c_name'] ?></td>
                    <td>
                     <a href="edit_category.php?c_id=<?=base64_encode($data['id']) ?>" 
                      class="btn btn-success btn-sm">Edit</a>
                       
                      <a href="?delete=<?=base64_encode($data['id']) ?>" class="btn btn-danger btn-sm delete_item">Delete</a>
                    </td>
                  </tr>

   <!--  edit modal -->
                <?php } ?>
                 
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
            <!-- /.card -->
          </div>
      
        </div>
       
      </div><!-- /.container-fluid -->
    </section>


    <!-- Button trigger modal -->
<?php 

   if ($_SERVER['REQUEST_METHOD']=="POST") {
         $c_name=htmlspecialchars(trim(stripcslashes($_POST['c_name'])));

         if (empty($c_name)) {
           echo "<script>error_meesage('Category name is required')</script>";
         }else{
            $check="SELECT * FROM categories where c_name='$c_name'";
            $query_check=mysqli_query($connection,$check);
            $row=mysqli_num_rows($query_check);
            if ($row==1) {
               echo "<script>error_meesage('Category name already taken')</script>";
            }else{
                $insert="INSERT INTO categories(c_name) VALUES ('$c_name')";
                $insert_query=mysqli_query($connection,$insert);
                if ($insert_query) {
                   echo "<script>success_meesage('Successfully added')</script>";
                   // echo "<script>window.location='category.php'</script>";
                }
            }
         } 
    }

 ?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form name form="add_form" action="" method="post">
            
            <div class="form-group">
              
              <input type="text" name="c_name" class="form-control">
              
            </div>
            <button class="btn btn-success" type="submit">Add</button>
          </form>
      </div>
    </div>
  </div>
</div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?=  include('footer.php') ?>