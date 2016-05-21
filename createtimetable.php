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
assignCourseSlot();
if($loggedin)
{
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'){
echo <<<_END
    <div id="left">
_END;
echo '<div class="info-box"><div class="full-title-redgrad">Important Guidelines</div>';
echo '<ul>'
        . '<li>'.$checkmark.' If you select Practical option then the next sequential time slot is automatically assigned.'
        . ' Hence no need of seprate assignment for two slots in case of practicals</li>'
    . '</ul>'
    . '</div>';
echo <<<_END
   </div>
    <div id="right">    
        
    
        <form method="post" action="createtimetable.php" onsubmit="return confirm('Are you sure to proceed with assignment?. You CANNOT UNDO this operation.')">
            <fieldset class="form">
                <legend class="fit-title-blackgrad">ASSIGN SLOTS</legend>
                
                <div>
                    <label class="form-label">Year</label>
                    <input class="form-input" type="text" name="cyear" id="cyear" value="
_END;
echo academic_year(); 
echo <<<_END
" required readonly="true"/>
                    </label>
                </div>
                
                <div>
                    <label class="form-label">Select Department</label>
                    <select name="cdept" id="cdept" required class="form-input">
_END;
                        loadDept(1);
echo <<<_END
                        
                        </select>
                </div>
                
                <div>
                    <label class="form-label">Select Semester</label>
                    <select name="csem" id="csem" class="form-input"  required >
_END;
                        loadSem();
echo <<<_END
                        
                    </select>
                </div>
                
                <div>
                    <label class="form-label">Select Course</label>
                    <select name="ccourse" id="ccourse" required class="form-input" >
                    </select>
                </div>
         
                <div>
                     <label class="form-label">Type</label>
                     <span class="form-input">   
                        <input type="radio" class="attendtype form-radio" name="cthpr" value=1 required><label class="form-label">Theory</label>
                        <input type="radio" class="attendtype form-radio" name="cthpr" value=0 required><label class="form-label">Practical</label>
                     </span>   
                </div>
                                
                <div>
                    <label class="form-label">Select Day</label>
                        <select name="cday" id="cday" class="form-input" required>
                            <option value="">------</option> 
                            <option value="MON">MONDAY</option>
                            <option value="TUE">TUESDAY</option>
                            <option value="WED">WEDNESDAY</option>
                            <option value="THU">THURSDAY</option>
                            <option value="FRI">FRIDAY</option>
                        </select>
                </div>
                
                <div>
                    <label class="form-label">Select Slot ID</label>
                         <select   name="cslot" id="cslot" class="form-input" required>
_END;
                        loadTimeSlot();
echo <<<_END
                        </select>
                </div>
            
                <div>
                    <label class="form-label">Select Class Room</label>
                    <select name="croom" id="croom" class="form-input" required>
_END;
                        loadClassRoom(); 
echo <<<_END
                        </select>
                </div>
                
                <div>
                    <input type="submit" class="button form-button" value="Assign Slot">
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