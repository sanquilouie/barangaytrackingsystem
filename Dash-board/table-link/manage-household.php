
<?php
  session_start();
    include_once('../Private/conn/db-connection.php');
    include_once('../Private/class/brgy-information-system.php');

if(!isset($_SESSION['logged_in']))
    {
       header("location:../index.php");
    }else{
    //display some thing here
    $user_session = trim($_SESSION['user_no']);
    $brgy = new Brgy_status();
    $tblhouseholds = $brgy->fetch_Households(); 
    $recordby = $brgy->fetch_recordby($user_session); 
    foreach($recordby as $rby);
    $f_name =  htmlentities($rby['fullname']);
?>

<?php include '../header/main-header.php';?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Household</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../main-dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Household</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="card">
       <div class="card-header">
            <h3 class="card-title" style="float: right;"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-household"> Add Household</button>
             <?php include 'modal/add_household.php';?>
        </div>
        <div class="table-responsive">
        <div class="card-body">
             <table class="table table-colored table-centered table-inverse m-0" id="brgy-officials" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <!--<th>ID</th> -->
                        <th>Household #</th>
                        <th>Zone</th>
                        <th>Total # of Members</th>
                        <th>Head of Family</th>
                        <th>Action</th>

                    </tr>
                </thead>
            <tbody>
                 <?php
                     foreach($tblhouseholds as $house){ ?>
                    <tr>
                        <td><?= ucfirst(htmlentities($house['householdno'])); ?></td>
                        <td><?= ucfirst(htmlentities($house['zone'])); ?></td>
                        <td><?= ucfirst(htmlentities($house['totalhousemembers'])); ?></td>
                        <td><?= ucfirst(htmlentities($house['headoffamily'])); ?></td>

                        <td>
                         <div class="d-flex"><div class="flex-1"> <button class="btn btn-info btn-sm h_hold" data-hhod="<?= htmlentities($house['id']); ?>">Edit</button></div> | <div class="flex-1"> <button class="btn btn-danger btn-sm delete" data-ids="<?= htmlentities($house['id']); ?>">Delete</button></div></div>
                         </td>
                     </tr>
                    <?php } 
                     ?>
                      <?php include 'modal/edit-household.php'; ?>
                      <?php include 'modal/delete-household.php'; ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>
</div>
</div>
</section>
</div>
    <script>
           $(document).ready(function() {   
               load_data();    
               var count = 1; 
               function load_data() {
                   $(document).on('click', '.h_hold', function() {
                     $('#edit-household').modal('show');
                        var id = $(this).data("hhod");
                       // console.log(logid);
                        getIDh(id); //argument    
                 
                   });
                }

                 function getIDh(id) {
                      $.ajax({
                          type: 'POST',
                          url: 'row_pro/logs_row4.php',
                          data: {
                              id: id
                          },
                          dataType: 'json',
                          success: function(responses) {
                          $('#edit_id').val(responses.id);
                          $('#edit_householdno').val(responses.householdno);
                          $('#edit_zone').val(responses.zone);
                          $('#edit_totalhousemembers').val(responses.totalhousemembers);
                          $('#edit_headoffamily').val(responses.headoffamily);

                       }
                    });
                 }
           
           });
            
     </script>

          <script>
           $(document).ready(function() {   
               load_data();    
               var count = 1; 
               function load_data() {
                   $(document).on('click', '.delete', function() {
                     $('#delete-household').modal('show');
                        let id = $(this).data("ids");
                       // console.log(logid);
                        getIDs_del(id); //argument    
                 
                   });
                }

                 function getIDs_del(id) {
                      $.ajax({
                          type: 'POST',
                          url: 'row_pro/logs_row4.php',
                          data: {
                              id: id
                          },
                          dataType: 'json',
                          success: function(responses2) {
                          $('#delete_id').val(responses2.id);
                          $('#delete_householdno').html(responses2.householdno);

                       }
                    });
                 }
           
           });
            
    </script>
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="#">Created By : Junil Toledo</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../dist/js/demo.js"></script>
 <?php } ?>
</body>

</html>