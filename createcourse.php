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
*   Created On: 30 Jun, 2015, 11:08:04 AM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/functions.php';
require_once 'functions/header.php';
insertCourse();
              
if($loggedin)
{
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'){
echo <<<_END
    <div id="left">
_END;
echo '<div class="info-box"><div class="full-title-redgrad">Important Guidelines</div>'
        . '<ul>'
            .'<li>'.$checkmark.' See University Syllabus copy for course id.</li>'
            .'<li>'.$checkmark.' For departments with <y>Two Shifts</y> a course has to be created <y>Two times</y> one for each shift.</li>'
            .'<li>'. 'Example: for CIVIL department Cousre- ID: CE-C301 Title: Applied Mathematics-III should be entered as </li>'
            .'<li>'. 'For <y>SHIFT-I</y>:-</li><li>Course ID: <y>CE-C301-S1</y> </li>Title: <y>Applied Mathematics-III-S1</y></li>'
            .'<li>'. 'For <y>SHIFT-II</y>:-</li><li>Course ID: <y>CE-C301-S2</y> </li>Title: <y>Applied Mathematics-III-S2</y></li>'
            .'<li>'. 'Abbreviation could be same</li>'
            .'<li>'.$checkmark.' Revision indicates the year in which the syllabus is revised.</li>'
        . '</ul>'
    . '</div>';
echo <<<_END
   </div>
    <div id="right">    
        
        <form method="post" action="createcourse.php" onsubmit="return validateCourse(this)">
         
            <fieldset class="form">
                <legend class="fit-title-blackgrad">Create Course</legend>
                <div>
                    <label class="form-label">Course ID</label>
                    <input class="form-input" type="text" placeholder="Unique Course ID" maxlength=10 name="cid" required >
                </div>
                <div>
                    <label class="form-label">Title</label>
                    <input class="form-input" type="text" placeholder="Name of Subject" name="ctitle" required >
                </div>
                <div>
                    <label class="form-label">Abbreviation</label>
                    <input class="form-input" type="text" name="cabbrv" placeholder="Acronym of Title" maxlength="8" required >
                </div>
                <div>
                    <label class="form-label">Semester</label>
                    <select name="csem" class="form-input" required>
_END;
                         loadSem(); 
echo <<<_END
                        </select>
                    
                </div>
                <div>
                    <label class="form-label">Objectives</label>
                    <textarea name="cobj" rows="2" placeholder="Semicolon (;) seprated list of Course Objectives" class="form-input" required="required"></textarea>
                    
                </div>
                <div>
                    <label class="form-label">Outcomes</label>
                    <textarea name="cout" rows="2" placeholder="Semicolon (;) seprated list of Course Outcomes" class="form-input" required="required"></textarea>
                    
                </div>
                <div>
                    <label class="form-label">Department</label>
                    <select name="cdept" class="form-input" required>
_END;
                        loadDept(1); 
echo <<<_END
                        </select>
                </div>
                <div>
                    <label class="form-label">Practical Marks</label>
                    <input class="form-input" type="number" placeholder="PR" min="0" max="50" name="cpr" value="0" required >
                </div>
                <div>
                    <label class="form-label">Oral Marks</label>
                    <input class="form-input" type="number" placeholder="OR" min="0" max="50" name="cor" value="0" required >
                </div>
                <div>
                    <label class="form-label">Theory Marks</label>
                    <input class="form-input" type="number" placeholder="TH" min="0" max="100" name="cth" value="0" required >
                </div>
                <div>
                    <label class="form-label">Term Work Marks</label>
                    <input class="form-input" type="number" placeholder="TW" min="0" max="50" name="ctw" value="0" required >
                </div>
                <div>
                    <label class="form-label">Internal Assessment Marks</label>
                    <input class="form-input" type="number" placeholder="IA" min="0" max="20" name="cia" value="0" required >
                </div>
                <div>
                    <label class="form-label">Theory Credit</label>
                    <input class="form-input" type="number" placeholder="Range 0 - 10" min="0" max="10" name="cthcr" value="0" required >
                </div>
                <div>
                    <label class="form-label">Practical Credit</label>
                    <input class="form-input" type="number" placeholder="Range 0 - 10" min="0" max="10" name="cprcr" value="0" required >
                </div>
                <div>
                    <label class="form-label">Tutorials Credit</label>
                    <input class="form-input" type="number" placeholder="Range 0 - 10" min="0" max="10" name="ctutcr" value="0" required >
                </div>
                <div>
                    <label class="form-label">Theory Hours</label>
                    <input class="form-input" type="number" placeholder="Range 0 - 10" min="0" max="10" name="cthhrs" value="0" required >
                </div>
                <div>
                    <label class="form-label">Practical Hours</label>
                    <input class="form-input" type="number" placeholder="Range 0 - 10" min="0" max="10" name="cprhrs" value="0" required >
                </div>
                <div>
                    <label class="form-label">Tutorials Hours</label>
                    <input class="form-input" type="number" placeholder="Range 0 - 10" min="0" max="10" name="ctuthrs" value="0" required >
                </div>
                <div>
                    <label class="form-label">Revision</label>
                    
                        <select name="crev" id="crev" class="form-input" required>
_END;
                        loadYear(2009);
echo <<<_END
                        </select>
                    </label>
                </div>                    
                <div>
                    <input type="submit" class="button form-button" value="Create Course" >
                </div>
            </fieldset>
          
        </form>
      </div>
_END;
}
else {
      echo '<br><br><span class="error">Access Denied! You are not authorized to view this section</span>';    
}

}

 else echo'<br><br><span class="error">Please sign up and/or login to use the system</span>';
 
        require_once 'functions/footer.php';
?>