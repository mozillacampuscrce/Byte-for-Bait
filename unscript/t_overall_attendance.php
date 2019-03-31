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


$query_subjects="SELECT sub_name,sub_id FROM `subject`";
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
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script type="text/javascript">
        var accessToken = "5c87b075d7b64cc4b88ee0a64183bf21";
        var baseUrl = "https://api.api.ai/v1/";
        $(document).ready(function() {
            $("#input").keypress(function(event) {
                if (event.which == 13) {
                    $('.chat-message').append('<span class="userInput"><img src="/chatwindow/me.png" alt="" width="32" height="32">&emsp;' + 'Me :'+ $('input').val() + '</span><br><br>')
                    event.preventDefault();
                    let query  = $('input').val()
                    $('input').val('')
                    send(query);
                }
            });
        });
    
        function send(query) {
            var text = query;
            $.ajax({
                type: "POST",
                url: baseUrl + "query?v=20180101",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + accessToken
                },
                data: JSON.stringify({ query: text, lang: "en", sessionId: "somerandomthing" }),
                success: function(data) {
                    setResponse(data);
                }
            });
        }
        function setResponse(val) {
            $(".chat-message").append('<span class="responseData"><img src="/chatwindow/you.png" alt="" width="32" height="32">&emsp;'+ 'JP :' + val.result.fulfillment.speech + '</span><br><br>');
        }
    </script> -->
<!--     <style type="text/css">
        .userInput{float: left;}
        .responseData{float:right};
        #input { width: 500px; }
    </style> -->
    <!-- <link href="chatbot.css" rel="stylesheet" > -->


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
                    <h1 class="display-3">Overall Attendance</h1>
                    <ol class="breadcrumb icon-home icon-angle-right no-bg">
                        <li>
                            <a href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="active">
                            Overall Attendance</li>
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
                                        <th data-breakpoints="xs sm md lg">Actions</th>
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

<!-- <div id="live-chat">
        <header class="clearfix">
            <a href="#" class="chat-close">x</a>
            <h4>YourBot</h4>
        </header>
        <div class="chat">
            <div class="chat-history">
                <div class="chat-message clearfix">
                </div>
                <hr>
            </div>
            <form action="#" method="post">
                <fieldset>
                    <input id='input' type="text" placeholder="Type your message…" >
                    <input type="hidden">
                </fieldset>
            </form>
        </div>
    </div> -->

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
