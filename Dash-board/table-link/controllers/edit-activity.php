<?php
   // session_start();
    include_once('../../Private/conn/db-connection.php');
    include_once('../../Private/class/brgy-information-system.php');
      $brgy_stat = new Brgy_status();
        if(ISSET($_POST['id'])){

               $dateofactivity = trim($_POST['dateofactivity']);
               $activity = trim($_POST['activity']);
               $description = trim($_POST['description']);
              

              // ==========audit trail==================
              $user = trim($_POST['user_name']);
              $id = trim($_POST['id']);

              if(!empty($_SERVER["HTTP_CLIENT_IP"])){
                   $ip = $_SERVER["HTTP_CLIENT_IP"];
                }elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){ 
                   $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                }else{
                   $ip = $_SERVER["REMOTE_ADDR"];
               }
               $host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
               date_default_timezone_set("asia/manila");
               $logdate =  date('M-d-Y h:i A', strtotime("+0 HOURS"));
               $action = "Updating Activity";    
            // ==========end audit trail==============


               $brgy_stat->edit_activity($dateofactivity, $activity, $description, $id, $user, $ip, $host,  $logdate, $action);
                  echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Update Activity Successfully!","Message!","success");';
                  echo '}, 1000);</script>';
                  echo '<script type="text/javascript">';
                  echo 'setTimeout(function(){';
                  echo 'window.location = "/Barangay_Information_System/Dash-board/table-link/manage-activity.php"';
                  echo '},2000)';
                  echo '</script>';
             
        }
?>