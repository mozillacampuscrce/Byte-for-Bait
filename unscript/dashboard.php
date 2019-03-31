<!DOCTYPE>
<!DOCTYPE html>
<html>
<head>
	<title>DashBoard</title>

	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  

</head>
<body>
	<div id="barchart" style="height: 300px; width: 640px; overflow: auto; float: left;">
		<?php
            if(file_exists("dash1.html") && filesize("dash1.html") > 0){
                $handle = fopen("dash1.html", "r");
                $contents = fread($handle, filesize("dash1.html"));
                fclose($handle);

                echo $contents;
            }
            ?>
	</div>
	<div id="marksheet" style="height: 300px; width: 640px; overflow: auto; float: right;">
		<?php
            if(file_exists("dash2.html") && filesize("dash2.html") > 0){
                $handle = fopen("dash2.html", "r");
                $contents = fread($handle, filesize("dash2.html"));
                fclose($handle);

                echo $contents;
            }
            ?>
	</div>
</body>
</html>
