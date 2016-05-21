<?php
require_once 'functions/header.php';
//require("erp_connect.php");

$title=$_POST['s2'];
$sem=$_POST['sem_value'];
$r=$_POST['1'];
//echo $r;
//echo $sem;

$cid=mysql_query("select course_id from Course where title='$title'");
while($row=mysql_fetch_assoc($cid))
{
$coid=$row['course_id'];
}
//echo $coid;

$extract=mysql_query("select rollno from Student where sem='$sem'");
$t1=0;
$roll=0;
while($row=mysql_fetch_assoc($extract))
{
$t1++;
$roll++;
//$pkt='kt'.'$t1';
//$patt='att'.'$roll';
$roll=$row['rollno'];
//$kt=$_POST['$pkt'];
//$att=$_POST['$patt'];

$test1=$_POST[$t1];
$test2=$_POST[$roll];

//echo $roll.$kt.$att;
echo $test1;
echo $test2;

//$y=mysql_query("select year from Test where course_id='$coid' and rollno='$roll'");
//while($row=mysql_fetch_assoc($y))
//{
//$year=$row['year'];
//echo $year;
//}

//$q=mysql_query("insert into Stud_Kt_Def values('$roll','$coid','$year','$kt','$att')");
$r=mysql_query("update Test set t1='$test1' where rollno='$roll' and course_id='$coid' ");

$r1=mysql_query("update Test set t2='$test2' where rollno='$roll' and course_id='$coid' ");
}
require_once 'functions/footer.php';

//}
?>
