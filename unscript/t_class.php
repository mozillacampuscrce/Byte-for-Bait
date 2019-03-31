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


$query_parent = "SELECT * FROM `parent` WHERE teacher_id='$teacher_id'";
$res_parent=mysqli_query($conn,$query_parent) or die(mysqli_error($conn));
$cnt_parent = mysqli_num_rows($res_parent);


//End

?>

<!doctype html>
<html lang="en" class="loading loading-primary">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>My Class</title>
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
                    <h1 class="display-3">My Class</h1>
                    <ol class="breadcrumb icon-home icon-angle-right no-bg">
                        <li>
                            <a href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="active">
                            My Class</li>
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
                                            <th data-breakpoints="xs sm md">Parent Name</th>
                                            <th data-breakpoints="xs sm md">Email id</th>
                                            <th data-breakpoints="xs sm md">Phone</th>
                                            <th data-breakpoints="xs sm md">Address</th>
                                            <th data-breakpoints="xs sm md">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $i = 1;?>
                                            
                                            

                                            <?php while($data_parent = $res_parent -> fetch_assoc()){?>
                                                <tr class="tablerow<?php echo $data['id'];?>">
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $data_parent['sf_name'];?> <?php echo $data_parent['sl_name'];?></td>
                                                <td><?php echo $data_parent['pf_name'];?> <?php echo $data_parent['pl_name'];?></td>
                                                <td><?php echo $data_parent['email'];?></td>
                                                <td><?php echo $data_parent['phone'];?></td>
                                                <td><?php echo $data_parent['address'];?></td>
                                                <!-- <td></td> -->
                                                <td><button type="button" class="btn btn-primary btn-outline btn-rounded" style = "margin-bottom: 5px;">Edit</button>&ensp;<button type="button" class="btn btn-warning btn-outline btn-rounded" style = "margin-bottom: 5px;">Send Email</button>&ensp;<button type="button" class="btn btn-warning btn-outline btn-rounded">Send SMS</button>&ensp;<button type="button" class="btn btn-danger btn-outline btn-rounded">Delete</button></td>
                                        
                                            </tr>
                                        <?php $i++;} ?>

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
