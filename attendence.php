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

require_once 'functions/header.php';
markAttendence();
if($loggedin)
{
if($_POST)
{
    if(isset($_POST['fyear'])&& isset($_POST['fsub'])&& isset($_POST['fdol'])
                && isset($_POST['fthpr'])&& isset($_POST['fnol'])
            && isset($_POST['fslot'])&& isset($_POST['fbatch'])){
        $fyear=  trim($_POST['fyear']);;
        $fsub=trim($_POST['fsub']);
        $fnol=$_POST['fnol'];
        $fdol=$_POST['fdol'];
        $fdol=date('Y-m-d',strtotime(str_replace('/','.',$fdol)));
                              
        $fthpr= intval($_POST['fthpr']);
        $fslot= intval($_POST['fslot']);
        $fbatch= intval($_POST['fbatch']);
        
        if($fthpr==0)
            $insCount=2;
        else
            $insCount=1;

        $i=1;
        while($i<=$insCount){
        
            $query="INSERT INTO `Th_Pr-Record` VALUES('$fsub','$fdol','$fyear','$fthpr','$fslot','$fbatch','$fnol')";
            queryMysql($query);
            $i++;
            $fslot++;
        }
        if($fthpr==0)
            $fslot-=2;
        else
            $fslot--;
        if($fthpr==1){
            $query="select t.rollno,s.name from Takes t,Student s where t.rollno=s.rollno"
                . " AND t.year='".$fyear."' AND t.course_id='".$fsub."'";
        }
        else{
            $query="select t.rollno,s.name from Takes t,Student s where t.rollno=s.rollno"
                . " AND t.year='".$fyear."' AND t.course_id='".$fsub."' and s.batch=".$fbatch;
        }
        $result= queryMysql($query);
        
        if(mysql_num_rows($result)==0)
        {
            echo '<center><span class="error">No Records Found</span></center>';
            die();
        }
        else {
echo <<<_END
 
    <div id="left">
_END;
echo '<div class="info-box"><div class="full-title-redgrad">Important Guidelines</div>';
echo '<ul>'
        . '<li>'.$checkmark.' Do not close the window / leave the page before submitting the form,'
           .' else no absentee will be marked.</li>'
    . '</ul>'
    . '</div>';

echo <<<_END
   </div>
    <div id="right">    
             
        
        <form method="post" action="attendence.php" onsubmit="return confirmSubmit()">
    
          <div class="full-title-blackgrad">Attendence Form</div>
          <div class="fit-title-redgrad">
              <input type="checkbox" name="absentcheck" id="absentcheck"  class="roll-check">Absent All
          </div>
         <div id="roll-list">
          
               
_END;
            $sr=1;
            while($row = mysql_fetch_array($result)){
            echo '<div title="'.$row['name'].'">'
                    .' <input type="checkbox" class="absentroll roll-check" name="rollno[]" value="'.$row['rollno'] .'">'
                    .sprintf("%02d",$sr).'. '.$row['rollno'].'<span>'.sprintf("%.15s",$row['name']).'</span>'.
                    '</div>';
            $sr++;  
            }
echo <<<_END
            </div>
                <div style="text-align:center;">
                    <input type="submit" class="button" style="width:7vw;" value="Submit">
                </div>
_END;
        echo  '<input type="hidden" name="acourse_id" id="acourse_id" value="'.$fsub.'">';
        echo  '<input type="hidden" name="afdol" id="afdol" value="'.$fdol.'">';
        echo  '<input type="hidden" name="ayear" id="ayear" value="'.$fyear.'">';
        echo  '<input type="hidden" name="athorpr" id="athorpr" value="'.$fthpr.'">';
        echo  '<input type="hidden" name="aslot" id="aslot" value="'.$fslot.'">';
        echo  '<input type="hidden" name="abatch" id="abatch" value="'.$fbatch.'">';
        
        echo   '</form>';
        echo '</div>';
        
            
     
        }
    }
}
 else {
    echo '<span class="error">Data Not Posted</span>';
     
}
}
 else {
     echo'<span class="error">Please sign up and/or login to use the system</span>';
    
}
require_once 'functions/footer.php';
?>