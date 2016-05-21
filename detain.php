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
*   Created On: 4 Jun, 2015, 2:18:41 PM
*   Author: Muhammed Salman Shamsi
*/
include('../mpdf/mpdf.php');

require_once 'functions/header.php';     

if($loggedin){
    

if($_POST){

if( isset($_POST['fpdept'])&& isset($_POST['fpsem'])&& isset($_POST['fpyear'])){
$fpdept=$_POST['fpdept'];
$fpsem=$_POST['fpsem'];
$fpyear=$_POST['fpyear'];
$fpclass=NULL;
$dsyear=  explode(" ", $fpyear);

if($dsyear[0]=="First")
    $dsyear[0]="Second";
else{
    $dsyear[0]="First";
    $dsyear[2]=(int)$dsyear[2]+1;
}

$dsyear=  implode(" ", $dsyear);

$query1="select rollno,name,semno,class from Student natural join ClassSem where dept='".$fpdept."' AND sem='".$fpsem."' AND year='".$fpyear."'";

$result= queryMysql($query1);

if(mysql_num_rows($result)==0)    
 {
    echo '<font color="red">No Records Found</font>';
    die();
 }
 while($row = mysql_fetch_array($result)){
            $dssemno=$row['semno'];
            $fpclass=$row['class'];
           }
 if(($dssemno%2)!=0)
 {
     echo '<font color="red"><br>Student can only be Detain during the transition from EVEN to ODD semester'
     . '<br>You Cannot Proceed Further!</font>';
     die();
  }
           $dssemno=$dssemno-1;
           
$query2="select sem,class from ClassSem where semno='".$dssemno."'";

if(!mysql_query($query2)){
    echo '<font color="red">Failed to retrive record: '.  mysql_error().'</font>';
    die();
}
else {
    $result=  mysql_query($query2);
    while($row=  mysql_fetch_array($result)){
        $dssem=$row['sem'];
        $dsclass=$row['class'];
    }
}
        
 ob_start();
 
 echo '<form method="post" action="detainstudents.php" onsubmit="return confirm(\'Are you sure you wnat to submit?\')">';
 echo '<center>';
 echo '<table cellspacing="0" cellpadding="4" border="1" style="margin:1% 10% 5% 11%;">';
           echo '<tr rowspan="3"><td colspan="1" align="center"><img src="images/college_logo.jpg" ></td>'.
                      '<td colspan="2" align="center"><h3 align="center">'.$colname.'</h3></td></tr>';
           echo '<tr>';
                 echo '<td colspan="3" align="center"><font color="black"><pre><b>Current Status:    Department: '.$fpdept.'      Semester: '.$fpsem.'      Year: '.$fpyear.'    Class: '.$fpclass.'</b></pre></font></td>';                
           echo '</tr>';
           echo '<tr>';
                 echo '<td colspan="3" align="center"><font color="red"><pre><b>Detention Details:    Department: '.$fpdept.'      Semester: '.$dssem.'      Year: '.$dsyear.'     Class: '.$dsclass.'</b></pre></font></td>';
           echo '</tr>';
           echo '<tr>';
           echo '<td align="center">ROLL NO.</td>';
           echo '<td align="center">Name</td>';
           echo '<td align="center">To Detain(Tick)</td>';
           echo '</tr>';
           $result= mysql_query($query1);
           while($row = mysql_fetch_array($result)){
            echo '<tr>';
            echo '<td title="'.$row['name'].'">'.$row['rollno'].'</td>';
            echo '<td title="'.$row['rollno'].'">'.$row['name'].'</td>';
            echo '<td><div class="checksquare1"><input type="checkbox" id="checksquare1_'.$row['rollno'].'" name="rollno[]" value="'.$row['rollno'] 
                    .'"  checked="true"><label for="checksquare1_'.$row['rollno'].'"></label></div></td>';
            echo '</tr>';
           }
echo <<<_END
           <tr>
                <td colspan="3" align="center">
                    <input type="submit" class="button" value="Submit">
                </td>
            </tr>
           </table>
_END;
        
        echo  '<input type="hidden" name="ddept" id="pdept" value="'.$fpdept.'">';
        echo  '<input type="hidden" name="dsem" id="psem" value="'.$fpsem.'">';
        echo  '<input type="hidden" name="dyear" id="pyear" value="'.$fpyear.'">';
        echo  '<input type="hidden" name="dsyear" id="pdyear" value="'.$dsyear.'">';
        echo  '<input type="hidden" name="dssem" id="pdsem" value="'.$dssem.'">';
        echo   '</center>';
        echo   '</form>';

    }
}
 
else {
    echo '<br><span class="error">Data Not Posted</span>';
     header("Refresh: 0; url=index.php");
}
}
else {
     echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';
    
}

require_once 'functions/footer.php';
?>
