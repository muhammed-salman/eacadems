<!doctype html>
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
*   Created On: 1 Jun, 2015, 9:59:10 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
updateCA();
     if($loggedin){
         if($_POST){
             if(isset($_POST[cacourse])&& isset($_POST[cayear])){
                $ucayear=$_POST['cayear'];
                $ucacourse=$_POST['cacourse'];
                $ucafac_id=$_POST['ffac_id'];
                $ucadept=NULL;
                $ucatitle=$_POST['title'];
                $ucasem=NULL;
                $ucaabbrv=NULL;
                $batch="(";
                
                if($ucacourse==""){
                    echo '<span class="error">Please Select Course</span>';
                    die();
                }
                
                $query="select c.title,c.dept,d.name,c.sem,c.abbrv from Course c join Department d on c.dept=d.dept_id where c.course_id='".$ucacourse."'";                
                if(!mysql_query($query)){
                    echo "<span class='error'>Unable to retrive department : ".  mysql_error()."</span>";
                    die();
                }
                else{
                    $result=mysql_query($query);
                    while ($row = mysql_fetch_array($result)) {
                        $ucadept=$row['name'];
                        $ucasem=$row['sem'];
                        $ucaabbrv=$result['abbrv'];
                    }
                }
                $query="SELECT batch FROM Teaches where fac_id='".$ucafac_id."'and course_id='".$ucacourse."' and year='".$ucayear."' and THorPR=0 and batch!=0";
                if(!mysql_query($query)){
                    echo "<span class='error'>Unable to retrive records : ".  mysql_error()."</span>";
                    die();
                }
                else {
                    $result=mysql_query($query);
                    while($row=  mysql_fetch_array($result)){
                    $batch.=$row['batch'].",";    
                    }
                    $batch.="0)"; 
                }
                echo '<div id="wrapper" class="scrollwrapper">';
                $result=  queryMysql("select compo_id,weightage,compo_nos,components from TwCompoWeight natural join TwComponents where course_id='".$ucacourse."' and year='".$ucayear."' order by compo_nos desc");
                if(mysql_num_rows($result)==0){
                    echo '<span class="error">No Records Found!</span>';
                    die();
                }
                echo '<form method="post" action="updateca.php" onsubmit="return confirm(\'Are you sure you want to Update.You will not be able to modify entered data later.\')">';
                echo '<input type="hidden" name="ucacourse" id="ucacourse" value="'.$ucacourse.'"/>';
                    echo '<input type="hidden" name="ucayear" id="ucayear" value="'.$ucayear.'"/>';
                    echo '<input type="hidden" id="ucafac_id" name="ucafac_id" value="'.$ucafac_id.'"/>';
                    echo '<input type="hidden" id="ucabatch" name="ucabatch" value="'.$batch.'"/>';                    
                    echo '<input type="hidden" name="cacourse" id="ucacourse" value="'.$ucacourse.'"/>';
                    echo '<input type="hidden" name="cayear" id="ucayear" value="'.$ucayear.'"/>';
                    echo '<input type="hidden" name="title" id="title" value="'.$ucatitle.'"/>';
                    echo '<input type="hidden" name="ffac_id" id="ffac_id" value="'.$ucafac_id.'"/>';
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
                    echo '<input type="hidden" class="compoweight" name="'.$compoId[$i].'_weight" value="'.$compoWeightage[$i].'"/>';
                    echo '<input type="hidden" class="compoid" name="'.$compoId[$i].'_id" value="'.$compoId[$i].'"/>';
                    echo '<input type="hidden" class="componos" name="'.$compoId[$i].'_count" value="'.$compoCount[$i].'"/>';
                    echo '<input type="hidden" class="componame" name="'.$compoId[$i].'_name" value="'.$components[$i].'"/>';
                    $i++;
                }
                
                $columns+=4;
                $srCount=1;
                
                ob_start();
               
                  echo '<table id="catable">';
                   echo '<tr>'
                  . '<th colspan="'.$columns.'" ><pre>Course Title: '.$ucatitle.'    Course ID:'.$ucacourse.'    Year:'.$ucayear.'    Sem:'.$ucasem.'    Department:'.$ucadept.'</pre></th>'
                      . '</tr>';          
   
                   echo '<tr>';
                        echo '<td rowspan="2" >Sr No.</td>';
                        echo '<td rowspan="2" >Roll No.</td>';
                        echo '<td rowspan="2" >Name</td>';
                        $i=0;
                            
                        while($i < count($compoCount)){
                            echo '<td colspan="'.($compoCount[$i]+1).'" >'.$components[$i].'('.$compoWeightage[$i].')</td>';
                            $i++;
                        }
                        echo '<td  rowspan="2" >Total('.$weightage.')</td>';
                   echo '</tr>';
                   
                   echo '<tr>';
                            $i=0;
                        while($i < count($compoCount)){
                            $j=1;
                            while($j <= $compoCount[$i]){
                                echo '<td >'.str_pad($j, 2, '0', STR_PAD_LEFT).'</td>';
                                $j++;
                            }
                                echo '<td >Avg</td>';
                                $i++;
                        }
                   echo '</tr>';
                   
                   $prevRoll=-1;
                   $compoTotal=0;
                   $compoCnt=0;
                   $total=0;
                   $query="select c.*,s.name,s.batch,t.weightage,t.compo_nos from CA c natural join Student s natural join TwCompoWeight t where c.course_id='".$ucacourse."' and c.year='".$ucayear."' and s.batch in ".$batch." order by rollno asc,compo_nos desc,compo_no asc";         
                   $result=  queryMysql($query);
                    while($row = mysql_fetch_array($result)){
                        
                        if($prevRoll!=$row[rollno]){
                          if($prevRoll!=-1){
                            echo '<td  style="background-color:#66ff66;"><input type="text" class="ctotal" name="'.$prevRoll.'_total" id="'.$prevRoll.'_total" value="'.round($total, 0, PHP_ROUND_HALF_UP).'"  readonly="true"/></td>';
                            echo '</tr>';
                            $total=0;
                            $srCount++;
                          }
                            echo '<tr>';
                            echo '<td >'.$srCount.'</td>';
                            echo '<td  width="6.5%" class="ucarollno">'.$row['rollno'].'</td>';
                            echo '<td >'.$row['name'].'</td>';
                            $prevRoll=$row['rollno'];
                        }
                         
                        if($prevRoll==$row['rollno']){
                         echo '<td >'
                         . '<input type="number" class="ucamarks" min=0 max='.$row['weightage'].'  name="'.$row[rollno].'_'.$row[compo_id].'_'.$row[compo_no].'_marks" id="'.$row[rollno].'_'.$row[compo_id].'_'.$row[compo_no].'_marks" value="'.$row['marks'].'"';
                             if($row['marks']!=NULL || $row['marks']!=""){
                                 echo  ' readonly="readonly"/></td>';
                                  $compoTotal+=intval($row['marks']);
                                  $compoCnt++;
                             }
                            else {
                                echo  '/></td>';
                            }
                            
                            if($row[compo_no]==$row[compo_nos]){
                              echo '<td  width="4%" style="background-color:lightsalmon;"><input type="text" name="'.$row[rollno].'_'.$row[compo_id].'_avg" id="'.$row[rollno].'_'.$row[compo_id].'_avg" value="'. round(($compoTotal/$compoCnt),2,PHP_ROUND_HALF_UP).'" readonly="true"/></td>';                
                              $total+=($compoTotal/$row[compo_nos]);
                              $compoTotal=0;
                              $compoCnt=0;
                            } 
                        }  
                    }
                    echo '<td  width="3%" style="background-color:#66ff66;"><input type="text" class="ctotal" name="'.$prevRoll.'_total" id="'.$prevRoll.'_total" value="'.round($total, 0, PHP_ROUND_HALF_UP).'" readonly="true"/></td>';
                    echo '</tr>';   
                    echo '<tr>';
                    echo '<td  colspan="'.$columns.'"> <input type="submit"  value="Update"/></td>';
                    echo '</tr>';  
                    echo '</table>';
                    echo '</form></div>';                   
             }
         }
         else
             echo '<span class="error">DATA NOT POSTED</span>';
      
     }
     else echo'<span class="error">Please sign up and/or login to use the system</span>';
        
     require_once 'functions/footer.php';
?>
