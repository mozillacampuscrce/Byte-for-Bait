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


if (isset($_POST['submit']) && !isset($_GET['id'])) {
    $sf_name = $_POST['sf_name'];
    $sl_name = $_POST['sl_name'];
    $pf_name = $_POST['pf_name'];
    $pl_name = $_POST['pl_name'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $student_id = substr($sf_name,0,3).substr($sl_name,0,3).substr($phone,0,5);

    $query = "INSERT INTO `parent` (student_id, password, sf_name, sl_name, pf_name, pl_name, phone, email, address, teacher_id, class, semister) VALUES ('$student_id','$password','$sf_name','$sl_name','$pf_name','$pl_name','$phone','$email','$address','$teacher_id',null,null)";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    echo mysqli_num_rows($result);
    echo $student_id;
    echo $sf_name;
    if($result){
        $smsg = "Student added Successfully.";
        echo '<script language="javascript">';
        echo "if(!alert('Student added Successfully'))document.location = 't_overall_attendance.php'";
        echo '</script>';

    }else{
        $fmsg ="Student addition Failed";
        echo '<script language="javascript">';
        echo "if(!alert('Student Addition Failed.')) document.location = 't_add_class.php'";
        echo '</script>';
    }

}
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $query1="SELECT * FROM event WHERE id=$id";
    $res=mysqli_query($conn,$query1) or die(mysqli_error($conn));
    $data=$res->fetch_assoc();
}

if (isset($_POST['submit'])  && isset($_GET['id'])) {
    $sf_name = $_POST['sf_name'];
    $sl_name = $_POST['sl_name'];
    $pf_name = $_POST['pf_name'];
    $pl_name = $_POST['pl_name'];    
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];


    $query ="UPDATE `parent` set sf_name='$sf_name', sl_name='$sl_name', pf_name='$pf_name',pl_name='$pl_name', phone='$phone', email='$email', address='$address' WHERE student_id='$id'";
    $result = mysqli_query($conn, $query);
    if($result)
    {
        // $smsg = "Record Updated Successfully.";
        echo '<script language="javascript">';
        echo 'if(!alert("Student Updated Successfully")) document.location = "viewevent.php";';
        echo '</script>';

    }else{
        // $fmsg ="Record Updation Failed";
        echo '<script language="javascript">';
        echo 'if(!alert("Student Updation Failed")) document.location = "addevent.php";';
        echo '</script>';


    }
}


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
                                    <form action="#" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                <label class="bmd-label-floating">Student First Name</label>
                                <input type="text" class="form-control" id="sf_name" name="sf_name" value="<?php if(isset($_GET['id'])){echo $data['sf_name']; } else{
                                            echo '';}?>">
                                </div>
                                <div class="form-group">
                                <label class="bmd-label-floating">Student Last Name</label>
                                <input type="text" class="form-control" id="sl_name" name="sl_name" value="<?php if(isset($_GET['id'])){echo $data['sl_name']; } else{
                                            echo '';}?>">
                                </div>
                                <div class="form-group">
                                <label class="bmd-label-floating">Parent First Name</label>
                                <input type="text" class="form-control" id="pf_name" name="pf_name" value="<?php if(isset($_GET['id'])){echo $data['pf_name']; } else{
                                            echo '';}?>">
                                </div>
                                <div class="form-group">
                                <label class="bmd-label-floating">Parent Last Name</label>
                                <input type="text" class="form-control" id="pl_name" name="pl_name" value="<?php if(isset($_GET['id'])){echo $data['pl_name']; } else{
                                            echo '';}?>">
                                </div>
                                <div class="form-group">
                                <label class="bmd-label-floating">Parent Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php if(isset($_GET['id'])){echo $data['phone']; } else{
                                            echo '';}?>">
                                </div>
                                <div class="form-group">
                                <label class="bmd-label-floating">Parent Emailid</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php if(isset($_GET['id'])){echo $data['email']; } else{
                                            echo '';}?>">
                                </div>
                                <div class="form-group">
                                <label class="bmd-label-floating">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php if(isset($_GET['id'])){echo $data['address']; } else{
                                            echo '';}?>">
                                </div>
                                <div class="form-group">
                                <label class="bmd-label-floating">Password</label>
                                <input type="text" class="form-control" id="password" name="password" value="<?php if(isset($_GET['id'])){echo $data['password']; } else{
                                            echo '';}?>">
                                </div>

                                <button type="submit" class="btn btn-block btn-lg btn-success waves-effect waves-light m-r-10" name="submit">Submit</button>
                            </form>
                                    
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
