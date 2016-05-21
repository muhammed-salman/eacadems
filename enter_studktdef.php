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

$kt=$_POST[$t1];
$att=$_POST[$roll];

//echo $roll.$kt.$att;
echo $kt;
echo $att;
$y=mysql_query("select year from Takes where course_id='$coid' and rollno='$roll'");
while($row=mysql_fetch_assoc($y))
{
$year=$row['year'];
echo $year;
}

$q=mysql_query("insert into Stud_Kt_Def values('$roll','$coid','$year','$kt','$att')");

}
require_once 'functions/footer.php';

//}
?>
