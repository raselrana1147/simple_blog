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

           if (isset($_GET["c_id"]) AND $_GET['c_id'] !=NULL) {
                        $c_id=base64_decode($_GET["c_id"]);
                        $c_id=preg_replace('/[^a-zA-Z0-9]/','',$c_id);     
                    }else{
                      echo "<script>window.location='category.php'</script>";
                    }
                   
         ?>

         <?php 

          if ($_SERVER['REQUEST_METHOD']=="POST") {
            $c_name=htmlspecialchars(trim(stripcslashes($_POST['c_name'])));

            if (empty($c_name)) {
                  echo "<script>error_meesage('Category name is required')</script>";
               }else{
                    $sql="UPDATE categories set c_name='$c_name' where id='$c_id'";
                 $query=mysqli_query($connection,$sql);
                 if ($query !=false) {
                      echo "<script>success_meesage('Successfully updated')</script>";
                      //header('location:category.php');
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
          <div class="col-6 offset-2">

            <div class="card">

              <div class="card-header">
                <h3 class="card-title">Update Category 
          <?php 

          $sql="SELECT * FROM categories WHERE id='".$c_id."'";
             
          $query=mysqli_query($connection,$sql);
       
          if ($query) {
            $data=mysqli_fetch_assoc($query);
            
          }else{
            echo mysqli_error($connection);
          }
        
 ?>   
                  <!-- <a href="" class="btn btn-info btn-sm" ></a> -->
                  
               <a href="category.php" style="margin-left: 450px"  class="btn btn-primary btn-sm">Back</a>
                </h3>
               
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                  <form action="" method="post">
                    
                    <div class="form-group">
                      <input type="text" name="c_name" value="<?=$data['c_name'] ?>" 
                      class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-success" value="Save Changes">
                    </div>
                  </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
            <!-- /.card -->
          </div>
      
        </div>
       
      </div><!-- /.container-fluid -->
    </section>




    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?=  include('footer.php') ?>