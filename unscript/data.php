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

$query = "Select * from attendance Inner Join subject on subject.sub_id = attendance.sub_id where student_id = '$student_id' ";

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$data_points = array();

while($row = mysqli_fetch_array($result))
{        
	$point = array("label" => $row['sub_name'] , "y" => $row['attendance']);

	array_push($data_points, $point);        
}

echo json_encode($data_points, JSON_NUMERIC_CHECK); 
?>
