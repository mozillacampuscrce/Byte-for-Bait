<?php
session_start();
require('assets/include/connect.php');


// $teacher_id = $_SESSION['teacher_id'];
$teacher_id = "Teacher1";


$query_subjects="SELECT sub_name,sub_id FROM `subject`";
$res_subjects=mysqli_query($conn,$query_subjects) or die(mysqli_error($conn));
$cnt_subjects = mysqli_num_rows($res_subjects);
$i=0;
$subject = array();
while($data_subjects = $res_subjects -> fetch_assoc()){
	// echo $data_subjects['sub_name'];
	$subject[$i] = $data_subjects['sub_id'];
	$i++;
}
$in = $i;

$query_parent="SELECT student_id,sf_name,sl_name FROM `parent` WHERE teacher_id='$teacher_id'";
$res_parent=mysqli_query($conn,$query_parent) or die(mysqli_error($conn));
$cnt_parent = mysqli_num_rows($res_parent);
$j=0;
$student = array();
while($data_parent = $res_parent -> fetch_assoc()){
	// echo $data_parent['sf_name'];
	$student[$j] = $data_parent['student_id'];
	$j++;
}
$jn = $j;

		// echo $student[$jn];
		// echo $subject[$in];

// $query_attendance="SELECT attendance FROM attendance WHERE (student_id='test' and sub_id='1')";
// 		$res_attendance=mysqli_query($conn,$query_attendance) or die(mysqli_error($conn));
// 		$cnt_attendance = mysqli_num_rows($res_attendance);
// 		$data_attendance = $res_attendance -> fetch_assoc();
// 		echo $cnt_attendance;
		


$data_attendance=array();
foreach ($student as $stu){
	// echo "Hello";
	foreach ($subject as $sub){
		$query_attendance="SELECT attendance FROM attendance WHERE student_id='$stu' and sub_id='$sub'";
		$res_attendance=mysqli_query($conn,$query_attendance) or die(mysqli_error($conn));
		$cnt_attendance = mysqli_num_rows($res_attendance);
		$data_attendance = $res_attendance -> fetch_assoc();
		// echo $cnt_attendance;
		echo $data_attendance['attendance'];
		// echo $stu;
		// echo $sub;
		// echo "subject";
	}
}
// $query_parent="SELECT attendance FROM `attendance` WHERE teacher_id='$teacher_id' and ";
// $res_parent=mysqli_query($conn,$query_parent) or die(mysqli_error($conn));
// $cnt_parent = mysqli_num_rows($res_parent);
// while($data_parent = $res_parent -> fetch_assoc()){
// 	echo $data_parent['sf_name'];
// }

// while(


//  = $res -> fetch_assoc()){
// 	echo $data['sf_name'];
// 	echo $data['sl_name'];
// 	echo $data['attendance'];
// 	echo $data['sub_name'];
// }

?>


