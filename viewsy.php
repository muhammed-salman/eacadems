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
        }
        else {
echo <<<_END
        <form>
          <center>
          
_END;

           // echo '<th colspan="4" align="center"><pre>Course Title: '.$fstitle.'    Course ID:'.$fscourse.'    REVISION YEAR:'.$fsyear.'</th>';          
                
            $query="select * from Course where course_id='".$fscourse."'";
        
            $resc= queryMysql($query); 
            if(mysql_num_rows($resc)==0)
            {
              echo '<br><center><span class="error">No Records Found</span></center><br>';
            }
            else {
                echo '<div class="scrollwrapper">';
                echo '<table class="mobile-table" id="viewsy-distribution">';
                while($rowc=  mysql_fetch_array($resc)){
                    echo '<tr><th colspan="9" align="center"><b>MARKS DISTRIBUTION</b></th>'
                    . '<th colspan="4" align="center"><b>CREDITS DISTRIBUTION</b></th></tr>';
                    echo '<tr>';
                    echo '<th>Course Code</th>';
                    echo '<th>Course Title</th>';
                    echo '<th>Semester</th>';
                    echo '<th>Internal Assesment</th>';
                    echo '<th>TH</th>';
                    echo '<th>TW</th>';
                    echo '<th>PR</th>';
                    echo '<th>OR</th>';
                    echo '<th>Total</th>';
                    echo '<th>TH</th>';
                    echo '<th>TW/PR</th>';
                    echo '<th>Tutorial</th>';
                    echo '<th>Total</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>'.$rowc['course_id'].'</td>';
                    echo '<td>'.$rowc['title'].' ['.$rowc['abbrv'].'] </td>';
                    echo '<td>'.$rowc['sem'].'</td>';
                    echo '<td>'.$rowc['IA'].'</td>';
                    echo '<td>'.$rowc['TH'].'</td>';
                    echo '<td>'.$rowc['TW'].'</td>';
                    echo '<td>'.$rowc['PR'].'</td>';
                    echo '<td>'.$rowc['OR'].'</td>';
                    echo '<td>'.$rowc['totalM'].'</td>';
                    echo '<td>'.$rowc['THCr'].'</td>';
                    echo '<td>'.$rowc['PRCr'].'</td>';
                    echo '<td>'.$rowc['TutCr'].'</td>';
                    echo '<td>'.$rowc['totalC'].'</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
echo <<<_END
            <table cellspacing="0" cellpadding="4" border="1" bgcolor="#00eeee">
            <tr>
                <th align="center"><b>Module No.</b></th>
                <th align="center"><b>Title</b></th>
                <th align="center"><b>Topics</b></th>
                <th align="center"><b>Hours</b></th>
            </tr>
_END;
        while($row=  mysql_fetch_array($result)){
            echo '<tr>';
            echo '<td align="center">'.$row['ch_no'].'</td>';
            echo '<td align="center">'.$row['ch_title'].'</td>';
            echo '<td align="center">'.$row['topics'].'</td>';
            echo '<td align="center">'.$row['hrs'].'</td>';
            echo '</tr>';
        }
            
        }
        echo '</table>';
        echo '</center>';
        echo '</form>';
   }
 }
 else {
     echo '<center><span class="error">Data not posted</span></center>';
     
 }
}
 else{
     echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';          
 
     header('Refresh:0 ,url=login.php');
 }
require_once 'functions/footer.php';
 ?>