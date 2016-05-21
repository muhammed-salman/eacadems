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
updatePracPlan();
     if($loggedin){
         if($_POST){
             if(isset($_POST[uppyear])&& isset($_POST[uppsub])){
                $uppyear=$_POST['uppyear'];
                $uppsub=$_POST['uppsub'];
                $uppfac_id=$_POST['ffac_id'];
                $uppdept=NULL;
                $upptitle=NULL;
                $uppsem=NULL;
                $uppabbrv=NULL;
                $batchCount=0;
                $query="select c.title,c.dept,d.name,c.sem,c.abbrv from Course c join Department d on c.dept=d.dept_id where c.course_id='".$uppsub."'";                
                if(!mysql_query($query)){
                    echo "<span class='error'>Unable to retrive department : ".  mysql_error()."</span>";
                    die();
                }
                else {
                    $result=mysql_query($query);
                    while ($row = mysql_fetch_array($result)) {
                        $uppdept=$row['name'];
                        $upptitle=$row['title'];
                        $uppsem=$row['sem'];
                        $uppabbrv=$result['abbrv'];
                    }
                }
                $result=  queryMysql("SELECT distinct(batch) FROM Teaches where fac_id='".$uppfac_id."'and course_id='".$uppsub."' and year='".$uppyear."' and THorPR=0 and batch!=0");
                if(mysql_num_rows($result)==0){
                    echo "<span class='error'>No Records Found!</span>";
                    die();
                }
                else {
                    $batchCount=  mysql_num_rows($result);
                    $batch="(";
                    while($row=  mysql_fetch_array($result)){$batch.=$row['batch'].",";}
                    $batch.="0)";
                }
                $columns=2*$batchCount+2;
                
                 echo '<div class="scrollwrapper">';
                echo '<form method="post" id="form1" onsubmit="return confirm(\'Are you sure you want to update Practical Plan.You will not be able to modify entered data later.\')">';
                ob_start();
                  echo '<table id="pdfTable" cellspacing="0" width="100%" cellpadding="2" border="1">';
                    echo '<tr rowspan="3"><td colspan="1" align="center"><img src="images/college_logo.jpg" ></td>'.
                            '<td colspan="'.($columns-1).'" align="center"><h3 align="center">'.$colname.'</h3></td></tr>';
                    echo '<th align="center" colspan="'.$columns.'">Practical Plan</th>';
                    echo '<tr align="center"><td colspan="'.$columns.'"><pre>Department:'.$uppdept.'   Course Title:'.$upptitle.'    Course Code:'.$uppsub.'    Semester:'.$uppsem.'    Year:'.$uppyear.'</pre></td></tr>';
                    
                    echo '<tr>';
                        echo '<td align="center" rowspan="2" width="3%">EXP NO.</td>';
                        echo '<td align="center" rowspan="2" width="44%">Title</td>';
                        $result=  queryMysql("SELECT distinct(batch) FROM Teaches where fac_id='".$uppfac_id."'and course_id='".$uppsub."' and year='".$uppyear."' and THorPR=0 and batch!=0");
                         while($row = mysql_fetch_array($result)){
                            echo '<td align="center" colspan="2">B'.$row['batch'].'</td>';
                        }
                    echo '</tr>';
                    echo '<tr>';
                        $i=1;
                        while($i<=$batchCount){
                            echo '<td align="center">P.D</td>';
                            echo '<td align="center">D.O.P</td>';
                            $i++;
                        }
                    echo '</tr>';
                
                    $query="select * from PracPlan where course_id='".$uppsub."' and year='".$uppyear."' and batch in "
                            .$batch." order by expno asc,batch asc";
                
                    if(!mysql_query($query)){
                        echo "<span class='error'>Unable to retrive records : ".  mysql_error()."</span>";
                    }
                    else {
                        $result=mysql_query($query);
                        $prevExp=NULL;
                        while ($row = mysql_fetch_array($result)) {
                            if($prevExp==NULL)
                            {
                              
                             echo '<tr>';
                                echo '<td align="center" width="3%"> <input type="text" name="expno_'.$row["expno"].'" style="width:100%; border: 0; background: transparent; text-align: center;" value="'.$row['expno'].'" readonly="readonly" /></td>';
                                echo '<td align="center" width="44%"> <textarea name="title_'.$row["expno"].'" style="width:100%; margin:0; font-size:12pt;';
                                if($row['title']!=NULL){
                                    echo  ' background: transparent;" class="readonlytextarea" readonly="readonly">'.$row["title"].'</textarea></td>';
                                }
                                else {
                                    echo  ' background: white;">'.$row["title"].'</textarea></td>';
                                }
                                $prevExp=$row['expno'];
                            }
                            if($prevExp!=$row['expno'] && $prevExp!=NULL )
                            {
                             echo '</tr>';
                             echo '<tr>';
                                echo '<td align="center" width="3%"> <input type="text" name="expno_'.$row["expno"].'" style="width:100%; border: 0; background: transparent; text-align: center;" value="'.$row['expno'].'" readonly="readonly" /></td>';
                                echo '<td align="center" width="44%"> <textarea name="title_'.$row["expno"].'" style="width:100%; margin:0; font-size:12pt;';
                                if($row['title']!=NULL){
                                    echo  ' background: transparent;" class="readonlytextarea" readonly="readonly">'.$row["title"].'</textarea></td>';
                                }
                                else {
                                    echo  ' background: white;">'.$row["title"].'</textarea></td>';
                                }
                                $prevExp=$row['expno'];
                            }
                            if($prevExp==$row['expno']){
                                echo '<td align="center"> <input type="text"  name="pd_'.$row["batch"].$row["expno"].'" readonly="true" style="width:100%; border: 0; text-align: center;';
                                if($row['pd']!=NULL){
                                    echo  ' background: transparent;" value="'.date('d/m/Y',  strtotime($row['pd'])).'" /></td>';
                                }
                                else {
                                    echo  '" class="datepicker" value="" /></td>';
                                }
                                echo '<td align="center"> <input type="text" name="dop_'.$row["batch"].$row["expno"].'" readonly="true" style="width:100%; border: 0; text-align: center;';
                                if($row['dop']!=NULL){
                                    echo  ' background: transparent;" value="'.date('d/m/Y',  strtotime($row['dop'])).'" /></td>';
                                }
                                else {
                                    echo  '" class="datepicker" value=""/></td>';
                                }
                            }
                        
                    }
                    echo '</tr>';
                }
                   $query="select name from Faculty where fac_id='".$uppfac_id."'";
                   $result=mysql_query($query);
                   $row=  mysql_fetch_array($result);
                   echo '<tr>';
                   echo '<td align="center" colspan='.$columns.'><pre>Faculty Name and Sign: '.$row['name'];
                   $query="select f.name from Faculty f,Department d where f.fac_id=d.hod";
                   $result=mysql_query($query);
                   $row=  mysql_fetch_array($result);
                   echo '  | Report Generated on: '.date("d/m/Y").' at  '.date("h:i:sa").' by- '.$appname.'-Account-'.$user.' | HOD Name & Sign: ';
                   echo ''.$row['name'].'</pre></td>';
                   echo '</tr>';
                   echo '</table>';
                   
                   echo '<input type="hidden" id="uppcourse" name="uppcourse" value="'.$uppsub.'"/>';
                   echo '<input type="hidden" id="uppyear" name="uppyear" value="'.$uppyear.'"/>';
                   echo '<input type="hidden" id="uppfac_id" name="uppfac_id" value="'.$uppfac_id.'"/>';
                   echo '<input type="hidden" id="batch" name="batch" value="'.$batch.'"/>';
                   echo '<input type="hidden" id="uppsub" name="uppsub" value="'.$uppsub.'"/>';
                   echo '<input type="hidden" id="ffac_id" name="ffac_id" value="'.$uppfac_id.'"/>';
      //             echo '<input type="hidden" id="orientation" name="orientation" value="P"/>';
                   echo '<table width="100%" cellspacing="0" cellpadding="2" border="0" bgcolor="#00eeee"> <tr>';
                   echo '<td width="50%" align="center"><input type="button" width="100%" class="button" name="updateppb" id="updateppb" value="Update Plan" /></td>';
                   echo '<td width="50%" align="center"><input type="button" width="100%" class="button" name="viewprint" id="viewprint" onclick="submitForm(\'printpp.php\')" value="View in Printable Format"></td>';
                   echo '</tr></table>';
                 echo '';
                echo '</form>';
                
             }
         }
         else
             echo '<span class="error">DATA NOT POSTED</span>';
      
     }
     else echo'<span class="error">Please sign up and/or login to use the system</span>';
     
require_once 'functions/footer.php';
?>
          