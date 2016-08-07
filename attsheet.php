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
*   Created On: 19 Jun, 2015, 10:15:24 AM
*   Author: Muhammed Salman Shamsi
*/


require_once 'functions/subheader.php';        
if($_POST)
{

if( isset($_POST['dept'])&& isset($_POST['year'])&& isset($_POST['thpr'])&& isset($_POST['course_id']))
{
$dept=$_POST['dept'];
$sem=null;
$year=$_POST['year'];
$thpr=  intval($_POST['thpr']);
$fac_id=$_POST['fac_id'];
$course_id=$_POST['course_id'];
$title=$_POST['title'];
$result=  queryMysql("select sem from Course where course_id='".$course_id."'");
while ($row = mysql_fetch_array($result)) {
    $sem=$row['sem'];
    
}
if($thpr==1)
    $columns=10;
else 
    $columns=15;
if($thpr==0){
    echo '<center>';
    $result=  queryMysql("SELECT distinct(batch) FROM Teaches where course_id='".$course_id."' and year='".$year."' and THorPR=".$thpr." and batch!=0");
    if(mysql_num_rows($result)==0){
        echo "<span class='error'>No Records Found!</span><br>";
        die();
    }
    else {
        $batchCount=  mysql_num_rows($result);
        $batch="(";
        while($row=  mysql_fetch_array($result)){$batch.=$row['batch'].",";}
            $batch.="0)";
    }
}

if($thpr==1){
    $query="select rollno,name,batch from Student where dept='".$dept."' AND sem='".$sem."' AND year='".$year."'";
}
 else {
    $query="select rollno,name,batch from Student where dept='".$dept."' AND sem='".$sem."' AND year='".$year."' and batch in ".$batch." order by batch,rollno";   
}

$result= queryMysql($query);

$res=  queryMysql("select class from ClassSem where sem='".$sem."'");

while ($row=  mysql_fetch_array($res)){$class=$row['class'];}

$fac_id1=null;

if($thpr==1){
    $res=  queryMysql("select fac_id from Teaches where course_id='".$course_id."' and year='".$year."' and THorPR=".$thpr." and batch=0");
}
else{
   $res=  queryMysql("select fac_id from Teaches where course_id='".$course_id."' and year='".$year."' and THorPR=".$thpr." and batch!=0 and fac_id='".$fac_id."'"); 
}

while ($row=  mysql_fetch_array($res)){$fac_id1=$row['fac_id'];}

if($fac_id!=$fac_id1)
{
    if($thpr==0 && $fac_id1==null)
        $fac_id="";
    if($thpr==1)
        $fac_id=$fac_id1;
}

$res=  queryMysql("select name from Faculty where fac_id='".$fac_id."'");

while ($row=  mysql_fetch_array($res)){$name=$row['name'];}


ob_start();
 echo '<form method="post" id="form1">';
 
 echo '<table id="pdfTable" width="100%" cellspacing="0" cellpadding="2"  border="1" bgcolor="WHITE" style="overflow:wrap;">';
                echo '<td colspan="'.($columns).'" align="center"><h3 align="center">'.$colname.'</h3>'
                        . '</td></tr>';
                echo '<tr>';
                 echo '<td colspan="3" align="center"><b><pre>Dept:'.$dept.'    Sem:'.$sem.'    Class:'.$class.'</pre></b></td>'
                         . '<td align="center" colspan="'.($columns-3).'"><pre><b> Subject:'.$title.'<br>Faculty Name:'.$name.'</b></pre></td>';
               
                
           echo '</tr>';
echo <<<_END
      <tr>
        <th align="center" width="5%">Sr. No</th>       
        <th align="center" width="7%">Roll No</th>
        <th align="center" width="25%">Name</th>
        <th align="center" width="4%">PC</th>     
_END;
$i=$columns-5;
$w=$i;
while($i!=0)
{
    echo '<th align="center" width="'.(55/$w).'"><pre>         </pre></th>';
    $i--;
}
    echo '<th align="center" width="4%">NC</th>';
echo '</tr>';
$srCount=1;
$prevBatch=NULL;
while($row = mysql_fetch_array($result)){
    if($prevBatch!=$row['batch'] && $thpr==0){
        echo '<tr><td colspan="'.$columns.'" align="center">Batch: B'.$row['batch'].'</td></tr>';
    }
    echo '<tr>';
        echo '<td align="center">'.$srCount.'</td>';
        echo '<td align="center">'.$row["rollno"].'</td>';
        echo '<td align="center">'.$row["name"].'</td>';
        $i=$columns-3;
        while($i!=0){
            echo '<td align="center"><pre>        </pre></td>';
            $i--;
        }
        $srCount++;
    echo '</tr>';
    $prevBatch=$row['batch'];    
        
}
date_default_timezone_set("Asia/Kolkata");
echo '<tr><td colspan='.$columns.' align="center"><pre>';
echo 'Report Generated on: '.date("d/m/Y").' at  '.date("h:i:sa").'  by- '.$appname.'-AC_'.$fac_id.'</td></tr>';
echo '</table>';
    echo '<input type="button" width="100%" class="button" name="generatepdf" id="generatepdf" value="Generate PDF"/>';
    echo '<input type="hidden" id="filename" name="filename" value="Attendence-Sheet-'.$dept.'-'.$sem.'-'.$year.'"/>';
    echo '<input type="hidden" id="page" name="page" value=""/>';
    if($thpr==0)
        echo '<input type="hidden" id="orientation" name="orientation" value="L"/>';
    else
        echo '<input type="hidden" id="orientation" name="orientation" value="P"/>';
    echo '<input type="hidden" id="style" name="style" value="3"/>';
echo '</form>';
echo '</center>';
}
else {
    echo 'Something is not set';
}
}
else {
    echo 'POST not done';
}

?>
