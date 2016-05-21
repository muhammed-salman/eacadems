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
*   Created On: 29 May, 2015, 10:58:40 AM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
updateTLO();
if($loggedin){
    if($_POST){
        if(isset($_POST['tlcourse'])&& isset($_POST['tlyear'])) {
        $tlyear=$_POST['tlyear'];
        $tlcourse=$_POST['tlcourse'];
        $title=$_POST['title'];
        $query="select * from TLO t natural join Syllabus s where t.year='".$tlyear."' and t.course_id='".$tlcourse."'";
        echo '<center>'; 
       if(!mysql_query($query)){
            echo "<br><span class='error'>Failed to execute query : ".  mysql_error()."</span><br>";
            die();
       }
        
        $result=  mysql_query($query); 
        if(mysql_num_rows($result)==0)
        {
            echo '<br><center><span class="error">No Records Found</span></center><br><br>';
        }
        else {
echo <<<_END
        <form method="post" action="updatetlo.php" onsubmit="return confirm('Are you sure you want to submit?.You will not be able to modify contents later.')">
          
          <table cellspacing="0" cellpadding="2" border="1" bgcolor="#00eeee">
_END;

            echo '<th colspan="9" align="center"><pre>Course Title: '.$title.'    Course ID:'.$tlcourse.'    Year:'.$tlyear.'</pre></th>';          
                

echo <<<_END

            <tr>
                <th align="center" width="2%"><b>Mod No.</b></th>
                <th align="center"><b>Syllabus</b></th>
                <th align="center" width="2%"><b>Hours</b></th>
                <th align="center" width="25%"><b>Sub Topics</b></th>
                <th align="center" width="5%"><b>Sub hours</b></th>
                <th align="center" width="25%"><b>Topics Outcomes</b></th>
                <th align="center" width="5%"><b>PCD</b></th>
                <th align="center" width="5%"><b>ACD</b></th>
                <th align="center" width="5%"><b>Remarks</b></th>
            </tr>
_END;
        while($row=  mysql_fetch_array($result)){
            echo '<tr>';
            echo '<td align="center">'.$row['ch_no'].'</td>';
            echo '<td align="center"><b>'.$row['ch_title'].'</b><br>'.$row['topics'].'</td>';
            echo '<td align="center">'.$row['hrs'].'</td>';    
            echo '<td align="center"><textarea name="'.$row["ch_no"].'_subtopics" placeholder="List of Sub Topics seprated by semicolon ( ; )" rows="15" style="border:0; width:100%; margin:0; height:auto;';
            if($row['subtopics']!=NULL){
                    echo 'background: transparent;" readonly="readonly">'.$row['subtopics'].'</textarea></td>';
                  }
                else {
                    echo '">'.$row['subtopics'].'</textarea></td>';
                }
            echo '<td align="center"><textarea name="'.$row["ch_no"].'_subhrs" placeholder="Sub Hours seprated by semicolon ( ; )" rows="15" style="border:0; width:100%; margin:0; height:auto;';
            if($row['subhrs']!=NULL){
                    echo 'background: transparent;" readonly="readonly">'.$row['subhrs'].'</textarea></td>';
                  }
                else {
                    echo '">'.$row['subhrs'].'</textarea></td>';
                }
            echo '<td align="center"><textarea name="'.$row["ch_no"].'_topics_outcomes" placeholder="List of Outcomes for each Sub Topics seprated by semicolon ( ; )" rows="15" style="border:0; width:100%; margin:0; height:auto;';
            if($row['topics_outcomes']!=NULL){
                    echo 'background: transparent;" readonly="readonly">'.$row['topics_outcomes'].'</textarea></td>';
                  }
                else {
                    echo '">'.$row['topics_outcomes'].'</textarea></td>';
                }
            echo '<td align="center"><textarea name="'.$row["ch_no"].'_pcd" rows="15" placeholder="Planned Completion Dates seprated by semicolon ( ; )" style="border:0; width:100%; margin:0; height:auto;';
            if($row['pcd']!=NULL){
                    echo 'background: transparent;" readonly="readonly">'.$row['pcd'].'</textarea></td>';
                  }
                else {
                    echo '">'.$row['pcd'].'</textarea></td>';
                }    
            echo '<td align="center"><textarea name="'.$row["ch_no"].'_acd" rows="15" placeholder="Actual Completion Dates seprated by semicolon ( ; )" style="border:0; width:100%; margin:0; height:auto;';
            if($row['acd']!=NULL){
                    echo 'background: transparent;" readonly="readonly">'.$row['acd'].'</textarea></td>';
                  }
                else {
                    echo '">'.$row['acd'].'</textarea></td>';
                } 
            echo '<td align="center"><textarea name="'.$row["ch_no"].'_remarks" rows="15" placeholder="Remarks seprated by semicolon ( ; )" style="border:0; width:100%; margin:0; height:auto;';
            if($row['remarks']!=NULL){
                    echo 'background: transparent;" readonly="readonly">'.$row['remarks'].'</textarea></td>';
                  }
                else {
                    echo '">'.$row['remarks'].'</textarea></td>';
                }
            echo '</tr>';
        }
        echo '<tr>';
        echo '<td align="center" colspan="9"> <input type="submit" class="button" value="Update"/></td>';
        echo '</tr>';    
        }
        echo '</table>';
        echo '<input type="hidden" name="utcourse" id="uscourse" value="'.$tlcourse.'"/>';
        echo '<input type="hidden" name="utyear" id="utyear" value="'.$tlyear.'"/>';
        echo '<input type="hidden" name="tlcourse" id="tlcourse" value="'.$tlcourse.'"/>';
        echo '<input type="hidden" name="tlyear" id="tlyear" value="'.$tlyear.'"/>';
        echo '<input type="hidden" name="title" id="title" value="'.$title.'"/>';
        echo '</center>';
        echo '</form>';
 
   }
 }
 else {
     echo '<span class="error">Data not posted</span>';
     header('Location:   index.php');
 }
}
 else echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';          
 require_once 'functions/footer.php';
 ?>
