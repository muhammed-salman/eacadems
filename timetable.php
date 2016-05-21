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
*   Author: MUhammed Salman Shamsi
*/

include('../mpdf/mpdf.php');

require_once 'functions/header.php'; 
        
if($_POST){

if( isset($_POST['ltdept'])&& isset($_POST['ltsem']) && isset($_POST['ltyear'])){
$ltdept=$_POST['ltdept'];
$ltsem=$_POST['ltsem'];
$ltyear=$_POST['ltyear'];
echo '<form method="post" id="form1" action="ajax_pdf.php">';
        echo '<div id="pdfdiv">';
ob_start();
 echo '<center>';
 
 echo '<table id="pdfTable" width="100%" cellspacing="0" cellpadding="4" border="1" bgcolor="WHITE" style="overflow:wrap; border: 1px solid black;border-collapse:collapse;">';
        echo '<tr rowspan="3"><td colspan="1" align="center"><img src="images/college_logo.jpg" ></td>'.
                '<td colspan="10" align="center"><h3 align="center">'.$colname.'</h3></td></tr>';
        echo '<tr>';
                 echo '<td colspan="11" align="center"><pre><b>Department: '.$ltdept.'      Semester: '.$ltsem.'      Year: '.$ltyear.'</b></pre></td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td align="center">Time Slot</td>';
            $res=mysql_query("select * from TimeSlot");
            if(!$res)    
             {
                 echo 'Unable to Execute the Query:'.$sql_query.
                    "\nRecieved following error".mysql_error();
                 die();
             }
             while($row = mysql_fetch_array($res)){
                echo '<td align="center">';
                echo ''.$row["timeslot_id"]."<br/>".$row["start_time"];
                echo '</td>';    
             }
        echo '</tr>';

echo <<<    _END
           <tr>
_END;
$day_arr= array("MON","TUE","WED","THU","FRI");
$n=  count($day_arr);
$i=0;
$prevDayCount=-1;
while($i<$n){
    $query="select timeslot_id,c.abbrv,day,t.class_id,t.THorPR, cr.classroom from TimeTable t natural join ClassRoom cr "
        . "natural join Course c "
        . "where t.dept='".$ltdept."' and t.sem='".$ltsem."' and t.year='".$ltyear."' and "
        . "day='".$day_arr[$i]."' order by timeslot_id";

    $result= queryMysql($query);
    $ttcolumns=11;

    $colCount=0;
    $cellColor="inherit";
    $colspan=1;
    $colinc=1;
    $prevAbbrv=NULL;
    $prevType=NULL;
    $prevTimeSlot=0;
    
    echo '<tr>';
    echo '<td align="center">'.$day_arr[$i].'</td>';
        
    while($row = mysql_fetch_array($result)){
        if($row[THorPR]==1){
            $type="TH";
            $cellColor="inherit";
            $colspan=1;
            $colinc=1;
        }
        else {
            $type="PR";
            $cellColor="yellow";
            $colspan=2;
            $colinc=2;
        }
        
        
      if(!($prevAbbrv==$row[abbrv] && $prevType=$type && $prevType=="PR")){  
        
            if($row['timeslot_id']==1)
            {
                echo '<td align="center" colspan="'.$colspan.'" style="background-color:'.$cellColor.';">'.$row['abbrv'].'<br>'.$type.'<br>'.$row['class_id'].'-'.$row['classroom'].'</td>';
                $colCount+=$colinc;
            }
            elseif ($row['timeslot_id']==2) {
                if($colCount<1){
                    echo '<td></td>';
                    $colCount+=$colinc;
                }
                echo '<td align="center" colspan="'.$colspan.'" style="background-color:'.$cellColor.';">'.$row['abbrv'].'<br>'.$type.'<br>'.$row['class_id'].'-'.$row['classroom'].'</td>';
                $colCount+=$colinc;
            }
            elseif ($row['timeslot_id']==3) {
                while ($colCount<2){
                    echo '<td></td>';
                    $colCount+=$colinc;
                }
                echo '<td align="center" colspan="'.$colspan.'" style="background-color:'.$cellColor.';">'.$row['abbrv'].'<br>'.$type.'<br>'.$row['class_id'].'-'.$row['classroom'].'</td>';
                $colCount+=$colinc;
            }
            elseif ($row['timeslot_id']==4) {
                while ($colCount<3){
                    echo '<td></td>';
                    $colCount+=$colinc;
                }
                echo '<td align="center" colspan="'.$colspan.'" style="background-color:'.$cellColor.';">'.$row['abbrv'].'<br>'.$type.'<br>'.$row['class_id'].'-'.$row['classroom'].'</td>';
                $colCount+=$colinc;
            }
            elseif ($row['timeslot_id']==5) {
                while ($colCount<4){
                    echo '<td></td>';
                    $colCount+=$colinc;
                }
                echo '<td align="center" colspan="'.$colspan.'" style="background-color:'.$cellColor.';">'.$row['abbrv'].'<br>'.$type.'<br>'.$row['class_id'].'-'.$row['classroom'].'</td>';
                $colCount+=$colinc;
            }
            elseif ($row['timeslot_id']==6) {
                while ($colCount<5){
                    echo '<td></td>';
                    $colCount+=$colinc;
                }
                echo '<td align="center" colspan="'.$colspan.'" style="background-color:'.$cellColor.';">'.$row['abbrv'].'<br>'.$type.'<br>'.$row['class_id'].'-'.$row['classroom'].'</td>';
                $colCount+=$colinc;
            }
            elseif ($row['timeslot_id']==7) {
                while ($colCount<6){
                    echo '<td></td>';
                    $colCount+=$colinc;
                }
                echo '<td align="center" colspan="'.$colspan.'" style="background-color:'.$cellColor.';">'.$row['abbrv'].'<br>'.$type.'<br>'.$row['class_id'].'-'.$row['classroom'].'</td>';
                $colCount+=$colinc;
            }
            elseif ($row['timeslot_id']==8) {
                while ($colCount<7){
                    echo '<td></td>';
                    $colCount+=$colinc;
                }
                echo '<td align="center" colspan="'.$colspan.'" style="background-color:'.$cellColor.';">'.$row['abbrv'].'<br>'.$type.'<br>'.$row['class_id'].'-'.$row['classroom'].'</td>';
                $colCount+=$colinc;
            }
            elseif ($row['timeslot_id']==9) {
                while ($colCount<8){
                    echo '<td></td>';
                    $colCount+=$colinc;
                }
                echo '<td align="center" colspan="'.$colspan.'" style="background-color:'.$cellColor.';">'.$row['abbrv'].'<br>'.$type.'<br>'.$row['class_id'].'-'.$row['classroom'].'</td>';
                $colCount+=$colinc;
            }
            elseif ($row['timeslot_id']==10) {
                while ($colCount<9){
                    echo '<td></td>';
                    $colCount+=$colinc;
                }
                echo '<td align="center" colspan="'.$colspan.'" style="background-color:'.$cellColor.';">'.$row['abbrv'].'<br>'.$type.'<br>'.$row['class_id'].'-'.$row['classroom'].'</td>';
                $colCount+=$colinc;
            }
      }
      $prevAbbrv=$row[abbrv];
      $prevType=$type;
      $prevTimeSlot=intval($row['timeslot_id']);  
    }
    if($prevDayCount!=$i){
        while($prevTimeSlot<10){
            echo '<td><br><br><br></td>';
            $prevTimeSlot++;
        }
    }    
    echo '</tr>';
    $prevDayCount=$i;
    $i++;
}
echo '<tr>';
    echo '<th align="center" colspan="1" rowspan="2">Course</th>  ';
    echo '<th align="center" colspan="2" rowspan="2">Theory</th>';
    echo '<th align="center" colspan="8">Practicals</th>';
echo '</tr>';
echo '<tr>';
    echo '<th colspan="2" align="center">B1</th>';
    echo '<th colspan="2" align="center">B2</th>';
    echo '<th colspan="2" align="center">B3</th>';
    echo '<th colspan="2" align="center">B4</th>';
echo '</tr>';
$res=  queryMysql("select course_id,abbrv from Course where dept='".$ltdept."' and sem='".$ltsem."'");
while ($row = mysql_fetch_array($res)) {
        echo '<tr>';
            echo '<td colspan="1" align="center">'.$row[abbrv].'</td>';
            
            $query="select fac_id,name from Teaches t natural join Faculty f "
                . "where t.year='".$ltyear."' and THorPR=1 and t.course_id='".$row[course_id]."' and batch=0";
            $result=  queryMysql($query);
            while ($row1 = mysql_fetch_array($result)) {
                echo '<td colspan="2" align="center">'.$row1[name].'</td>';
            }
            
            $query="select fac_id,name from Teaches t natural join Faculty f "
                . "where t.year='".$ltyear."' and THorPR=0 and t.course_id='".$row[course_id]."' and batch=1";
            $result=  queryMysql($query);
            while ($row1 = mysql_fetch_array($result)) {
                echo '<td colspan="2" align="center">'.$row1[name].'</td>';
            }
            
            $query="select fac_id,name from Teaches t natural join Faculty f "
                . "where t.year='".$ltyear."' and THorPR=0 and t.course_id='".$row[course_id]."' and batch=2";
            $result=  queryMysql($query);
            while ($row1 = mysql_fetch_array($result)) {
                echo '<td colspan="2" align="center">'.$row1[name].'</td>';
            }
            
            $query="select fac_id,name from Teaches t natural join Faculty f "
                . "where t.year='".$ltyear."' and THorPR=0 and t.course_id='".$row[course_id]."' and batch=3";
            $result=  queryMysql($query);
            while ($row1 = mysql_fetch_array($result)) {
                echo '<td colspan="2" align="center">'.$row1[name].'</td>';
            }
            
            $query="select fac_id,name from Teaches t natural join Faculty f "
                . "where t.year='".$ltyear."' and THorPR=0 and t.course_id='".$row[course_id]."' and batch=4";
            $result=  queryMysql($query);
            while ($row1 = mysql_fetch_array($result)) {
                echo '<td colspan="2" align="center">'.$row1[name].'</td>';
            }
            
        echo '</tr>';
        }
    
date_default_timezone_set("Asia/Kolkata");
echo '<tr><td colspan=11 align="center"><pre>';
echo 'Time Table Generated on: '.date("d/m/Y").' at  '.date("h:i:sa").'  by- '.$appname.'-Account-'.$user.'</td></tr>';
echo '</table>';
echo '<input type="hidden" id="filename" name="filename" value="Time Table-'.$ltdept.'-'.$ltsem.'-'.$ltyear.'"/>';
//echo '<input type="hidden" id="ltsem" name="ltsem" value="'.$ltsem.'"/>' ;
echo '<input type="hidden" id="style" name="style" value="2"/>' ;
echo '<input type="hidden" id="page" name="page" value=""/>';
echo '<input type="hidden" id="orientation" name="orientation" value="L"/>';
echo '<input type="button" class="button" name="generatepdf" id="generatepdf" value="Generate PDF"></td>';
echo '<br><br>';
echo '</center>';
echo '</div>';
echo '</form>';
}
else {
    echo '<br><center><span class="error">Something is not set</span></center>';
}
}
else {
    echo '<br><center><span class="error">POST not done</span></center>';
    header('Location:   index.php');
}

require_once 'functions/footer.php';
?>
