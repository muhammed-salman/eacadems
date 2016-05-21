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
*   Created On: 26 May, 2015, 1:21:05 PM
*   Author: MUhammed Salman Shamsi
*//*
require_once 'functions/header.php';
updateAttmarks();
if($loggedin)
{
    if($_POST)
    {
        if(isset($_POST['fatyear'])&& isset($_POST['fatsub'])&& isset($_POST['fatdept'])) {
        $fatyear=$_POST['fatyear'];;
        $fatsub=$_POST['fatsub'];
        $fatdept=$_POST['fatdept'];
        $query="select * from Course where course_id='".$fatsub."' and TW!=0";
        if(!mysql_query($query)){
            echo "<br><font color='red'>Failed to execute query : ".  mysql_error()."</font><br>";
       
            die();
       }
        $result=  mysql_query($query); 
        if(!$result)
        {
            echo '<br><font color="red">This Course does not have Term Work.<br>Hence no attendance marks are assigned.</font>';
            die();
        } 
       $query="select * from AttMarks where year='".$fatyear."' and course_id='".$fatsub."'";
       $result=  mysql_query($query); 
        if(mysql_num_rows($result)==0)
        {   $query="select rollno from Takes natural join Student where course_id='".$fatsub."' and year='".$fatyear."'";
            if(!mysql_query($query)){
            echo "<br><font color='red'>Failed to execute query : ".  mysql_error()."</font><br>";
       
            die();
            }
            $result=  mysql_query($query);
            while($row=  mysql_fetch_array($result)){
                $rollno=$row['rollno'];
                $query="insert into AttMarks values ('$rollno','$fatsub','$fatyear',NULL)";
                if(!mysql_query($query)){
                    echo "<br><font color='red'>Failed to execute query : ".  mysql_error()."</font><br>";
                     die();
                }
            }
        }
        $query="select * from Takes natural join AttMarks natural join (select rollno,name from Student)as s where year='".$fatyear."' and course_id='".$fatsub."' and rollno in"
                . "(select rollno from Student where dept='".$fatdept."')";
        
       if(!mysql_query($query)){
            echo "<br><font color='red'>Failed to execute query : ".  mysql_error()."</font><br>";
            die();
       }
        
        $result=  mysql_query($query); 
        if(!$result)
        {
            echo '<br><font color="red">No Records Found</font>';
        }
        else {
echo <<<_END
        <form method="post" action="attm.php" onsubmit="return confirm('ARE YOU SURE? YOU WILL NOT BE ABLE TO MODIFY MARKS LATER')">
          <center>
          <table cellspacing="8" cellpadding="2" border="0" bgcolor="#00eeee">
            <th colspan="3" align="center">Test Marks Form</th>
            <tr>
                <th align="center"><b>Rollno</b></th>
                <th align="center"><b>Name</b></th>
                <th align="center"><b>Marks</b></th>
            </tr>
_END;
        while($row=  mysql_fetch_array($result))
        {
            echo '<tr>';
            echo '<td align="center"> <input type="text"  name="'.$row["rollno"].'" style="border: 0; background: transparent; text-align: center;" value="'.$row['rollno'].'" readonly="readonly" /></td>';
            echo '<td align="center"><textarea class="readonlytextarea" rows="2" name="'.$row["rollno"].'_name" readonly="readonly">'.$row['name'].'</textarea></td>';
            echo '<td align="center"><input type="number" min="0" max="5" name="'.$row["rollno"].'_marks" id="'.$row["rollno"].'_marks" value="'.$row['marks'].'" style="text-align: center;';
            if($row['marks']!=NULL){
                echo  ' background:transparent;" readonly="readonly"/></td>';
            }
            else {
                echo  '"/></td>';
            }
            echo '</tr>';
        }
        echo '<tr><td align="center" colspan="3"><input type="submit" class="button" value="Update Marks"></td></tr>';
        echo '</table>';
        echo '</center>';
        echo '<input type="hidden" name="attmyear" value="'.$fatyear.'"/>';
        echo '<input type="hidden" name="attmsub" value="'.$fatsub.'"/>';
        echo '<input type="hidden" name="attmdept" value="'.$fatdept.'"/>';
        echo '</form>';
 
    }
   }
 }
 else {
     echo 'Data not posted';
     
 }
}
 else echo'<br><br>Please sign up and/or login to use the system';
require_once 'functions/footer.php';*/
header("Refresh: 0; url=index.php");
 ?>