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


//End

?>

<!DOCTYPE>
<html lang="en" class="loading loading-primary">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title>Chat with CLass Teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include 'assets/include/css.php';?>

    <!-- endbuild -->

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">
        setInterval (loadLog, 1500);
        function data1(){
            var clientmsg = $("#usermsg").val();
            document.getElementById("usermsg").value = "";
            $.post("post.php", {text: clientmsg});              
            loadLog();
            return false;
        }

        function loadLog(){     
        var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
        $.ajax({
            url: "log.html",
            cache: false,
            success: function(html){        
                $("#chatbox").html(html); //Insert chat log into the #chatbox div   
                
                //Auto-scroll           
                var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
                if(newscrollHeight > oldscrollHeight){
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                }               
            },
        });
    }
</script>

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
                        <h1 class="display-3">Chat with class teacher</h1>
                        <ol class="breadcrumb icon-home icon-angle-right no-bg">
                            <li>
                                <a href="#">
                                    Dashboard
                                </a>
                            </li>
                            <li class="active">
                            Chat with class teacher</li>
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
<!--                                         <div class="btn-group pull-left">
                                            <h3><?php echo $data_parent['sf_name'];?>&nbsp;<?php echo $data_parent['sl_name'];?></h3>
                                        </div>
                                    -->
                                    <div id="wrapper">
                                        <p class="welcome">Welcome, <b><?php echo $_SESSION['student_id']; ?></b></p><br>
                                        <div id="chatbox" ><?php
                                        if(file_exists("log.html") && filesize("log.html") > 0){
                                            $handle = fopen("log.html", "r");
                                            $contents = fread($handle, filesize("log.html"));
                                            fclose($handle);

                                            echo $contents;
                                        }
                                        ?></div>

                                            <input name="usermsg" type="text" id="usermsg" size="63" />
                                            <input name="submitmsg" type="button"  id="submitmsg" value="Send" onclick="data1()" />
                
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


<!-- endbuild -->
<div class="left-sidebar-backdrop"></div>
<div class="right-sidebar-backdrop"></div>
<div class="top-search-backdrop"></div>
</body>

</html>
