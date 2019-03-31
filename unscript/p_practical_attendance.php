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

$query_attendance="SELECT * FROM `attendance`,`subject` WHERE ((attendance.student_id = '$student_id' and a_sem = '$semister') and subject.type = 0) and attendance.sub_id = subject.sub_id";
$res_attendance =mysqli_query($conn,$query_attendance) or die(mysqli_error($conn));
$cnt_attendance = mysqli_num_rows($res_attendance);



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
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700">
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
            $("#clearfix").click(function(){
                $("#box").slideDown("slow");
            });
            $("#close").click(function(){
                $("#box").slideUp();
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
    </script>
    <style type="text/css">
        .userInput{float: left;}
        .responseData{float:right};
        #input { width: 500px; }
        #box { display: none; }
    </style>
    <link href="chatbot.css" rel="stylesheet" >
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
                    <h1 class="display-3">Practical Attendance</h1>
                    <ol class="breadcrumb icon-home icon-angle-right no-bg">
                        <li>
                            <a href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="active">
                            Practical Attendance</li>
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
                                    <div class="btn-group pull-left">
                                        <h3><?php echo $data_parent['sf_name'];?>&nbsp;<?php echo $data_parent['sl_name'];?></h3>
                                    </div>
                                    <table class="table" data-filtering="true" data-sorting="true" data-paging="true" data-filtering-delay="0" id="ptable">

                                        <thead>
                                        <tr>
                                            <th data-breakpoints="xs">ID</th>
                                            <th data-breakpoints="xs sm md">Subject Name</th>
                                            <th data-breakpoints="xs sm md">Attendance</th>
                                            <!-- <th data-breakpoints="xs sm md">Semester</th> -->
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $i = 1;
                                        $average_attend = 0;
                                        while($data_attendance = $res_attendance -> fetch_assoc()){
                                               // $sub_id = $data_attendance['sub_id'];
                                               // $query_subject="SELECT * FROM `subject` WHERE sub_id = '$sub_id'";
                                               //  $res_subject=mysqli_query($conn,$query_subject) or die(mysqli_error($conn));
                                               //  $data_subject = $res_subject -> fetch_assoc();
                                                $average_attend = $average_attend + $data_attendance['attendance'];
                                                ?>

                                            <tr class="tablerow<?php echo $data['id'];?>">
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $data_attendance['sub_name'];?></td>
                                                <td><?php echo $data_attendance['attendance'];?>%</td>
                                                <!-- <td><?php //echo $data_attendance['a_sem'];?></td> -->


                                                <?php $i++;?>

                                            </tr>
                                        <?php }?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Average attendance is <?php echo $average_attend/($i-1)?>%</h3>
                
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
<div id="live-chat">
        <header class="clearfix" id="clearfix">
            <h4>YourBot</h4>
        </header>
        <div class="chat" id="box">
            <div class="chat-history">
                <div class="chat-message clearfix">
                </div>
                <hr>
            </div>
            <form action="#" method="post">
                <fieldset>
                    <input id='input' type="text" placeholder="Type your message…">
                    <a href="#" id="close" class="chat-close">x</a>
                    <input type="hidden">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>
