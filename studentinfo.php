<?php 
/*                                             License
*   The following license governs the use of Eacadems in academic and educational environments. Commercial use requires a commercial license from Muhammed Salman Shamsi.
*   ACADEMIC PUBLIC LICENSE
*   Copyright (C) 2014 - 2015  Muhammed Salman Shamsi.
*   FOR DETAILED TERMS AND CONDITION SEE LICENSE.TXT FILE
*   NO WARRANTY
*   BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.
*   IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED ON IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.
*   END OF TERMS AND CONDITIONS
*   [license text: http://www.omnetpp.org/intro/license]   
*   Author: Muhammed Salman Shamsi
*/


include('../mpdf/mpdf.php');

require_once 'functions/header.php';     
        
if($_POST){

if( isset($_POST['fsidept'])&& isset($_POST['fsisem']) && isset($_POST['fsihalf'])&& isset($_POST['fsiyear'])){
$fsidept=$_POST['fsidept'];
$fsisem=$_POST['fsisem'];
$fsihalf=$_POST['fsihalf'];
$fsiyear=$_POST['fsiyear'];
$fsiyear="".$fsihalf." ".$fsiyear;
$fsirollno=$_POST['fsirollno'];
$fsiname=$_POST['fsisname']; 
$fsiaddress=$_POST['fsiaddress'];
$fsidoa=$_POST['fsidoa'];
$fsidob=$_POST['fsidob'];
$fsiphoneno=$_POST['fsiphoneno'];
$fsiemail=$_POST['fsiemail'];
$fsipphoneno=$_POST['fsipphoneno'];
$query="select ";
$srCount=1;

if(isset($_POST['fsirollno']))
    $query=$query."rollno,";
if(isset($_POST['fsiname']))
    $query=$query."name,";
if(isset($_POST['fsiaddress']))
    $query=$query."address,";
if(isset($_POST['fsidoa']))
    $query=$query."doa,";
if(isset($_POST['fsidob']))
    $query=$query."dob,";
if(isset($_POST['fsiphoneno']))
    $query=$query."phoneno,";
    if(isset($_POST['fsiemail']))
    $query=$query."email,";
if(isset($_POST['fsipphoneno']))
    $query=$query."pphoneno,";

$query.="0";

$query=$query." from Student where dept='".$fsidept."' AND sem='".$fsisem."' AND year='".$fsiyear."'";
//echo '<br>'.$query;
$result= mysql_query($query);

if(!$result)    
 {
    echo 'Unable to Execute the Query:'.$sql_query.
        "\nRecieved following error".  mysql_error();
    die();
 }
 ob_start();
 echo '<div style="overflow-x:scroll;">'; 
 echo '<center>';
 echo '<form id="form1" method="post">';
 echo '<table id="pdfTable" class="stud-info-table mobile-table" width="100%" cellspacing="0" cellpadding="4" border="1" bgcolor="WHITE">';
            echo '<tr rowspan="3"><th colspan="2" ><img src="images/college_logo.jpg" ></th>'.
                      '<th colspan="7" ><h3 >'.$colname.'</h3></th></tr>';
            echo '<tr>';
                 echo '<th colspan="9" ><pre><b>Department: '.$fsidept.'      Semester: '.$fsisem.'      Year: '.$fsiyear.'</b></pre></th>';
           echo '</tr>';
echo <<<_END
           <tr>
_END;
    echo '<th>Sr.No.</th>';
if(isset($_POST['fsirollno']))
    echo '<th>Roll No</th>';
if(isset($_POST['fsiname']))
    echo '<th>Name</th>';
if(isset($_POST['fsiaddress']))
    echo '<th>Address</th>';
if(isset($_POST['fsidoa']))
    echo '<th>DOA</th>';
if(isset($_POST['fsidob']))
    echo '<th>DOB</th>';
if(isset($_POST['fsiphoneno']))
    echo '<th>Phone No.</th>';
if(isset($_POST['fsiemail']))
    echo '<th>Email</th>';
if(isset($_POST['fsipphoneno']))
    echo '<th>Parents No.</th>';

echo '</tr>';

while($row = mysql_fetch_array($result)){
    echo '<tr>';
        echo '<td >'.$srCount.'</td>';
    if(isset($_POST['fsirollno']))
        echo '<td >'.$row["rollno"].'</td>';
    if(isset($_POST['fsiname']))
        echo '<td>'.$row["name"].'</td>';
    if(isset($_POST['fsiaddress']))
        echo '<td>'.$row["address"].'</td>';
    if(isset($_POST['fsidoa']))
        echo '<td>'.$row["doa"].'</td>';
    if(isset($_POST['fsidob']))
        echo '<td>'.$row["dob"].'</td>';
    if(isset($_POST['fsiphoneno']))
        echo '<td>'.$row["phoneno"].'</td>';
    if(isset($_POST['fsiemail']))
        echo '<td>'.$row["email"].'</td>';
    if(isset($_POST['fsipphoneno']))
        echo '<td>'.$row["pphoneno"].'</td>';
    echo '</tr>';
    $srCount++;
    
}
date_default_timezone_set("Asia/Kolkata");
echo '<tr><td colspan=8 ><pre>';
echo 'Report Generated on: '.date("d/m/Y").' at  '.date("h:i:sa").'  by- '.$appname.'-Account-'.$user.'</td></tr>';
echo '</table>';
    echo '<input type="button" width="100%" class="button" name="generatepdf" id="generatepdf" value="Generate PDF"/>';
    echo '<input type="hidden" id="filename" name="filename" value="Student-List-'.$fsidept.'-'.$fsisem.'-'.$fsiyear.'"/>';
    echo '<input type="hidden" id="page" name="page" value=""/>';
    echo '<input type="hidden" id="orientation" name="orientation" value="L"/>';
    echo '<input type="hidden" id="style" name="style" value="0"/>';
echo '</center>';
echo '</div>';

    
}
else {
    echo '<br><br><center><span class="error">Something is not set</span></center>';
}
}
else {
    echo '<br><br><center><span class="error">POST not done</span></center>';
    header('Location:   index.php');
}
require_once 'functions/footer.php';
?>
