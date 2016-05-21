<html>
<body>

<?php
require_once 'functions/header.php';
//require("erp_connect.php");

echo "<form action='testmarks_table.php' method='POST'>";
echo "<center>";

$ee=$_POST['s'];

if($_POST['s']=='V')

{
echo "<input type='text' value='$ee' hidden='true' name='sem_value'>";

$q1=mysql_query("select title from Course where sem in('iii','iv')");
echo "Select course ";
echo "<select name='s2' style='width:150px;'>";

echo "<option></option>";
while($row=mysql_fetch_assoc($q1))
{
$r=$row['title'];
echo "<option>$r</option>";

}
echo "</select>";

}

if($_POST['s']=='VII')
{
echo "<input type='text' value='$ee' hidden='true' name='sem_value'>";

$q2=mysql_query("select title from Course where sem in('iii','iv','v','vi') ");
echo "Select course ";
echo "<select name='s2' style='width:150px;'>";

while($row=mysql_fetch_assoc($q2))
{
$r=$row['title'];
echo "<option>$r</option>";

}
echo "</select>";
}



echo "</center>";
$q=mysql_query("select rollno,name from Student where sem='$ee'");
 $srno=0;
$t1=0;
$t2=0;
echo "<center>";
echo "<table>";
echo "<th>Srno</th>";
echo "<th>Rollno</th>";
echo "<th>Name</th>";
echo "<th>Test1 Marks</th>";
echo "<th>Test2 Marks</th>";

while($row=mysql_fetch_assoc($q))
{
$srno++;
$t1++;
$t2++;

echo "<tr>";
$roll=$row['rollno'];
$name=$row['name'];


echo "<td>$srno</td>";
echo "<td>$roll</td>";
echo "<td>$name</td>";

echo "<td><input type='text' name='$t1'></td>";
echo "<td><input type='text' name='$roll'></td>";

//echo "<td><input type='text' name='kt'.'$t1'></td>";
//echo "<td><input type='text' name='att'.'$roll'></td>";

echo "</tr>";
}
echo "</table>";


echo "<input type='submit' name='s1' style='width:100px;' value='submit'>";
echo "</form>";
echo "</center>";

$akt=$_POST[$t1];
$attd=$_POS[$roll];
/*
if($_POST['s1'])
{
	if(is_numeric($attd) && $akt!=="" && $attd!==""){
	$q=mysql_query("insert into Stud_Kt_Def values('$roll','$coid','$year','$akt','$attd')");
	}
	else if($attd=="")
	{
	echo "Please enter attendance for ".$roll;
	}
	else if($akt=="")
	{
	echo "Please enter kt for ".$roll;
	}
	else 
	{
	echo "please enter valid value";
	}

}
*/
require_once 'functions/footer.php';
?>

</body>
</html>

