<?php
session_start();
require('assets/include/connect.php');

    if (isset($_POST['student_id']) and isset($_POST['password']) and isset($_POST['p_submit'])){
        $student_id = $_POST['student_id'];
        $password = md5($_POST['password']);
        // if ($_POST=="p_submit") {
                $tquery = "SELECT * FROM `parent` WHERE student_id='$student_id' and password='$password'";

                $tresult = mysqli_query($conn, $tquery) or die(mysqli_error($conn));
                $trow = $tresult->fetch_array(MYSQLI_NUM);
                $tcount = mysqli_num_rows($tresult);
                $data = $tresult -> fetch_assoc();

                //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
                if ($tcount == 1){
                    $_SESSION['student_id'] = $student_id;

                    echo '<script language="javascript">';
                    echo "if(!alert(' Login Successfull !!')) document.location = 'p_dashboard.php'";
                    echo '</script>';
                }
                else{
                    // If the login credentials doesn't match, he will be shown with an error message.
                    $tfmsg = "Invalid Login Credentials.";
                    //echo $tfmsg;

                    echo '<script language="javascript">';
                    echo "if(!alert('Invalid Login Credentials !!')) document.location = 'index.php'";
                    echo '</script>';
                }
    // }
    // if ($_POST=="t_submit") {
    //     echo "teacher";
    // }

}
if (isset($_POST['student_id']) and isset($_POST['password']) and isset($_POST['t_submit'])){
            $teacher_id = $_POST['student_id'];
        $password = md5($_POST['password']);
        // if ($_POST=="p_submit") {
                $tquery = "SELECT * FROM `teacher` WHERE teacher_id='$teacher_id' and password='$password'";

                $tresult = mysqli_query($conn, $tquery) or die(mysqli_error($conn));
                $trow = $tresult->fetch_array(MYSQLI_NUM);
                $tcount = mysqli_num_rows($tresult);
                $data = $tresult -> fetch_assoc();

                //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
                if ($tcount == 1){
                    $_SESSION['teacher_id'] = $teacher_id;

                    echo '<script language="javascript">';
                    echo "if(!alert(' Teacher Login Successfull !!')) document.location = 't_overall_attendance.php'";
                    echo '</script>';
                }
                else{
                    // If the login credentials doesn't match, he will be shown with an error message.
                    $tfmsg = "Invalid Login Credentials.";
                    //echo $tfmsg;

                    echo '<script language="javascript">';
                    echo "if(!alert('Invalid Teacher Login Credentials !!')) document.location = 'index.php'";
                    echo '</script>';
                }
}
    //end
?>
<!doctype html>
<html lang="en" class="loading loading-primary">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php include 'assets/include/css.php';?>
    <style type="text/css">
        .text-muted, .bmd-help
        {
            color: white !important;
        }
        .bmd-form-group .bmd-label-floating
        {
            color: white !important;
        }
        .form-control, .custom-file-control, .is-focused .form-control, .is-focused .custom-file-control
        {
            background-image: linear-gradient(to top, #0d47a1 2px, rgba(13, 71, 161, 0) 2px), linear-gradient(to top, rgba(245, 245, 245, 0.6) 1px, transparent 1px);
            color: white;
        }

.checkbox label .checkbox-decorator .check, label.checkbox-inline .checkbox-decorator .check
        {
            border: 0.125rem solid rgba(255, 255, 255, 0.8);
        }


        @media only screen and (min-width: 481px) {
        
            .sign-in
            {
                margin-top: 5%;
            }

        }
    </style>
    <!-- endbuild -->
</head>
<body id="pages-sign-in" data-layout="empty-view-1" data-controller="pages" data-view="sign-in">
    <div id="fakeloader"></div>
    <!-- pages/sign-in -->
    <div class="form-container">
        <form class="sign-in" style="background: rgba(0,0,0,0.8); max-width: 550px; color: white;" action="" method="POST">
            <h3 style="color: white;">Sign in</h3>
            <p>
                Please enter your key and password to login
            </p>
            <!--<div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Stop!</strong> I am a alert
            </div>-->
            <div class="form-group">
                <label for="sign-in-2-email" class="bmd-label-floating">Login Key</label>
                <input type="text" id="sign-in-2-email" class="form-control" style="color: white;" name="student_id">    
                <span class="bmd-help">Please enter your Key</span>
            </div>
            <div class="form-group">
                <label for="sign-in-1-password" class="bmd-label-floating">Password</label>
                <input type="password" id="sign-in-1-password" class="form-control" style="color: white;" name="password">
                <span class="bmd-help" style="color: white;">Please enter your password</span>
            </div>
            <!--<div class="checkbox checkbox-light">
                <label style="color: white;">
                <input type="checkbox" value="remember-me">Remember me
            </label>
            </div>-->
            <button class="btn btn-raised btn-lg btn-primary btn-block" type="submit" name="p_submit" values="p_submit">Parent Sign in</button>
            <button class="btn btn-raised btn-lg btn-primary btn-block" type="submit" name="t_submit" values="t_submit">Teacher Sign in</button>
            <!-- <p class="copyright">&copy; Copyright 2017</p> -->
        </form>
    </div>
    <!-- pages/sign-in -->
    <!-- build:js js/vendor.js -->
    <?php include 'assets/include/scripts.php';?>
    <!-- endbuild -->
</body>

</html>
