<html>
<body>

<?php

require_once 'functions/header.php';
//require("erp_connect.php");
echo "<center>";
echo "<form action='enter_data.php' method='POST'>";
echo "Select semester ";
echo "<select style='width:100px;' name='sem'>";
$q1=mysql_query("select distinct sem from Course order by sem");

while($row=mysql_fetch_assoc($q1))
{


$sem=$row['sem'];
echo "<option>$sem</option>";


//echo "<option> 3</option>";

//echo "<option> 5</option>";

//echo "<option> 7</option>";
}
echo "</select>";
echo " ";

echo "Select department ";

$q=mysql_query("select distinct dept from Course");

echo "<select style='width:100px;' name='dept'>";
while($row=mysql_fetch_assoc($q))
{
$dept=$row['dept'];
echo "<option>$dept</option>";
}

echo "</select>";

echo "<input type='submit' value='submit' name='sb' style='width:100px'>";
echo "</form>";
echo "</center>";
require_once 'functions/footer.php';
?>
</body>
</html>

