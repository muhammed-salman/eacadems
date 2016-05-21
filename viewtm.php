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
*   Created On: 21 Jun, 2015, 1:43:49 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
if($loggedin){
    
    if($_POST){
        if(isset($_POST['tyear'])&& isset($_POST['tsub'])&& isset($_POST['title'])) {
        $tyear=$_POST['tyear'];;
        $tsub=$_POST['tsub'];
        $title=$_POST['title'];
        echo '<center>';
        $result=  queryMysql("select name from Faculty f natural join Teaches t where t.year='".$tyear."' and course_id='".$tsub."' and batch=0");
        while ($row1 = mysql_fetch_array($result)) {
            $fac_name=$row1['name'];
        }
        $result=  queryMysql("select dept,sem,abbrv from Course where course_id='".$tsub."'");
        while ($row = mysql_fetch_array($result)) {
            $dept=$row['dept'];
            $sem=$row['sem'];
            $abbrv=$row['abbrv'];
        }
        
        $query="select * from Takes natural join Test natural join (select rollno,name from Student)as s where year='".$tyear."' and course_id='".$tsub."'";
                
        $result= queryMysql($query); 
        if(mysql_num_rows($result)==0)
        {
            echo '<br><span class="error">No Records Found</span>';
        }
        else {
echo <<<_END
            
        <form method="post" id="form1">
          <table id="pdfTable" cellspacing="0" cellpadding="2" border="1" bgcolor="white" style="overflow:wrap; border: 1px solid black;border-collapse:collapse;">
            <tr>
                <td colspan="2" align="center"><img src="images/college_logo.jpg" ></td>
                <td colspan="4" align="center"><h3 align="center">$colname</h3></td>
            </tr>
            <th colspan="6" align="center">Test Marks</th>
        
  
_END;
            echo '<tr><td colspan="6" align="center"><pre><b>Course:</b>'.$title.'('.$abbrv.')    <b>Course ID:</b>'.$tsub.'    <b>Year:</b>'.$tyear.'    <b>Sem:</b>'.$sem.' </pre></td></tr>';            
echo <<<_END
            <tr>
                <th align="center"><b>Sr No.</b></th>
                <th align="center"><b>Rollno</b></th>
                <th align="center"><b>Name</b></th>
                <th align="center"><b>T-1</b></th>
                <th align="center"><b>T-2</b></th>
                <th align="center"><b>AGG</b></th>
            </tr>
_END;
        $srCount=1;
        while($row=  mysql_fetch_array($result))
        {
            echo '<tr>';
            echo '<td align="center"> '.$srCount.'</td>';
            echo '<td align="center"> '.$row['rollno'].'</td>';
            echo '<td align="center">'.$row['name'].'</td>';
            
            echo '<td align="center"';
            if(intval($row[t1])<8){
            echo ' style="background-color:red;" ';
            }
            echo '>'.$row['t1'].'</td>';
            
            echo '<td align="center"';
            if(intval($row[t2])<8){
            echo ' style="background-color:red;" ';
            }
            echo '>'.$row['t2'].'</td>';
            $agg=  intval(round(($row[t1]+$row[t2])/2, 0, PHP_ROUND_HALF_UP));
            echo '<td align="center"';
            if($agg<8){
            echo ' style="background-color:red;" ';
            }
            echo '>'.$agg.'</td>';
            
            echo '</tr>';
            $srCount++;
        }
        echo '<tr><td colspan=6>Subject Incharge ( '.$fac_name.' ):</td></tr>';
        date_default_timezone_set("Asia/Kolkata");
        echo '<tr><td colspan=6 align="center"><pre>';
        echo 'Report Generated on: '.date("d/m/Y").' at  '.date("h:i:sa").'  by- '.$appname.'-Account-'.$user.'</td></tr>';

        echo '</table>';
        echo '<input type="button" width="100%" class="button" name="generatepdf" id="generatepdf" value="Generate PDF"/>';
        echo '<input type="hidden" name="tmyear" value="'.$tyear.'"/>';
        echo '<input type="hidden" name="tmsub" value="'.$tsub.'"/>';
        echo '<input type="hidden" name="tyear" value="'.$tyear.'"/>';
        echo '<input type="hidden" name="tsub" value="'.$tsub.'"/>';
        echo '<input type="hidden" name="title" value="'.$title.'"/>';
        echo '<input type="hidden" id="filename" name="filename" value="Test-Marks-'.$dept.'-'.$sem.'-'.$tyear.'"/>';
        echo '<input type="hidden" id="page" name="page" value=""/>';
        echo '<input type="hidden" id="orientation" name="orientation" value="P"/>';
        echo '<input type="hidden" id="style" name="style" value="2"/>';
        echo '</form>';
        echo '</center>';
 
    }
   }
 }
 else {
     echo '<center><span class="error">Data not posted</span></center>';
     header('Refresh:0 ,url=index.php');
     
 }
}
 else echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';
require_once 'functions/footer.php';
?>