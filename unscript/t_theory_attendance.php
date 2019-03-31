<?php
session_start();
require('assets/include/connect.php');
if (!isset($_SESSION['teacher_id']))
{
    echo '<script language="javascript">';
    echo "if(!alert('You must be logged in to access this page !!')) document.location = 'index.php'";
    echo '</script>';
}

$teacher_id = $_SESSION['teacher_id'];


$query_subjects="SELECT sub_name,sub_id FROM `subject` WHERE type = 1";
$res_subjects=mysqli_query($conn,$query_subjects) or die(mysqli_error($conn));
$cnt_subjects = mysqli_num_rows($res_subjects);
$i=0;
$subject = array();
$sub_name = array();
while($data_subjects = $res_subjects -> fetch_assoc()){
    // echo $data_subjects['sub_name'];
    $subject[$i] = $data_subjects['sub_id'];
    $sub_name[$i] = $data_subjects['sub_name'];
    $i++;
}
$in = $i;

$query_parent="SELECT student_id,sf_name,sl_name FROM `parent` WHERE teacher_id='$teacher_id'";
$res_parent=mysqli_query($conn,$query_parent) or die(mysqli_error($conn));
$cnt_parent = mysqli_num_rows($res_parent);
$j=0;
$student = array();
$stuf_name = array();
$stul_name = array();
while($data_parent = $res_parent -> fetch_assoc()){
    // echo $data_parent['sf_name'];
    $student[$j] = $data_parent['student_id'];
    $stuf_name[$j] = $data_parent['sf_name'];
    $stul_name[$j] = $data_parent['sl_name'];
    $j++;
}
$jn = $j;

$data_attendance=array();

//End

?>

<!doctype html>
<html lang="en" class="loading loading-primary">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Attendance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include 'assets/include/css.php';?>

    <!-- endbuild -->
</head>
<body id="tables-datatable" data-layout="fixed-navbar-1" data-sidebar="primary" data-navbar="primary" data-controller="tables" data-view="datatable">
<div id="fakeloader"></div>

<!-- navbar -->
<?php include 'assets/include/i-t-nav.php';?>
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
                    <h1 class="display-3">Theory Attendance</h1>
                    <ol class="breadcrumb icon-home icon-angle-right no-bg">
                        <li>
                            <a href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="active">
                            Theory Attendance</li>
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

                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table" data-filtering="true" data-sorting="true" data-paging="true" data-filtering-delay="0" id="ptable">

                                        <thead>
                                        <tr>
                                            <th data-breakpoints="xs">ID</th>
                                            <th data-breakpoints="xs sm md">Student Name</th>
                                            <?php foreach($sub_name as $sub){?>
                                            <th data-breakpoints="xs sm md"><?php echo $sub?></th>
                                        <?php }?>
                                        <th data-breakpoints="xs sm md lg">Parent Name</th>
                                        <th data-breakpoints="xs sm md lg">Phone</th>
                                        <th data-breakpoints="xs sm md lg">Email</th>
                                        <th data-breakpoints="xs sm md lg">Address</th>
                                        <th data-breakpoints="xs sm md lg">Action</th>
                                            <th data-breakpoints="xs sm md">Overall</th>
                                        </tr>
                                        </thead>
                                        <tbody>



                                        <?php
                                        $i = 1;
                                        $attend = 0;
                                        foreach ($student as $stu){?>
                                            <tr class="tablerow<?php echo $data['id'];?>">
                                            <td><?php echo $i;?></td>
                                            <?php $query_parent="SELECT * FROM `parent` WHERE student_id='$stu'";
                                                $res_parent=mysqli_query($conn,$query_parent) or die(mysqli_error($conn));
                                                $cnt_parent = mysqli_num_rows($res_parent);
                                                $data_parent = $res_parent -> fetch_assoc();
                                                ?>
                                            <td><?php echo $data_parent['sf_name'];?> <?php echo $data_parent['sl_name'];?></td>
                                            
                                            <?php
                                            foreach ($subject as $sub){
                                                $query_attendance="SELECT attendance FROM attendance WHERE student_id='$stu' and sub_id='$sub'";
                                                $res_attendance=mysqli_query($conn,$query_attendance) or die(mysqli_error($conn));
                                                $cnt_attendance = mysqli_num_rows($res_attendance);
                                                $data_attendance = $res_attendance -> fetch_assoc();
                                                // echo $data_attendance['attendance'];
                                                ?>
                                                <td><?php echo $data_attendance['attendance'];?></td>
                                                <?php $attend = $attend + $data_attendance['attendance'];
                                                }?>
                                                <td><?php echo $data_parent['pf_name'];?> <?php echo $data_parent['pl_name'];?></td>
                                            <td><?php echo $data_parent['phone'];?></td>
                                            <td><?php echo $data_parent['email'];?></td>
                                            <td><?php echo $data_parent['address'];?></td>
                                            <td><button type="button" class="btn btn-warning btn-outline btn-rounded">Send Email</button>&ensp;<button type="button" class="btn btn-warning btn-outline btn-rounded">Send SMS</button></td>
                                                <td><?php echo $attend/count($subject)?></td><?php $attend = 0;?>
                                            </tr>
                                        <?php $i++;}?>

                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <h3>Average attendance is <?php //echo $average_attend/($i-1)?>%</h3> -->
                
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
