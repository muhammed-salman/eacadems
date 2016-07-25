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
*   Created On: 13 Aug, 2015 1:14:25 PM
*   Author: MUhammed Salman Shamsi
*/


require_once 'functions/header.php';
insertClass();

if($loggedin){
if($_SESSION['grid']==='3'||$_SESSION['grid']==='1'||$_SESSION['grid']==='7'){    
echo '<div id="left">';
echo '<div class="info-box">'
        . '<div class="full-title-redgrad">Important Guidelines</div>'
            . '<ul>'
                .'<li>'.$checkmark.' Assign a class id in following format Building-Room No EX: A-201.</li>'
                .'<li>'.$checkmark.' Please give short name to classroom. So that they occupy less space in timetable cell. EX: LH instead of Lecture Hall.</li>'
            . '</ul>'
    . '</div>';
echo <<<_END
     
   </div>
    <div id="right">    

        <form method="post" action="createclassroom.php" onsubmit="return validateClassroom(this)">
         
            <fieldset class="form">
                <legend class="fit-title-blackgrad">Create Classroom</legend>
                <div>
                    <label class="form-label">Class ID</label>
                    <input class="form-input" type="text" name="class_id" placeholder="Ex: A-201" maxlength="6" required>
                </div>
                <div>
                    <label class="form-label">Classroom Abbrv</label>
                    <input class="form-input" type="text" name="class" placeholder="Ex: LH (for Lecture Hall)" maxlength="15" required>
                </div>  
                <div>
                    <input  type="submit" class="button form-button" value="Create">
                </div>
            </fieldset>
         
        </form>
_END;
    $query="select * from ClassRoom order by class_id";
    $result=  queryMysql($query);
    if(mysql_num_rows($result)==0)
        echo '<span class="info">No Classrooms seem to exist so far!';
    else {
        echo '<div class="fit-title-blackgrad" style="float:left; margin-bottom:1em;">Existing Classrooms</div>';
        echo '<div class="col4-1 div-table">';
            while ($row = mysql_fetch_array($result)) {
                echo '<div>'
                        . '<span>'.$row['class_id'].'</span>'
                        . '<span>'.$row['classroom'].'</span>'
                    .'</div>';        
            }
        echo '</div>';
    }
        
echo <<<_END
        </div>
_END;
}
 else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
}

}

 else echo'<span class="error">Please sign up and/or login to use the system</span>';
require_once 'functions/footer.php';
?>
