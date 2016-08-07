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

include('../mpdf/mpdf.php');
require_once 'functions/header.php';
if($loggedin){
if($_POST){
    if(isset($_POST['dyear'])&& isset($_POST['ddept'])&& isset($_POST['dsem'])
            && isset($_POST['dfmonth'])&& isset($_POST['dtmonth'])&& isset($_POST['dcutoff'])){
        $dyear=$_POST['dyear'];
        $ddept=$_POST['ddept'];
        $dsem=$_POST['dsem'];
        $dfmonth=$_POST['dfmonth'];
        $dtmonth=$_POST['dtmonth'];
        $dcutoff=$_POST['dcutoff'];
        
        $link = mysqli_connect($db_host,$db_user,$db_password,$db_name);
        if (mysqli_connect_errno()) {
           printf("\nConnect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $query="select abbrv from Course where dept='".$ddept."' and sem='".$dsem."' and course_id in"
                . "(select distinct(course_id) from Teaches where year='".$dyear."') order by course_id";
        $result= queryMysql($query);
        $num_rows= mysql_num_rows($result);
        $i=$num_rows;
        $columns=3*$i+8;
      
        if($num_rows==0)
        {
            echo '<br><center><span class="error">No Records Found</span></center>';
            die();
        }
        else {
            ob_start();
            echo '<div id="wrapper" style="overflow-x:auto;">';
             echo '<form method="post" id="form1">';
             echo '<center>';  
             echo '<table  id="pdfTable" cellspacing="0" cellpadding="4" border="1" style="background:transparent;text-align:center;">';
             echo '<tr rowspan="3"><td colspan="2" align="center"><img src="images/college_logo.jpg" ></td>'.
                      '<td colspan="'.($columns-2).'" align="center"><h3 align="center">'.$colname.'</h3></td></tr>';
             echo '<tr colspan="'.$columns.'" align="center"><td colspan="'.$columns.'" align="center">'
                     . '<pre><b>Department:'.$ddept.'  Sem:'.$dsem.'   Year:'.$dyear.'  Month(s): '.date('F', strtotime("0000-$dfmonth-01")).', '.date('Y').' to '.date('d F, Y').'</b></pre></td></tr>';
             echo '<tr colspan="'.$columns.'">';
             echo '<th rowspan="2" align="center">Sr.No.</th>';
             echo '<th rowspan="2" align="center">Roll No</th>';
             echo '<th rowspan="2" align="center">Name of Students</th>';
             
    while($row = mysql_fetch_array($result)){
             echo '<th colspan="3" align="center">'.$row["abbrv"].'</th>';
             }
             echo '<th rowspan="2">AVG</th>';
             echo '<th rowspan="2">REMARK</th>';
             echo '</tr>';
             echo '<tr>';
             while($i!=0){
             echo '<th>PR</td><th>TH</th><th>AG</th>';
             $i--;
             }
             
             echo '</tr>';
        }
         $query="SET SQL_SAFE_UPDATES = 0;

create temporary table s1 as
(Select t.rollno,s.name,t.course_id,c.abbrv,s.batch from Student s,Course c,Takes t where t.course_id in
(select course_id from Course where dept='".$ddept."' and sem='".$dsem."') and t.rollno=s.rollno and t.course_id=c.course_id and
t.rollno in (Select rollno from Student where dept='".$ddept."' and sem='".$dsem."' and year='".$dyear."'));

create temporary table t1 as
(SELECT sum(t.no_of_lecture)'engaged',c.course_id,THorPR,batch from `Th_Pr-Record` t,
Course c where year='".$dyear."' AND extract(month from dop) between '".$dfmonth."' and '".$dtmonth."' 
AND t.course_id in (select course_id from Course where dept='".$ddept."' and
sem='".$dsem."') and t.course_id=c.course_id group by c.course_id, THorPR,batch);

create temporary table tpr1 as(select THorPR, course_id,batch from Teaches 
where course_id in (select course_id from Course where dept='".$ddept."' and
sem='".$dsem."') and year='".$dyear."');

create temporary table record as
(select tpr1.*,t1.engaged from tpr1 left join t1 on
 t1.course_id=tpr1.course_id and t1.THorPR=tpr1.THorPR and t1.batch=tpr1.batch);

create temporary table TempList as(select * from
(select s1.rollno,s1.name,s1.abbrv,r.* from s1  right join record r on s1.course_id=r.course_id and s1.batch=r.batch)
 as t where rollno is not null);

insert into TempList select * from (select s1.rollno,s1.name,s1.abbrv,r.* from s1  right join record r on s1.course_id=r.course_id and s1.batch!=r.batch and r.batch not in (1,2,3,4))as t where rollno is not null;
                
create temporary table AbsentList as
(SELECT count(a.rollno)'absent',a.rollno,a.course_id,a.THorPR,a.batch from Absentee a,Course c 
where a.year='".$dyear."' AND extract(month from a.dol) between '".$dfmonth."' and '".$dtmonth."' 
AND a.course_id in (select course_id from Course where dept='".$ddept."' and
sem='".$dsem."') and a.course_id=c.course_id group by a.course_id,a.THorPR,a.batch,a.rollno);

create temporary table DefaulterList as 
(select t.*,a.absent from TempList t left join AbsentList a on t.rollno=a.rollno and
t.course_id=a.course_id and t.THorPR=a.THorPR);

update DefaulterList set engaged=0
where engaged is NULL;

update DefaulterList set absent=0
where absent is NULL;

alter table DefaulterList add column (attended int,percent numeric(3)); 

update DefaulterList set attended=engaged-absent,
percent=ceil((attended/engaged)*100); 

update DefaulterList set percent=0 
where percent is NULL;
                
update DefaulterList set percent=100 
where engaged=0;
 
select * from DefaulterList order by rollno,course_id,THorPR;

drop table s1;
drop table t1;
drop table tpr1;
drop table record;
drop table TempList;
drop table AbsentList;
drop table DefaulterList;

SET SQL_SAFE_UPDATES = 1;";
     
                /* execute multi query */
                
                if (mysqli_multi_query($link, $query)) {
                   
                do {
                /* store first result set */
                 if ($result = mysqli_store_result($link)) {
                     
                      $prevRoll=-1;
                      $prevCourse=-1;
                      $prevName=NULL;
                      $avgCounter=2;
                      $avgPerSub=0;
                      $avgTotal=0;
                      $srCount=0;
                      $prevPercent=-1;
                      $prevTHorPR=-1;
                    
                    while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
                      $remark="ALLOWED";
                      
                      if($prevRoll==-1)
                      {
                        $srCount++;
                        echo '<tr>';
                        echo '<td align="center">'.$srCount.'</td>';
                        echo '<td align="center">'.$row["rollno"].'</td>';
                        echo '<td><font size="1">'.$row["name"].'</font></td>'; 
                        $prevRoll=$row["rollno"];
                        $prevName=$row["name"];
                      }
                      else
                      {
                          if($row[rollno]!=$prevRoll)
                          {
                              if($avgCounter==1){
                                echo '<td align="center">'.$prevPercent.'</td>';
                                $avgPerSub +=$prevPercent;
                                $avgTotal +=$prevPercent;
                                $avgPerSub=  round($avgPerSub/=2, 0, PHP_ROUND_HALF_UP);
                                echo '<td align="center">'.$avgPerSub.'</td>';
                                $avgPerSub =0;
                                $avgCounter=2;                           
                              }
                              $avgTotal=  round($avgTotal/=($num_rows*2),0,PHP_ROUND_HALF_UP);
                              echo '<td>'.$avgTotal.'</td>';
                              if($avgTotal<$dcutoff)
                              {$remark="DEFAULTER";}
                              echo '<td>'.$remark.'</td>';
                              echo '</tr>';
                              $avgTotal=0;
                              echo '<tr>';
                              $srCount++;
                              echo '<td align="center">'.$srCount.'</td>';
                              echo '<td align="center">'.$row["rollno"].'</td>';
                              echo '<td><font size="1">'.$row["name"].'</font></td>';
                              $prevRoll=$row["rollno"];
                              $prevName=$row["name"];
                          }
                      }
                      if($avgCounter!=0)
                      {
                         if($avgCounter==1 && $prevCourse!=$row[course_id]){
                            echo '<td align="center">'.$prevPercent.'</td>';
                            $avgPerSub +=$prevPercent;
                            $avgTotal +=$prevPercent;
                            $avgPerSub=  round($avgPerSub/=2, 0, PHP_ROUND_HALF_UP);
                            echo '<td align="center">'.$avgPerSub.'</td>';
                            $avgPerSub =0;
                            $avgCounter=2;                           
                         }
                          echo '<td align="center">'.$row[percent].'</td>';
                          $avgPerSub +=$row["percent"];
                          $avgTotal +=$row["percent"];
                          $avgCounter--;
                      }
                      
                      if($avgCounter==0)
                      {
                          $avgPerSub=  round($avgPerSub/=2, 0, PHP_ROUND_HALF_UP);
                          echo '<td align="center">'.$avgPerSub.'</td>';
                          $avgPerSub =0;
                          $avgCounter=2;
                          
                      }
                  
                       $prevRoll=$row["rollno"];
                       $prevCourse=$row["course_id"];
                       $prevPercent=$row['percent'];
                       $prevTHorPR=$row['THorPR'];
                          
                       
                    }
                    if($avgCounter==1){
                            echo '<td align="center">'.$prevPercent.'</td>';
                            $avgPerSub +=$prevPercent;
                            $avgTotal +=$prevPercent;
                            $avgPerSub=  round($avgPerSub/=2, 0, PHP_ROUND_HALF_UP);
                            echo '<td align="center">'.$avgPerSub.'</td>';
                            $avgPerSub =0;
                            $avgCounter=2;                           
                    }
                    $avgTotal/=($num_rows*2);
                    $avgTotal =  round($avgTotal,0,PHP_ROUND_HALF_UP);
                    echo '<td>'.$avgTotal.'</td>';
                    if($avgTotal<$dcutoff)
                    {$remark="DEFAULTER";}
                    echo '<td>'.$remark.'</td>';
                    echo '</tr>';
                    mysqli_free_result($result);
                   }
                    else {
                      // echo 'No Corresponding Records are found!';
                   }              
                /* print divider */
               if (mysqli_more_results($link)) {
                /*intentionally leaved blank*/
                }
                } while (mysqli_next_result($link));
               }
               else {
                    echo '<br>Unable to Execute the Query:'.
                "\nRecieved following error". mysqli_error($link);
                die();
                
               }
          
                date_default_timezone_set("Asia/Kolkata");
                echo '<tr><td colspan="'.$columns.'" align="center"><pre>';
                echo 'Report Generated on: '.date("d/m/Y").' at  '.date("h:i:sa").'  by- '.$appname.'-Account-'.$user.'</td></tr>';

                echo '</table>';
                   echo '<input type="button" width="100%" class="button" name="generatepdf" id="generatepdf" value="Generate PDF"/>';
                   echo '<input type="hidden" id="filename" name="filename" value="Defaulter-List-'.$ddept.'-'.$dsem.'-'.$dyear.'"/>';
                   echo '<input type="hidden" id="page" name="page" value=""/>';
                   echo '<input type="hidden" id="orientation" name="orientation" value="L"/>';
                   echo '<input type="hidden" id="style" name="style" value="0"/>';
                
                echo '</center>';   
                echo '</form></div>';
                echo '<br>';
     //           exit;
                
               /* close connection */
                mysqli_close($link);     
            }
    }

    else {
        echo '<br>center><span class="error">Data Not Posted</span></center>';
        header("Refresh: 0; url=index.php");
    }
}
 else {
    echo'<br><br><span class="error">Please sign up and/or login to use the system</span>';
    header('Refresh:1 ,url=login.php');
}
require_once 'functions/footer.php';
?>