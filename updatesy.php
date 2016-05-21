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
*/
require_once 'functions/header.php';
if($loggedin){
     if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'){
         updateSyllabus();
     
      if($_POST){
        if(isset($_POST['fscourse'])) {
       
        $fscourse=$_POST['fscourse'];
        $fstitle=$_POST['fstitle'];
       
        $result=  mysql_query("select re from Course where course_id='".$fscourse."'"); 
        if(mysql_num_rows($result)==0){
            echo '<br><center><span class="error">No Records Found</span></center><br>';
            die();
        }
        while($row=  mysql_fetch_array($result)){
            $fsyear=$row['re'];
        }
        $query="select * from Syllabus where course_id='".$fscourse."'";
        
        $result= queryMysql($query); 
        if(mysql_num_rows($result)==0)
        {
            echo '<br><center><span class="error">No Records Found</span></center><br>';
            die();
        }
        else {
echo <<<_END
        <form method="post" action="updatesy.php" onsubmit="return confirm('Are you sure you want to submit?.You will not be able to modify contents later.')">
          <center>
          <table cellspacing="4" cellpadding="2" border="0">
_END;

            echo '<th colspan="4" align="center"><pre>Course Title: '.$fstitle.'    Course ID:'.$fscourse.'    REVISION YEAR:'.$fsyear.'</th>';          
                

echo <<<_END

            <tr>
                <th align="center" width="5%"><b>Module No.</b></th>
                <th align="center" width="30%"><b>Title</b></th>
                <th align="center" width="50%"><b>Topics</b></th>
                <th align="center" width="5%"><b>Hours</b></th>
            </tr>
_END;
        while($row=  mysql_fetch_array($result)){
            echo '<tr>';
            echo '<td align="center"> <input type="text"  name="'.$row["ch_no"].'" style="border:0; background: transparent; text-align: center;" value="'.$row['ch_no'].'" readonly="readonly" /></td>';
            echo '<td align="center"><textarea rows="2" name="'.$row["ch_no"].'_title" style="border:0; width:100%; margin:0; height:auto;';
                  if($row['ch_title']!=NULL){
                    echo 'background: transparent;" readonly="readonly">'.$row['ch_title'].'</textarea></td>';
                  }
                else {
                    echo '">'.$row['ch_title'].'</textarea></td>';
                }
            echo '<td align="center"><textarea rows="2" name="'.$row["ch_no"].'_topics" style="border:0; width:100%; margin:0; height:auto;';
            if($row['topics']!=NULL){
                    echo 'background: transparent;" readonly="readonly">'.$row['topics'].'</textarea></td>';
                  }
                else {
                    echo '">'.$row['topics'].'</textarea></td>';
                }
            echo '<td align="center"><input type="number" min="1" max="20" name="'.$row["ch_no"].'_hrs" style="border:0; width:100%; margin:0; height:auto;';
               if($row['hrs']!=NULL){
                    echo 'background: transparent;" readonly="readonly" value="'.$row['hrs'].'"/></td>';
                  }
                else {
                    echo '" value="'.$row['hrs'].'"/></td>';
                }
         
            echo '</tr>';
        }
        echo '<tr>';
        echo '<td align="center" colspan="4"> <input type="submit" class="button" value="Update"/></td>';
        echo '</tr>';    
        }
        echo '</table>';
        echo '<input type="hidden" name="uscourse" id="uscourse" value="'.$fscourse.'"/>';
        echo '</center>';
        echo '</form>';
 
   }
 }
 else {
     echo '<br><span class="error">Data not posted</span>';
     header('Location:   index.php');
     
 }
}
else {
      echo '<br><br><center><span class="error">Access Denied! You are not authorized to view this section</span></center>';    
}
}
 else echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';          
require_once 'functions/footer.php'; 
 ?>