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

$query = "Select * from marks Inner Join subject on subject.sub_id = marks.sub_id where student_id = '$student_id' ";

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$data_points1 = array();

while($row = mysqli_fetch_array($result))
{        
	$point1 = array("label" => $row['sub_name'] , "y" => $row['mrk']);

	array_push($data_points1 , $point1);        
}

echo json_encode($data_points1 , JSON_NUMERIC_CHECK)	; 
?>
