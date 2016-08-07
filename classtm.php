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
*   Created On: 22 Jun, 2015, 12:13:45 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/subheader.php';
    if($_POST){             
        if(isset($_POST['year'])&& isset($_POST['sem'])&& isset($_POST['dept'])) {
            $year=$_POST['year'];
            $sem=$_POST['sem'];
            $dept=$_POST['dept'];
            $user=$_POST['user'];
        
        echo '<center>';    
        $result=  queryMysql("select count(course_id) as c from Course where sem='".$sem."' and dept='".$dept."'");
        while ($row=  mysql_fetch_array($result)){$ccount=  intval($row['c']);}
        $columns=$ccount*3+3;
        $query="select t1.rollno,t1.name,t1.course_id,t1.abbrv,t2.year,t2.t1,t2.t2 from 
                (select rollno,name,course_id,abbrv from Student s, 
                    (select course_id,abbrv from Course where dept='".$dept."' and sem='".$sem."') as c where s.dept='".$dept."' and s.sem='".$sem."' and s.year='".$year."' and s.rollno in
                        (select rollno from Test where year='".$year."' and course_id in
                            (select course_id from Course where dept='".$dept."' and sem='".$sem."'))) as t1 left join (select * from Test where year='".$year."') as t2 on t1.course_id=t2.course_id and t1.rollno=t2.rollno order by rollno,course_id";
 //       echo '<br>'.$query;
        $result=  queryMysql($query);
        if(mysql_num_rows($result)==0)
        {
            echo '<br><span class="error">No Records Found</span><br><br>';
            die();
        }
        else {
echo <<<_END
        
        <form method="post" id="form1">
          <table id="pdfTable" cellspacing="0" cellpadding="2" border="1" bgcolor="white">
            <tr>
                <td colspan="2" align="center"><img src="images/college_logo.jpg" ></td>
_END;
        echo '<td colspan="'.($columns-2).'" align="center"><h3 align="center">'.$colname.'</h3></td>';
        echo  '</tr>';
        echo '<th colspan="'.$columns.'" align="center">Test Marks</th>';
        echo '<tr><td colspan="'.$columns.'" align="center"><pre><b>Department:</b>'.$dept.'    <b>Year:</b>'.$year.'    <b>Sem:</b>'.$sem.'    <b>Date:</b>'.date('d-m-Y').' </pre></td></tr>';            
echo <<<_END
            <tr>
                <th align="center" rowspan="2"><b>Sr No.</b></th>
                <th align="center" rowspan="2"><b>Rollno</b></th>
                <th align="center" rowspan="2"><b>Name</b></th>
_END;

        $res=  queryMysql("select abbrv from Course where dept='".$dept."' and sem='".$sem."'");
        while ($row = mysql_fetch_array($res)) {
            $abbrv=$row['abbrv'];
            echo '<th align="center" colspan="3">'.$abbrv.'</th>';
        }
        echo '</tr>';
        echo '<tr>';
        $i=1;
        while ($i<=$ccount) {
            echo '<th align="center">T-1</th>';
            echo '<th align="center">T-2</th>';
            echo '<th align="center">AGG</th>';
            $i++;
        }
        echo '</tr>';
        
_END;
        $srCount=1;
        $prevRoll=-1;
        while($row=  mysql_fetch_array($result)){
          if ($prevRoll==-1||$prevRoll!=$row['rollno']) {
            if($prevRoll!=-1)
                    echo '</tr>';
            echo '<tr>';
            echo '<td align="center"> '.$srCount.'</td>';
            echo '<td align="center"> '.$row['rollno'].'</td>';
            echo '<td align="center">'.$row['name'].'</td>';
            $srCount++;
            $prevRoll=$row['rollno'];
          }  
          if($prevRoll==$row['rollno']){
            
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
            $agg= round((intval($row[t1])+intval($row[t2]))/2,0,PHP_ROUND_HALF_UP);
            echo '<td align="center"';
            if($agg<8){
            echo ' style="background-color:red;" ';
            }
            echo '>'.$agg.'</td>';
            $prevRoll=$row['rollno'];
            
          }
        }
           
        }
        echo '<tr><td colspan=3>Subject Incharge Sign:</td>';
        $i=1;
        while ($i<=$ccount) {
            echo '<td align="center" colspan="3"></td>';
            $i++;
        }
        echo '</tr>';
        echo '<tr>';
        echo '<td align="left" colspan="6"><br><br>(Name and Sign)<br>Class Co-ordinator</td>';
        $query="select f.name from Faculty f,Department d where f.fac_id=d.hod";
        $result=mysql_query($query);
        $row=  mysql_fetch_array($result);
        echo '<td align="right" colspan="'.($columns-6).'"><br><br>(Prof. '.$row['name'].')<br>HOD</td>';
        echo '</tr>';
                   
        date_default_timezone_set("Asia/Kolkata");
        echo '<tr><td colspan='.$columns.' align="center"><pre>';
        echo 'Report Generated on: '.date("d/m/Y").' at  '.date("h:i:sa").'  by- '.$appname.'-Account-'.$user.'</td></tr>';

        echo '</table>';
        echo '<input type="button" width="100%" class="button" name="generatepdf" id="generatepdf" value="Generate PDF"/>';
        echo '<input type="hidden" id="filename" name="filename" value="Test-Marks-'.$dept.'-'.$sem.'-'.$year.'"/>';
        echo '<input type="hidden" id="page" name="page" value=""/>';
        echo '<input type="hidden" id="orientation" name="orientation" value="L"/>';
        echo '<input type="hidden" id="style" name="style" value="0"/>';
        echo '</form>';
        echo '</center>';
 
    }
   }
   else 
     echo '<span class="error">Data not posted</span>';
?>