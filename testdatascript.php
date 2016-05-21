<?php
//require("erp_connect.php");

require_once "functions/header.php";
echo "jo";
$dept=$_POST['dept'];

if($_POST['sem']=='VII')
{
$q=mysql_query("select rollno from Student where sem='VII' and dept='$dept'");
 while($row=mysql_fetch_assoc($q))
 {
$roll=$row['rollno'];
/*$w=mysql_query("select course_id,sem from Course where sem in('iii','iv','v','vi')");
  while($row1=mysql_fetch_assoc($w))
  {
$sem=$row1['sem'];
$course=$row1['course_id'];
if($sem=='iii')
{
$i=mysql_query("insert into Test values('$roll','$course','2013')");
}
else if($sem=='iv')
{
$i=mysql_query("insert into Test values('$roll','$course','2014')");
}

else if($sem=='v')
{
$i=mysql_query("insert into Test values('$roll','$course','2014')");
}

else
{
$i=mysql_query("insert into Test values('$roll','$course','2015')");
}

}
*/

$w=mysql_query("select course_id from Course where sem ='iii' and dept='$dept'");
  while($row1=mysql_fetch_assoc($w))
{
$course=$row1['course_id'];
$i=mysql_query("insert into Test values('$roll','$course','Second Half 2013','','')");
}  

$w1=mysql_query("select course_id from Course where sem ='iv' and dept='$dept'");
  while($row1=mysql_fetch_assoc($w1))
{
$course=$row1['course_id'];
$i=mysql_query("insert into Test values('$roll','$course','First Half 2014','','')");
}  

$w2=mysql_query("select course_id from Course where sem ='v' and dept='$dept'");
  while($row1=mysql_fetch_assoc($w2))
{
$course=$row1['course_id'];
$i=mysql_query("insert into Test values('$roll','$course','Second Half 2014','','')");
}  

$w3=mysql_query("select course_id from Course where sem ='vi' and dept='$dept'");
  while($row1=mysql_fetch_assoc($w3))
{
$course=$row1['course_id'];
$i=mysql_query("insert into Test values('$roll','$course','First Half 2015','','')");
}  
 }
}

if($_POST['sem']=='V')
{
$q=mysql_query("select rollno from Student where sem='V' and dept='$dept'");
 while($row=mysql_fetch_assoc($q))
 {
$roll=$row['rollno'];

$w=mysql_query("select course_id from Course where sem ='iii' and dept='$dept'");
  while($row1=mysql_fetch_assoc($w))
{
$course=$row1['course_id'];
$i=mysql_query("insert into Test values('$roll','$course','Second Half 2014','','')");
}  

$w1=mysql_query("select course_id from Course where sem ='iv' and dept='$dept'");
  while($row1=mysql_fetch_assoc($w1))
{
$course=$row1['course_id'];
$i=mysql_query("insert into Test values('$roll','$course','First Half 2015','','')");
}  
 }
}

?>
