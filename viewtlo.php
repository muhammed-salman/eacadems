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
*   Created On: 29 May, 2015, 3:52:00 PM
*   Author: MUhammed Salman Shamsi
*/
require_once 'functions/header.php';

if($loggedin){
    if($_POST){
        if(isset($_POST['tlcourse'])&& isset($_POST['tlyear'])) {
        $tlyear=$_POST['tlyear'];
        $tlcourse=$_POST['tlcourse'];
        $title=$_POST['title'];
        $result=  queryMysql("select name from Faculty where fac_id='".$_POST['ffac_id']."'");
        while($row=  mysql_fetch_array($result)){$fac_name=$row['name'];}
        $result=  queryMysql("select sem,outcomes,dept,name from Course c natural join Department d where c.dept=d.dept_id and course_id='".$tlcourse."'");
        while($row=  mysql_fetch_array($result)){
            $sem=$row['sem'];
            $outcomes=$row['outcomes'];
            $dept_id=$row['dept'];
            $dept_name=$row['name'];
            
        }
        $query="select * from TLO t natural join Syllabus s where t.year='".$tlyear."' and t.course_id='".$tlcourse."'";
        echo '<center>';
       if(!mysql_query($query)){
            echo "<br><span class='error'>Failed to execute query : ".  mysql_error()."</span><br>";
            die();
       }
        
        $result=  mysql_query($query); 
        if(mysql_num_rows($result)==0)
        {
            echo '<br><span class="error">No Records Found</span><br><br>';
            
        }   
        else {
echo <<<_END
          
          <form id="form1" method="post">
          <table id="pdfTable" cellspacing="0" cellpadding="1" border="1" bgcolor="white">
_END;
            echo '<tr><td colspan="1" align="center"><img src="images/college_logo.jpg" ></td><td colspan="6" align="center"><h2>'.$colname.'</h2>'
            . '<hr>'.$coladdress
            .'<hr><h4><u>COURSE OUTCOMES, PLAN AND MONITORING</u></h4>'
            .'<hr><pre>Faculty: Prof. '.$fac_name. '    Course Title: '.$title.'    Course ID:'.$tlcourse.'<br>'
                    . 'Semester: '.$sem.'    Year:'.$tlyear.'    Department: '.$dept_name.'('.$dept_id.')    Plan period: <br> '
                    .'</td></tr>';          
            echo '<tr><td align="left" colspan="7"><br><b>Course Outcomes:</b>';
            $outcomes=  explode(";", $outcomes);
            for ($i = 0; $i < count($outcomes); $i++) {
                echo '<br>'.$outcomes[$i];
            }
            
            echo '<br><br></td></tr>';

echo <<<_END

            <tr>
                <th align="center"><b>Mod No.</b></th>
                <th align="center"><b>Title & Sub Topics</b></th>
                <th align="center"><b>Hours</b></th>
                <th align="center"><b>Topic Learning Outcomes</b></th>
                <th align="center"><b>P . C . D</b></th>
                <th align="center"><b>A . C . D</b></th>
                <th align="center"><b>Remarks</b></th>
            </tr>
_END;
        while($row=  mysql_fetch_array($result)){
            echo '<tr>';
            echo '<td align="center">'.$row['ch_no'].'</td>';
            echo '<td align="center"><b>'.$row['ch_title'].'</b></td>';
            echo '<td align="center">'.$row['hrs'].'</td>';
            echo '<td align="center">Learners should be able to /<br></td>';
           
            $subtopics= explode(";", $row['subtopics']);
            $stlen=count($subtopics);
            $pcd= explode(";", $row['pcd']);
            $plen=  count($pcd);
            $acd= explode(";", $row['acd']);
            $alen=  count($acd);
            $subhrs= explode(";", $row['subhrs']);
            $shlen=  count($subhrs);
            $remarks= explode(";", $row['remarks']);
            $rlen=  count($remarks);
            $topics_outcomes=explode(";", $row['topics_outcomes']);
            $tlen=  count($topics_outcomes);
            
            echo '<td align="center">'.$pcd[$plen-1].'</td>';
            echo '<td align="center">'.$acd[$alen-1].'</td>';
            echo '<td align="center"></td>';
            echo '</tr>';
            
            echo '<tr>';
            echo '<td></td>';
            echo '<td align="left">';
            for ($i = 0; $i < $stlen; $i++) {
                echo ''.$subtopics[$i].'<br><br>';
            }
            echo '</td>';
            
            echo '<td align="center">';
            for ($i = 0; $i < $shlen; $i++) {
                echo ''.$subhrs[$i].'<br><br>';                
            }
            echo '</td>';
            
            echo '<td align="left">';
            for ($i = 0; $i < $tlen; $i++) {
                echo ''.$topics_outcomes[$i].'<br><br>';
            }
            echo '</td>';
                
            echo '<td align="center">';
            for ($i = 0; $i < $plen; $i++) {
                echo ''.$pcd[$i].'<br><br>';
            }
            echo '</td>';
            
            echo '<td align="center">';
            for ($i = 0; $i < $alen; $i++) {
                echo ''.$acd[$i].'<br><br>';
            }
            echo '</td>';
            
            echo '<td align="center">';
            for ($i = 0; $i < $rlen; $i++) {
                echo ''.$remarks[$i].'<br><br>';    
            }
            echo '</td>';
            echo '</tr>';
        }
                    
        echo '<tr>';
        echo '<td align="left" colspan="4"><br><br>(Prof. '.$fac_name.')<br>Subject In-charge</td>';
        $query="select f.name from Faculty f,Department d where f.fac_id=d.hod";
        $result=mysql_query($query);
        $row=  mysql_fetch_array($result);
        echo '<td align="right" colspan="3"><br><br>(Prof. '.$row['name'].')<br>HOD</td>';
        echo '</tr>';
        echo '<tr><td align="center" colspan="7">Report Generated on: '.date("d/m/Y").' at  '.date("h:i:sa").' by- '.$appname.'-Account-'.$user.'</td></tr>';
       
        echo '</table>';
        echo '<input type="hidden" id="style" name="style" value="0"/>';
        echo '<input type="hidden" id="filename" name="filename" value="TLO-'.$dept_id.'-'.$sem.'-'.$tlcourse.'-'.$tlyear.'"/>';
        echo '<input type="hidden" id="page" name="page" value=""/>';
        echo '<input type="hidden" id="orientation" name="orientation" value="L"/>';
        echo '<input type="button" width="100%" class="button" name="generatepdf" id="generatepdf" value="Generate PDF"/>';            
        echo '</center>';
        echo '</form>';
      }
   }
 }
 else {
     echo '<center><span class="error">Data not posted</span></center>';
     
 }
}
 else echo'<br><br><span class="error">Please sign up and/or login to use the system</span>';
require_once 'functions/footer.php';
 ?>
