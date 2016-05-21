<?php

/*                                             License
*   The following license governs the use of CollegeERP in academic and educational environments. Commercial use requires a commercial license from Muhammed Salman Shamsi.
*   ACADEMIC PUBLIC LICENSE
*   Copyright (C) 2014 - 2015  Muhammed Salman Shamsi.
*   FOR DETAILED TERMS AND CONDITION SEE LICENSE.TXT FILE
*   NO WARRANTY
*   BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.
*   IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED ON IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.
*   END OF TERMS AND CONDITIONS
*   [license text: http://www.omnetpp.org/intro/license]   
*   Created On: 1 Aug, 2015, 3:44:52 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';

if($loggedin){
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'||$_SESSION['grid']==='8'){
        updateStudent();
?>   
        <?php
        echo '<div id="left">';
        echo '<div class="info-box">'
        . '<div class="full-title-redgrad">Important Guidelines</div>'
            . '<ul>'
                .'<li>'.$checkmark.' Please Verify the data before submitting the form</li>'
                .'<li>'.$checkmark.' Name should be written in following sequence<br>Surname FirstName MiddleName</li>'
                .'<li>'.$checkmark.' Please provide correct Phone / Mobile Number<br>It will be verified</li>'
                .'<li>'.$checkmark.' Please provide correct and working E-mail ID<br>It is very important for online communication.</li>'
                .'<li>'.$checkmark.' Disciplinary action will be taken if information is found to be Incorrect.</li>'
            . '</ul>'
        . '</div>';?>
    </div>
    <div id="right">   
<?php 
    if(!($_POST)){
        
echo <<<_END
        <form method="post" action="updatestudent.php">
        
         <fieldset class="form">
           <legend class="fit-title-blackgrad">Roll No</legend>
           <div> 
                <label class="form-label"><input class="form-input" type="text" tabindex="1" maxlength="10" name="usrollno" required>
            </div>
            <div>
                <input  type="submit" class="form-button button" value="GO">
           </div>
        </fieldset>
        </form>
        </div>
_END;
   
    }
else{
    if(isset($_POST[usrollno])){
        $rollno= strtoupper(sanitizeString($_POST[usrollno]));
        $query="select * from Student where rollno='".$rollno."'";
        $result=  queryMysql($query);
echo <<<_END
        
        <form method="post" action="updatestudent.php" onsubmit="return validateStudentUpdate(this)">
         <fieldset class="form">
            <legend class="fit-title-blackgrad">Edit Student Details</legend>
_END;

        while ($row = mysql_fetch_array($result)) {
                   
           echo '<div>'; 
                echo'<label class="form-label">Roll No.</label>';
                echo '<input class="form-input" type="text" tabindex="0" name="usrollno" value="'
                .$row[rollno].'" readonly="true" required>';
           echo '</div>';
           echo '<div>'; 
                echo'<label class="form-label">Name</label>';
                echo'<input class="form-input" type="text" tabindex="1" maxlength="45" name="usname" '
                . 'value="'.$row[name].'" readonly="true" required>';
           echo '</div>';
           echo '<div>'; 
                echo'<label class="form-label">Permanent Address</label>';
                echo'<textarea tabindex="2" rows="3" cols="23" class="peradd form-input" maxlength="150"  name="usaddress" wrap="soft" required>'
                .$row[address]. '</textarea>';
           echo '</div>';
echo <<<_END
           <div>
                <input  type="checkbox" name="cfaddcheck" tabindex="3" class="form-check addcheck">
                <label class="form-label">Same as above</label>
           </div>
_END;
           echo '<div>'; 
                echo'<label class="form-label">Residential Address</label>';
                echo'<textarea tabindex="4" rows="3" cols="23" class="resiadd form-input" maxlength="150"  name="usraddress"  wrap="soft" required>'
                .$row[res_add]. '</textarea>';
           echo '</div>';
           echo '<div>'; 
                echo'<label class="form-label">Semster</label>';
                echo'<input class="form-input" type="text" tabindex="5" maxlength="4" name="ussem" '
                . 'value="'.$row[sem].'" readonly="true" required>';
           echo '</div>';
           echo '<div>'; 
                echo'<label class="form-label">Date of Admission</label>';
                echo'<input class="form-input" type="date" tabindex="6"  name="usdoa" '
                . 'value="'.$row[doa].'" disabled="true" required>';
           echo '</div>';
           echo '<div>'; 
                echo'<label class="form-label">Date of Birth</label>';
                echo'<input class="form-input" type="date" tabindex="7" maxlength="45" name="usdob" '
                . 'value="'.$row[dob].'" disabled="true" required>';
           echo '</div>';
           echo '<div>'; 
                echo'<label class="form-label">Mobile Number</label>';
                echo'<input class="form-input" type="text" tabindex="8" maxlength="12" name="usphoneno" '
                . 'id="sphoneno" value="'.$row[phoneno].'" required>'
                        . '<br><span id="sphoneerr"></span>';
           echo '</div>';
           echo '<div>'; 
                echo'<label class="form-label">Parents Mobile Number</label>';
                echo'<input class="form-input" type="text" tabindex="9" maxlength="12" name="uspphoneno" '
                . 'id="spphoneno" value="'.$row[pphoneno].'" required>'
                        . '<br><span id="spphoneerr"></span>';
           echo '</div>';
           echo '<div>'; 
                echo'<label class="form-label">Department</label>';
                echo'<input class="form-input" type="text" tabindex="10" name="usdept" '
                . 'value="'.$row[dept].'" disabled="true" required>';
           echo '</div>';
           echo '<div>'; 
                echo'<label class="form-label">Email</label>';
                echo'<input class="form-input" type="email" tabindex="11" maxlength="45" name="usemail" '
                . 'value="'.$row[email].'"required>';
           echo '</div>';
           echo '<div>'; 
                echo'<label class="form-label">Batch</label>';
                echo'<input class="form-input" type="text" tabindex="12" maxlength="1" name="usbatch" '
                . 'value="'.$row[batch].'" readonly="true" required>';
           echo '</div>'; 
            }

echo <<<_END
            <div>
                <input  type="submit" tabindex="12" class="button form-button" value="Update">
            </div>
           </table>
            
        </center>
     </form>
    </div>
_END;
    }}}
 else {echo '<br><br><center><span class="error">Access Denied! You are not authorized to view this section</span></center>';}
}
else {
      echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';
}
     require_once 'functions/footer.php'; 
?>