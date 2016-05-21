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
*   Created On: 20 Jun, 2015, 1:00:37 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/connect.php';


if($_POST)
{
    if($_POST['year']=="" || $_POST['sem']=="" || $_POST['dept']==""){
        echo '<option value="">Select Details</option>';
        die();
    }

    $year=trim($_POST['year']);
    $sem=$_POST['sem'];
    $dept=$_POST['dept'];
    $fac_id=$_POST['fac_id'];
    $grid=null;
    
    $query="select grid from Access where fac_id='".$fac_id."'";
 
    $result= mysql_query($query);
    
    while ($row = mysql_fetch_array($result)) {
       $grid=$row['grid'];
    }
    if($grid!=3 && $grid!=7){
        $query="select distinct(course_id),title from Course c natural join Teaches t where year='".$year."' and sem='".$sem."' and dept='".$dept."' and fac_id='".$fac_id."'";
    }
    else{
        $query="select distinct(course_id),title from Course c natural join Teaches t where year='".$year."' and sem='".$sem."' and dept='".$dept."'";
    }
    $result=mysql_query($query);

if(!$result || mysql_num_rows($result)==0){
        echo '<option value="">No Records</option>';
        die();
}
else {
       echo '<option value="">------</option>';
       while($row=mysql_fetch_array($result)){
        $course_id=$row['course_id'];
        $title=$row['title'];
        echo '<option value="'.$course_id.'">'.$title.'</option>';
        }  
   
}

}
        
 

?>