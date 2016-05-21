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
*   Created On: 9 Jun, 2015, 12:31:18 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';

if($loggedin){
         if($_POST){
             if(isset($_POST[cacourse])&& isset($_POST[cayear])){
                $vcayear=$_POST['cayear'];
                $vcacourse=$_POST['cacourse'];
                $vcafac_id=$_POST['ffac_id'];
                $vcadept=NULL;
                $vcatitle=$_POST['title'];
                $vcasem=NULL;
                $vcaabbrv=NULL;
                $batch="(";
                if($vcacourse==""){
                    echo '<br><br><center><span class="error">Please Select Course</span></center>';
                    die();
                }
                
                $result=  queryMysql("select name from Faculty where fac_id='".$vcafac_id."'");
                while($row=  mysql_fetch_array($result)){$fac_name=$row['name'];}
    
                $query="select c.title,c.dept,d.name,c.sem,c.abbrv from Course c join Department d on c.dept=d.dept_id where c.course_id='".$vcacourse."'";                
                $result=  queryMysql($query);
                if(mysql_num_rows($result)==0){
                    echo '<br><span class="error">No Records Found</span></br>';
                    die();
                }    
                while ($row = mysql_fetch_array($result)) {
                        $vcadept=$row['name'];
                        $vcadept_id=$row['dept'];
                        $vcasem=$row['sem'];
                        $vcaabbrv=$row['abbrv'];
                }
              
                //echo ''.$vcaabbrv;
                $query="SELECT batch FROM Teaches where fac_id='".$vcafac_id."'and course_id='".$vcacourse."' and year='".$vcayear."' and THorPR=0 and batch!=0";
                
                $result=  queryMysql($query);
                if(mysql_num_rows($result)==0){
                    echo '<br><span class="error">No Records Found</span></br></br>';
                    //die();
                }
                else{
                while($row=  mysql_fetch_array($result)){
                    $batch.=$row['batch'].",";    
                }
                $batch.="0)"; 
                
                $result=  queryMysql("select compo_id,weightage,compo_nos,components from TwCompoWeight natural join TwComponents where course_id='".$vcacourse."' and year='".$vcayear."' order by compo_nos desc");
                if(mysql_num_rows($result)==0){
                    echo '<br><span class="error">No Records Found!</span>';
                    die();
                }
                $columns=0;
                $weightage=0;
                $i=0;
                $components=[];
                $compoCount=[];
                $compoId=[];
                $compoWeightage=[];
                while ($row = mysql_fetch_array($result)) {
                    $columns +=($row['compo_nos']+1);
                    $weightage +=$row['weightage'];
                    $compoWeightage[$i]=$row['weightage'];
                    $compoCount[$i]=$row['compo_nos'];
                    $components[$i]=$row['components'];
                    $compoId[$i]=$row['compo_id'];
                    $i++;
                }
                
                $columns+=4;
                $srCount=1;
                 ob_start();
                echo '<div id="wrapper" class="scrollwrapper">';
                echo '<form method="post" id="form1">';
                 echo '<center>';
                  echo '<table  id="pdfTable" cellspacing="0" cellpadding="4" border="1" style="background:transparent;text-align:center;">';
                    echo '<tr><td colspan="2" align="center"><img src="images/college_logo.jpg" ></td><td colspan="'.($columns-2).'" align="center"><h2>'.$colname.'</h2>'
                    . '<hr>PLOT NO.2&3,SECTOR 16,NEAR THANA NAKA ,KHANDAGAON,NEW PANVEL – 410206'
                    .'<hr><h4><u>CONTINOUS ASSESSMENT SHEET</u>&nbsp; / &nbsp;<u>TERM WORK SUBMISSION RECORD</u></h4>'
                    .'<hr><pre>Faculty: Prof. '.$fac_name. '    Course Title: '.$vcatitle.'('.$vcaabbrv.')    Course ID:'.$vcacourse.'<br>'
                    . 'Semester: '.$vcasem.'    Year:'.$vcayear.'    Department: '.$vcadept.'('.$vcadept_id.')<br>'
                    .'</td></tr>';          
                    echo '<tr>';
                        echo '<td align="center" rowspan="2" >Sr No.</td>';
                        echo '<td align="center" rowspan="2" >Roll No.</td>';
                        echo '<td align="center" rowspan="2" >Name</td>';
                        $i=0;
                            
                        while($i < count($compoCount)){
                            echo '<td align="center" colspan="'.($compoCount[$i]+1).'" >'.$components[$i].'('.$compoWeightage[$i].')</td>';
                            $i++;
                        }
                        echo '<td align="center" rowspan="2" >Total<br>('.$weightage.')</td>';
                   echo '</tr>';
                   
                   echo '<tr>';
                            $i=0;
                        while($i < count($compoCount)){
                            $j=1;
                            while($j <= $compoCount[$i]){
                                echo '<td align="center">'.str_pad($j, 2, '0', STR_PAD_LEFT).'</td>';
                                $j++;
                            }
                                echo '<td align="center">Avg</td>';
                                $i++;
                        }
                   echo '</tr>';
                   
                   $prevRoll=-1;
                   $compoTotal=0;
                   $total=0;
                   $query="select c.*,s.name,s.batch,t.weightage,t.compo_nos from CA c natural join Student s natural join TwCompoWeight t where c.course_id='".$vcacourse."' and c.year='".$vcayear."' and s.batch in ".$batch." order by rollno asc,compo_nos desc,compo_no asc";         
                   $result=  queryMysql($query);
                    while($row = mysql_fetch_array($result)){
                        
                        if($prevRoll!=$row[rollno]){
                          if($prevRoll!=-1){
                            echo '<td align="center">'.round($total, 0, PHP_ROUND_HALF_UP).'</td>';
                            echo '</tr>';
                            $total=0;
                            $srCount++;
                          }
                            echo '<tr>';
                            echo '<td align="center">'.$srCount.'</td>';
                            echo '<td align="center">'.$row['rollno'].'</td>';
                            echo '<td align="center">'.$row['name'].'</td>';
                            $prevRoll=$row['rollno'];
                        }
                         
                        if($prevRoll==$row['rollno']){
                         echo '<td align="center">'.$row['marks'].'</td>';
                             if($row['marks']!=NULL){
                                  $compoTotal+=$row['marks'];
                             }
                            
                            if($row[compo_no]==$row[compo_nos]){
                              echo '<td align="center">'.  number_format(($compoTotal/$row[compo_nos]),2).'</td>';                
                              $total+=($compoTotal/$row[compo_nos]);
                              $compoTotal=0;
                            } 
                        }  
                    }
                    echo '<td align="center">'.round($total, 0, PHP_ROUND_HALF_UP).'</td>';
                    echo '</tr>';
                   echo '<tr>';
                   echo '<td align="left" colspan="3"><br><br>(Prof. '.$fac_name.')<br>Practical In-charge</td>';
                   $query="select f.name from Faculty f,Department d where f.fac_id=d.hod";
                   $result=mysql_query($query);
                   $row=  mysql_fetch_array($result);
                   echo '<td align="right" colspan="'.($columns-3).'"><br><br>(Prof. '.$row['name'].')<br>HOD</td>';
                   echo '</tr>';
                   echo '<tr><td align="center" colspan="'.$columns.'">Report Generated on: '.date("d/m/Y").' at  '.date("h:i:sa").' by- '.$appname.'-Account-'.$user.'</td></tr>';
                    echo '</table>';
                     echo '<input type="button" width="100%" class="button" name="generatepdf" id="generatepdf" value="Generate PDF"/>';
                     echo '<input type="hidden" id="filename" name="filename" value="Defaulter-List-'.$vcadept_id.'-'.$vcasem.'-'.$vcayear.'"/>';
                     echo '<input type="hidden" id="page" name="page" value=""/>';
                     echo '<input type="hidden" id="orientation" name="orientation" value="L"/>';
                     echo '<input type="hidden" id="style" name="style" value="2"/>';
                     echo '</center>';
                     echo '</form></div>';
                 
                }
             }
         }
         else{
             echo '<br><br><span class="error">DATA NOT POSTED</span>';
             header('Location:   index.php');
         }
     }
     else echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';
     
     require_once 'functions/footer.php';
 ?>