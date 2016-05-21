<!DOCTYPE html>

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
    insertDept();

if($loggedin){
if($_SESSION['grid']==='3'||$_SESSION['grid']==='1'||$_SESSION['grid']==='9'){    
echo '<div id="left">';
echo '<div class="info-box">'
        . '<div class="full-title-redgrad">Important Guidelines</div>'
            . '<ul>'
                .'<li>'.$checkmark.' For Non Teaching departments Intake should be 0.</li>'
            . '</ul>'
        . '</div>';
echo <<<_END
     
   </div>
    <div id="right">    

        <form method="post" action="deptcreate.php" onsubmit="return validateDept(this)">
         
            <fieldset class="form">
                <legend class="fit-title-blackgrad">Create Department</legend>
                <div>
                    <label class="form-label">Department ID</label>
                    <input class="form-input" type="text" name="dept_id" placeholder="Ex: CO" maxlength="6" required>
                </div>
                <div>
                    <label class="form-label">Name</label>
                    <input class="form-input" type="text" name="dname" placeholder="Ex: COMPUTER ENGG" maxlength="45" required>
                </div>
                <div>
                    <label class="form-label">HOD</label>
                    <select required name="dhod" class="form-input">
                            <option value="NULL">-No HOD-</option>
_END;
                    loadFaculty();        
echo <<<_END
                        </select>
                </div>
                <div>
                    <label class="form-label">Intake</label>
                    <input class="form-input" type="number" name="dintake" min="0" placeholder="Ex: 60" value="" required>
                </div>
                <div>
                    <label class="form-label">Month & Year of Estd.</label>
                    <input class="form-input" type="text" name="destd" placeholder="Ex: MARCH 2015" required value=""  required>
                </div>
                <div>
                    <label class="form-label">Type</label>
                    <span class="form-input">
                        <input class="form-radio" type="radio" name="type" id="dteach"  value="TEACHING" required><label class="form-label">Teaching</label>
                        <input class="form-radio" type="radio" id="dnteach"  name="type" value="NON TEACHING" required><label class="form-label">Non-Teaching</label>
                    </span>
                </div>    
                <div>
                    <input type="submit" class="form-button button" value="Create">
                </div>
            </fieldset>
         
        </form>
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
