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

     if($loggedin){
         if($_POST){
             if(isset($_POST[uppyear])&& isset($_POST[uppcourse])&& isset($_POST['uppfac_id'])){
                $uppyear=$_POST['uppyear'];
                $uppsub=$_POST['uppcourse'];
                $uppfac_id=$_POST['uppfac_id'];
                //echo ''.$uppfac_id."-".$uppsub."-".$uppyear;
                
                $uppdept=NULL;
                $upptitle=NULL;
                $uppsem=NULL;
                $uppabbrv=NULL;
                $batchCount=0;
                
                echo '<center>'; 
                
                $query="select c.title,c.dept,d.name,c.sem,c.abbrv from Course c join Department d on c.dept=d.dept_id where c.course_id='".$uppsub."'";                
                if(!mysql_query($query)){
                    echo "<br><span class='error'>Unable to retrive department : ".  mysql_error()."</span><br>";
                    die();
                }
                else {
                    $result=mysql_query($query);
                    while ($row = mysql_fetch_array($result)) {
                        $uppdept=$row['name'];
                        $upptitle=$row['title'];
                        $uppsem=$row['sem'];
                        $uppabbrv=$row['abbrv'];
                    }
                }
                $query="SELECT batch FROM Teaches where fac_id='".$uppfac_id."'and course_id='".$uppsub."' and year='".$uppyear."' and THorPR=0 and batch!=0";
             
                $result=  queryMysql($query);
                if(mysql_num_rows($result)==0){
                    echo '<br><span class="error">Records Not Found</span><br>';
                    die();
                }
                $batchCount=  mysql_num_rows($result);
                
                $columns=2*$batchCount+2;
                echo '<form method="post" id="form1" onsubmit="return confirm("Are you sure you want to update Practical Plan.You will not be able to modify entered data later.")">';
                ob_start();
                 
                  echo '<table id="pdfTable" cellspacing="0" width="100%" cellpadding="2" border="1" style="overflow:wrap; border: 1px solid black;border-collapse:collapse; border-spacing:0;">';
                    echo '<tr><td colspan="1" align="center" width="15%"><img src="images/college_logo.jpg"></td>'
                            .'<td colspan="'.($columns-1).'" align="center"><h3 align="center">'.$colname.'</h3></td>'
                            .'</tr>';
                    echo '<tr><th align="center" colspan="'.$columns.'"><b>Practical Plan</b></th></tr>';
                    echo '<tr><td align="center" colspan="'.$columns.'"><pre><b>Department:</b>'.$uppdept.'   <b>Semester:</b>'.$uppsem.'    <b>Year:</b>'.$uppyear.'</pre></td></tr>';
                    echo '<tr><td align="center" colspan="'.$columns.'"><pre><b>Course Title:</b>'.$upptitle.'('.$uppabbrv.')    <b>Course Code:</b>'.$uppsub.'    <b>Date:</b>'.date("d/m/Y").'</pre></td></tr>';    
                    echo '<tr colspan="2">';
                        echo '<th align="center" rowspan="2" >EXP NO.</th>';
                        echo '<th align="center" rowspan="2" width="40%">Title of the Experiment</th>';
                        
                         while($row = mysql_fetch_array($result)){
                            echo '<th align="center" colspan="2">B'.$row['batch'].'</th>';
                        }
                    echo '</tr>';
                    echo '<tr>';
                        $result=mysql_query($query);
                        while($row = mysql_fetch_array($result)){
                            echo '<th align="center" style="font-size:8pt;">P.D</th>';
                            echo '<th align="center" style="font-size:8pt;">D.O.P</th>';
                        }
                    echo '</tr>';
                
                    $query="select * from PracPlan where course_id='".$uppsub."' and year='".$uppyear."' and batch in "
                            ."(select batch from Teaches where course_id='".$uppsub."' and year='".$uppyear."' and fac_id='".$uppfac_id."')order by expno asc,batch asc";
                
                    if(!mysql_query($query)){
                        echo "<br><font color='red'>Unable to retrive records : ".  mysql_error()."</font><br>";
                    }
                    else {
                        $result=mysql_query($query);
                        $prevExp=NULL;
                        while ($row = mysql_fetch_array($result)) {
                            if($prevExp==NULL)
                            {
                              
                             echo '<tr>';
                                echo '<td align="center">'.$row['expno'].'</td>';
                                echo '<td align="center" width="40%" style="font-size:8pt;">'.$row["title"].'</td>';
                                $prevExp=$row['expno'];
                            }
                            if($prevExp!=$row['expno'] && $prevExp!=NULL )
                            {
                             echo '</tr>';
                             echo '<tr>';
                                echo '<td align="center">'.$row['expno'].'</td>';
                                echo '<td align="center" width="40%" style="font-size:8pt;">'.$row["title"].'</td>';
                                $prevExp=$row['expno'];
                            }
                            if($prevExp==$row['expno']){
                                if($row[pd]!=NULL){
                                    echo '<td align="center" style="font-size:5pt;">'.date('d/m/Y',  strtotime($row['pd'])).'</td>';
                                }
                                else{
                                    echo '<td align="center"></td>';
                                }
                                if($row[dop]!=NULL){
                                    echo '<td align="center" style="font-size:5pt;">'.date('d/m/Y',  strtotime($row['dop'])).'</td>';
                                }
                                else{
                                    echo '<td align="center"></td>';
                                }
                            }
                        
                    }
                    echo '</tr>';
                }
                   $query="select name from Faculty where fac_id='".$uppfac_id."'";
                   $result=mysql_query($query);
                   $row=  mysql_fetch_array($result);
                   echo '<tr>';
                   echo '<td align="left" colspan="2"><br><br>(Prof. '.$row['name'].')<br>Practical In-charge</td>';
                   $query="select f.name from Faculty f,Department d where f.fac_id=d.hod";
                   $result=mysql_query($query);
                   $row=  mysql_fetch_array($result);
                   echo '<td align="right" colspan="'.($columns-2).'"><br><br>(Prof. '.$row['name'].')<br>HOD</td>';
                   echo '</tr>';
                   echo '<tr><td align="center" colspan="'.$columns.'">Report Generated on: '.date("d/m/Y").' at  '.date("h:i:sa").' by- '.$appname.'-Account-'.$user.'</td></tr>';
                   echo '</table>';
                                     
                   echo '<input type="hidden" id="style" name="style" value="2"/>';
                   echo '<input type="hidden" id="filename" name="filename" value="PracPlan-'.$uppdept.'-'.$uppabbrv.'-'.$uppsem.'-'.$uppyear.'"/>';
                   echo '<input type="hidden" id="page" name="page" value=""/>';
                   echo '<input type="hidden" id="orientation" name="orientation" value="P"/>';
                   echo '<table width="100%" cellspacing="0" cellpadding="2" border="0" bgcolor="#00eeee"> <tr>';
                   echo '<td width="50%" align="center"><input type="button" width="100%" class="button" name="generatepdf" id="generatepdf" value="Generate PDF"></td>';
                   echo '</tr></table>';
                 echo '</center>';
                echo '</form>';
                
                
             }
            else {                 echo 'Something is not set'; }
         }
         else
             echo '<br><br><center><span class="error">DATA NOT POSTED</span></center>';
      
     }
     else echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';
require_once 'functions/footer.php';
?>
          