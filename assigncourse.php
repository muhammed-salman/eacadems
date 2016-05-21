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

if($loggedin){
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'||$_SESSION['grid']==='2'){
        assignCourse();
echo <<<_END

    <div id="left">
_END;
echo <<<_END
   </div>
   \ <div id="right">    
    
<form method="post" action="assigncourse.php"onsubmit="return validateAssignCourse(this)">
            <fieldset class="form">
                <legend class="fit-title-blackgrad">Assign Course</legend>
<!-- comment start               <div>
                    <label class="form-label">Select Department</label>
                    <select name="adept" id="adept" required class="form-input" >
_END;
                        loadDept(1);
                                                
echo <<<_END
                        </select>
                </div>
comment end --!>                        
                <div>
                    <label class="form-label">Select Faculty</label>
                    
                        <select   name="afaculty" id="afaculty" required class="form-input"  >
_END;
                        loadFaculty(1);
                                                
echo <<<_END
                        </select>
                </div>
                <div>
                    <label class="form-label">Course Semester</label>
                    <select name="asem" id="asem" class="form-input"  required >
_END;
                        loadSem();
echo <<<_END
                        </select>
                </div>
                <div>
                    <label class="form-label">Course Department</label>
                    <select name="acdept" id="acdept" required class="form-input" >
_END;
                           loadDept(1);
echo <<<_END
                        </select>
                </div>
                
                <div>
                    <label class="form-label">Select Course</label>
                    
                        <select   name="acourse" id="acourse" required class="form-input"  >
                            </select>
                </div>
                <div>
                    <label class="form-label">Year</label>
                    
                        <input class="form-input" type="text" name="ayear" required value="
_END;
                        echo academic_year();
echo <<<_END
" readonly="true"/> 
                </div>
                <div>
                    <label class="form-label">Type</label>
                    <span class="form-input">    
                        <input type="radio" name="abit" id="ath" class="aThorPr form-radio"  value=1 required><label class="form-label">Theory</label>
                        <input type="radio" id="apr"  name="abit" class="aThorPr form-radio" value=0 required><label class="form-label">Practical</label>
                    </span>    
                </div>
                <div>
                    <label class="form-label">Number of Hours </label>
                    <input class="form-input" type="number" name="ahours" id="ahours" min="1" required readonly="true"/>
                </div>    
                <div>
                    <label class="form-label">Batches </label>    
                    <span class="form-input">    
                        <input type="checkbox" class="acheck form-check" disabled="disabled" id="ab1" name="ab1" value="1"/><label class="form-label">B1</label>
                        <input type="checkbox" class="acheck form-check" disabled="disabled" id="ab2" name="ab2" value="1"/><label class="form-label">B2</label>
                        <input type="checkbox" class="acheck form-check" disabled="disabled" id="ab3" name="ab3" value="1"/><label class="form-label">B3</label>
                        <input type="checkbox" class="acheck form-check" disabled="disabled" id="ab4" name="ab4" value="1"/><label class="form-label">B4</label>
                    </span>    
                </div>
                <div>
                    <input type="submit" class="button form-button" value="Assign Course">
                </div>
            </fieldset>
              <input type="hidden" name="ab0" id="ab0" value="0" />
        </form>
     </div>
    
                        
_END;
}
else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
}

}

else{
    echo'<span class="error">Please sign up and/or login to use the system</span>';   
    
    
}

require_once 'functions/footer.php';
?>