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
*   Created On: 23 Jun, 2015, 8:31:28 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
if($loggedin){        
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='2'||$_SESSION['grid']==='6'){

echo <<<_END
        <div id="right">
_END;
if($_POST){
    if(isset($_POST['year'])&& isset($_POST['sem'])&& isset($_POST['dept'])&& isset($_POST['rollno'])){
        $year=$_POST['year'];
        $sem=$_POST['sem'];
        $dept=$_POST['dept'];
        $rollno=$_POST['rollno'];
        
        $semtype=  explode(" ", $year);
        $semtype=$semtype[0];
        echo '<div id="wrapper" style="scrollwrapper">';
        echo '<span class="fit-title-blackgrad">Personal Information</span>';
        $result=  queryMysql("select * from Student where rollno='".$rollno."'");
        if(mysql_num_rows($result)==0){
            echo '<br><span class="error">No Records Found!</span>';
        }
        else {
            echo '<div id="studinfo">';
            while ($row = mysql_fetch_array($result)) {
                echo '<b>Roll No. : </b>'.$row['rollno'].'<br><br>';
                echo '<b>Name : </b>'.$row['name'].'<br><br>';
                echo '<b>Semester : </b>'.$row['sem'].'<br><br>';
                echo '<b>Department : </b>'.$row['dept'].'<br><br>';
                echo '<b>Address : </b>'.$row['address'].'<br><br>';
                echo '<b>Date of Addmission : </b>'.$row['doa'].'<br><br>';
                echo '<b>Date of Birth : </b>'.$row['dob'].'<br><br>';
                echo '<b>Phone Number : </b>'.$row['phoneno'].'<br><br>';
                echo '<b>Parent Phone Number : </b>'.$row['pphoneno'].'<br><br>';
                echo '<b>Year : </b>'.$row['year'].'<br><br>';
                echo '<b>Batch : </b>B'.$row['batch'].'<br><br>';
            }
        
            echo '</div>';
        }
        echo '<span class="fit-title-blackgrad">Continous Assessment Information</span>';
       // echo '<div>';
        $query="select c.*,cs.abbrv,t.weightage,t.compo_nos from CA c natural join Course cs natural join TwCompoWeight t where c.rollno='".$rollno."' and c.year='".$year."' order by abbrv asc,compo_nos desc,compo_no asc";         
        $result=  queryMysql($query);
        if(mysql_num_rows($result)==0){
            echo '<br><span class="error">No Records Found!</span><br>';
        }
        else {
            $prevCourse=NULL;
            $prevCompoCount=-1;
            $compoTotal=0;
            $srCount++;
            $compoCount=1;
            echo '<table id="studca" cellspacing=0 cellpadding=0 border=1 style="border-radius:2px;font-size:14pt;">';
            while($row = mysql_fetch_array($result)){
                if($prevCourse!=$row[course_id]){
                    if($prevCourse!=NULL){
                        echo '<td align="center">T<br>'.round($total, 0, PHP_ROUND_HALF_UP).'</td>';
                        echo '</tr>';    
                        $total=0;
                        $srCount++;
                        $compoCount=1;
                    }
                    echo '<tr>';
                    echo '<td align="center">'.$srCount.'</td>';
                    echo '<td align="center">'.$row['abbrv'].'</td>';
                
                    $prevCourse=$row['course_id'];
                }
                         
                if($prevCourse==$row['course_id']){
                    if($prevCompoCount!=$compoCount){
                        echo '<td align="center">C'.$compoCount.'</td>';    
                        $prevCompoCount=$compoCount;
                    }
                    echo '<td align="center">'.$row['marks'].'</td>';
                    if($row['marks']!=NULL){
                                  $compoTotal+=$row['marks'];
                    }
                            
                    if($row[compo_no]==$row[compo_nos]){
                        echo '<td align="center">A<br>'.number_format(($compoTotal/$row[compo_nos]),2).'</td>';                
                        $total+=($compoTotal/$row[compo_nos]);
                        $compoCount++;
                        $compoTotal=0;
                    } 
                }            
            }
            echo '<td align="center">T<br>'.round($total, 0, PHP_ROUND_HALF_UP).'</td>';
            echo '</tr>';
            echo '</table>';
        }
            echo '<span class="fit-title-redgrad">Test Marks</span>';
            $result=  queryMysql("select count(course_id) as c from Course where sem='".$sem."' and dept='".$dept."'");
            while ($row=  mysql_fetch_array($result)){$ccount=  intval($row['c']);}
            $columns=$ccount*3;
            $query="select * from (
                select t1.rollno,t1.name,t1.course_id,t1.abbrv,t2.year,t2.t1,t2.t2 from 
                    (select rollno,name,course_id,abbrv from Student s, 
                        (select course_id,abbrv from Course where dept='".$dept."' and sem='".$sem."') as c where s.dept='".$dept."' and s.sem='".$sem."' and s.year='".$year."' and s.rollno in
                            (select rollno from Test where year='".$year."' and course_id in
                                (select course_id from Course where dept='".$dept."' and sem='".$sem."'))) as t1 left join (select * from Test where year='".$year."') as t2 on t1.course_id=t2.course_id and t1.rollno=t2.rollno)"
                    . "as Temp where rollno='".$rollno."'";
 //       echo '<br>'.$query;
            $result=  queryMysql($query);
            if(mysql_num_rows($result)==0)
            {
                echo '<br><span class="error">No Records Found</span><br>';
            //die();
            }
            else{
                echo '<table id="studca" cellspacing=0 cellpadding=4 border=1 style="border-radius:2px;">';    
                $res=  queryMysql("select abbrv from Course where dept='".$dept."' and sem='".$sem."'");
                    echo '<tr>';
                        while ($row = mysql_fetch_array($res)) {
                            $abbrv=$row['abbrv'];
                            echo '<th align="center" colspan="3">'.$abbrv.'</th>';
                        }
                    echo '</tr>';
                    echo '<tr>';
                    $i=1;
                    while ($i<=$ccount) {
                        echo '<th align="center">T-1</th>';
                        echo '<th align="center">T-2</th>';
                        echo '<th align="center">AGG</th>';
                        $i++;
                    }
                    echo '</tr>';
                    echo '<tr>';
                    $prevRoll=-1;
                    while($row=  mysql_fetch_array($result)){
          
                        echo '<td align="center"';
                        if(intval($row[t1])<8){
                            echo ' style="background-color:red;" ';
                        }
                        echo '>'.$row['t1'].'</td>';
            
                         echo '<td align="center"';
                        if(intval($row[t2])<8){
                            echo ' style="background-color:red;" ';
                        }
                        echo '>'.$row['t2'].'</td>';
                        $agg= round((intval($row[t1])+intval($row[t2]))/2,0,PHP_ROUND_HALF_UP);
                        echo '<td align="center"';
                        if($agg<8){
                            echo ' style="background-color:red;" ';
                        }
                        echo '>'.$agg.'</td>';
            
                    }
                    echo '</tr>';
                echo '</table>';
            }
        
        //Defaulter Information
        
        echo '<span class="fit-title-redgrad">Attendence</span>';
        $link = mysqli_connect($db_host,$db_user,$db_password,$db_name);
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $query="select abbrv from Course where dept='".$dept."' and sem='".$sem."' order by abbrv";
        $result= queryMysql($query);
        $num_rows= mysql_num_rows($result);
        $i=$num_rows;
        $columns=3*$i+5;
      
        if($num_rows==0)
        {
            echo '<br><span class="error">No Records Found</span><br>';
        }
        else {
            
            echo '<table  id="studca" cellspacing="0" cellpadding="4" border="1" style="border-radius:2px;">';
                echo '<tr colspan="'.$columns.'">';
             
            while($row = mysql_fetch_array($result)){
                echo '<th colspan="3" align="center"><b>'.$row["abbrv"].'</b></th>';
            }
                    echo '<th rowspan="2"><b>AVG</b></th>';
                    echo '<th rowspan="2"><b>REMARK</b></th>';
                echo '</tr>';
                echo '<tr>';
                    while($i!=0){
                        echo '<th>PR</th><th>TH</th><th>AG</th>';
                        $i--;
                    }
             
                echo '</tr>';
        }
        if($semtype=="First"){
            $dfmonth=1;$dtmonth=6;}
        else{
            $dfmonth=7;$dtmonth=12;}
        
        
        $query="SET SQL_SAFE_UPDATES = 0;

create temporary table s1 as
(Select t.rollno,s.name,t.course_id,c.abbrv,s.batch from Student s,Course c,Takes t where t.course_id in
(select course_id from Course where dept='".$dept."' and sem='".$sem."') and t.rollno=s.rollno and t.course_id=c.course_id and
t.rollno in (Select rollno from Student where dept='".$dept."' and sem='".$sem."' and year='".$year."'));

create temporary table t1 as
(SELECT sum(t.no_of_lecture)'engaged',c.course_id,THorPR,batch from `Th_Pr-Record` t,
Course c where year='".$year."' AND extract(month from dop) between '".$dfmonth."' and '".$dtmonth."' 
AND t.course_id in (select course_id from Course where dept='".$dept."' and
sem='".$sem."') and t.course_id=c.course_id group by c.course_id, THorPR,batch);

create temporary table tpr1 as(select THorPR, course_id,batch from Teaches 
where course_id in (select course_id from Course where dept='".$dept."' and
sem='".$sem."') and year='".$year."');

create temporary table record as
(select tpr1.*,t1.engaged from tpr1 left join t1 on
 t1.course_id=tpr1.course_id and t1.THorPR=tpr1.THorPR and t1.batch=tpr1.batch);

create temporary table TempList as(select * from
(select s1.rollno,s1.name,s1.abbrv,r.* from s1  right join record r on s1.course_id=r.course_id and s1.batch=r.batch)
 as t where rollno is not null);

insert into TempList select * from (select s1.rollno,s1.name,s1.abbrv,r.* from s1  right join record r on s1.course_id=r.course_id and s1.batch!=r.batch and r.batch not in (1,2,3,4))as t where rollno is not null;
                
create temporary table AbsentList as
(SELECT count(a.rollno)'absent',a.rollno,a.course_id,a.THorPR,a.batch from Absentee a,Course c 
where a.year='".$year."' AND extract(month from a.dol) between '".$dfmonth."' and '".$dtmonth."' 
AND a.course_id in (select course_id from Course where dept='".$dept."' and
sem='".$sem."') and a.course_id=c.course_id group by a.course_id,a.THorPR,a.batch,a.rollno);

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
 
select * from DefaulterList where rollno='".$rollno."'order by course_id,THorPR;

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
                     
                      $prevCourse=-1;
                      $avgCounter=2;
                      $avgPerSub=0;
                      $avgTotal=0;
                      $srCount=0;
                      $prevPercent=-1;
                      $prevTHorPR=-1;
                    
                    while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
                      $remark="ALLOWED";
                      
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
                    echo 'Unable to Execute the Query:'.
                "\nRecieved following error". mysqli_error($link);
                die();
                
               }
               echo '</table>';
               echo '</div>';
               echo '</div>';
    }
}
else{
    echo '<br>center><span class="error">Data Not Posted</span></center>';
        header("Refresh: 0; url=index.php");
}
}
 else {
      echo '<br><br><center><span class="error">Access Denied! You are not authorized to view this section</span></center>';    
 }

}

 else echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';
require_once 'functions/footer.php';