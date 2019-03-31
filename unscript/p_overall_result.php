<?php
session_start();
require('assets/include/connect.php');
if (!isset($_SESSION['student_id']))
{
    echo '<script language="javascript">';
    echo "if(!alert('You must be logged in to access this page !!')) document.location = 'index.php'";
    echo '</script>';
}

$student_id = $_SESSION['student_id'];

$query_parent="SELECT * FROM `parent` WHERE student_id = '$student_id'";
$res_parent=mysqli_query($conn,$query_parent) or die(mysqli_error($conn));
$cnt_parent = mysqli_num_rows($res_parent);
$data_parent = $res_parent -> fetch_assoc();
$semister = $data_parent['semister'];

// $query_subject="SELECT * FROM `subject` WHERE type = 1 ";
// $res_subject=mysqli_query($conn,$query_subject) or die(mysqli_error($conn));
// $cnt_subject = mysqli_num_rows($res_subject);
// $data_subject = $res_subject -> fetch_assoc();
  


$query_marks="SELECT * FROM `marks`,`subject` WHERE (marks.student_id = '$student_id' and m_sem = '$semister') and marks.sub_id = subject.sub_id";
$res_marks =mysqli_query($conn,$query_marks) or die(mysqli_error($conn));
$cnt_marks = mysqli_num_rows($res_marks);



//End

?>

<!doctype html>
<html lang="en" class="loading loading-primary">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Marks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js" ></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#showCheckoutHistory').change(function() {
                if ($(this).prop('checked')) {
                    var a = prompt("You have seen your wards' result. Enter the password:"); 
                    //alert (a);//checked
                    //window.location.href = "eg.php?pass="+a;
                    //$data_parent['password']
                }
        // else {
        //     alert("You have elected to turn off checkout history."); //not checked
        // }
            });
        });

    </script>

 
   <?php include 'assets/include/css.php';?>

    <!-- endbuild -->
</head>
<body id="tables-datatable" data-layout="fixed-navbar-1" data-sidebar="primary" data-navbar="primary" data-controller="tables" data-view="datatable">
<div id="fakeloader"></div>

<!-- navbar -->
<?php include 'assets/include/i-p-nav.php';?>
<!-- navbar -->

<div class="container-fluid">
    <div class="row">
        <!-- left sidebar -->
        <?php include 'assets/include/i-sidebar.php';?>
        <!-- left sidebar -->

        <!-- jumbotron -->
        <div class="jumbotron-3">
            <div class="jumbotron jumbotron-fluid">
                <div class="container-fluid">
                    <h1 class="display-3">Marksheet</h1>
                    <ol class="breadcrumb icon-home icon-angle-right no-bg">
                        <li>
                            <a href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="active">
                            Marksheet</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- jumbotron -->

        <div class="col-xs-12 main">
            <div class="page-on-top">
                <!-- tables/datatable -->

                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget">
                            <div>
                            <img src="shahandanchor.png" height="140" >
                            <img src="finalshahandanchor.png" width="960" >
                        </div>

                        <div >
                            <br>
                            <br>
                            <h3>SCORESHEET - SEMESTER V </h3>

                        </div>

                        <div >
                            <br>
                            <br>
                            <h4>STUDENT DETAILS</h4>
                            <br>
                            <h4><?php echo "Name of student:  "?><?php echo $data_parent['sf_name'];?>&nbsp;<?php echo $data_parent['sl_name'];?></h4>
                            <h4><?php echo "Contact Number:  "?><?php echo $data_parent['phone'];?></h4>
                            <h4><?php echo "Email ID:  "?><?php echo $data_parent['email'];?></h4>
                            <h4><?php echo "Result:  "?></h4>


                        </div>

                            
                                   
                                       

                                    </div>
                                    <table class="table" data-filtering="true" data-sorting="true" data-paging="true" data-filtering-delay="0" id="ptable">

                                        <thead>
                                        <tr>
                                            <th data-breakpoints="xs">ID</th>
                                            <th data-breakpoints="xs sm md">Subject Name</th>
                                            <th data-breakpoints="xs sm md">Marks</th>
                                            <th data-breakpoints="xs sm md">Percentage</th>
                                            <!-- <th data-breakpoints="xs sm md">Semester</th> -->
                                        </tr>
                                        </thead>
                                        <tbody>


                                        <?php
                                        $i = 1;
                                        $average_mrks = 0;
                                        while($data_marks = $res_marks -> fetch_assoc()){
                                               // $sub_id = $data_marks['sub_id'];
                                               // $query_subject="SELECT * FROM `subject` WHERE sub_id = '$sub_id'";
                                               //  $res_subject=mysqli_query($conn,$query_subject) or die(mysqli_error($conn));
                                               //  $data_subject = $res_subject -> fetch_assoc();
                                                // $average_mrks = $average_mrks + $data_marks['marks'];
                                                ?>

                                            <tr class="tablerow<?php echo $data['id'];?>">
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $data_marks['sub_name'];?></td>
                                                <td><?php echo $data_marks['mrk'];?></td>
                                                <td><?php echo $data_marks['mrk'];?>%</td>
                                                <!-- <td><?php //echo $data_marks['a_sem'];?></td> -->


                                                <?php $i++;?>

                                            </tr>
                                        <?php }?>

                                        </tbody>
                                    </table>

                                    <img src="ICONS/Mr.Silva-Signature.png" width="160">
                                    <div class="btn-group pull-right">
                                        <!-- <label class="container">Sign this Report
                                        <input type="checkbox" checked="checked" name="box">
                                        <span class="checkmark"></span>
                                        </label> -->

                                        <div class="btn-group pull-right">
                                            <div class="myAccountCheckboxHolder" id="showCheckoutHistoryCheckbox">
                                                <input tabindex="40" id="showCheckoutHistory" name="showCheckoutHistory" type="checkbox">
                                                    <label for="showCheckoutHistory" class="checkLabel">Sign this report</label>
                                            </div>   


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <h3>Average marks is <?php //echo $average_mrks/($i-1)?>%</h3> -->
                
                <!-- tables/datatable -->
            </div>
        </div>



    </div>
</div>
<!-- build:js js/vendor.js -->
<?php include 'assets/include/scripts.php';?>
<script>
    jQuery(function($){
        $('.table').footable();
    });
</script>

<!-- endbuild -->
<div class="left-sidebar-backdrop"></div>
<div class="right-sidebar-backdrop"></div>
<div class="top-search-backdrop"></div>
</body>

</html>
