<?php
session_start();
if(!isset($_SESSION['student_id']))
{
    echo '<script language="javascript">';
    echo "if(!alert('You Must Be Logged In To Access This Page')) document.location = 'index.php'";
    echo '</script>';
}

require('assets/include/connect.php');


?>
<!doctype html>
<html lang="en" class="loading loading-primary">

<head>
    <meta charset="utf-8">
    <title>Dashbard</title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
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
<body id="forms-date-picker" data-layout="fixed-navbar-1" data-sidebar="primary" data-navbar="primary" data-controller="forms" data-view="date-picker">
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
                    <h1 class="display-3">Dashboard</h1>
                    <ol class="breadcrumb icon-home icon-angle-right no-bg">
                        <li>
                            <a href="dashboard.php">
                                Dashboard
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- jumbotron -->

        <div class="col-xs-12 main">
            <div class="page-on-top">
                <!-- forms/date-picker -->
                <div class="row">
                    <div class="col-xs-12 col-xl-12" style="height: 500px;">

                            <div id="barchart" style="height: 300px; width: 400px; overflow: auto; float: left; margin-top: 100px">
        <?php
            if(file_exists("dash1.html") && filesize("dash1.html") > 0){
                $handle = fopen("dash1.html", "r");
                $contents = fread($handle, filesize("dash1.html"));
                fclose($handle);

                echo $contents;
            }
            ?>
    </div>
    <div id="marksheet" style="height: 300px; width: 620px; margin-right: 10px; overflow: auto; float: right; margin-top: 100px">
        <?php
            if(file_exists("dash2.html") && filesize("dash2.html") > 0){
                $handle = fopen("dash2.html", "r");
                $contents = fread($handle, filesize("dash2.html"));
                fclose($handle);

                echo $contents;
            }
            ?>
    </div>

                    </div>

                </div>
                <!-- forms/date-picker -->
            </div>
        </div>
    </div>
</div>
<?php include 'assets/include/scripts.php';?>
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
