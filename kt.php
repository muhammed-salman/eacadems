<html>
<body>
<?php
require_once 'functions/header.php';
//require("erp_connect.php");
echo "<center>";

echo "<form action='ktndef.php' method='POST'>";
echo "Select semester ";
echo "<select name='s' style='width:100px;'>";
echo "<option>V</option>";
echo "<option>VII</option>";
echo "</select>";
echo  " ";
echo "<input type='submit' name='sub' value='submit' style='width:100px;'>";
echo "</form>";
echo "</center>";
require_once 'functions/footer.php';
?>
</body>
</html>
