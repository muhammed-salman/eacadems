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
*   Created On: 6 Jul, 2015, 9:00:55 AM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
if($loggedin)
{ 
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='6'){
          insertGrade ();
echo <<<_END
    <div id="left">
_END;
echo '<div class="info-box"><div class="full-title-redgrad">Important Guidelines</div>';
echo '<ul>'
        .'<li>'.$checkmark.' Please fill this form very carefully.</li>'
        .'<li>'.$checkmark.' Marks Fields which are not applicable should be assigned value -1.</li>'   
        .'<li>'.$checkmark.' Check the form before submitting for correctness.</li>'
        .'<li>'.$checkmark.' Modification will not be allowed further.</li>'
    .'</ul>'
    . '</div>';

echo <<<_END
   </div>
    <div id="right">    
         
        <form method="post" action="grade.php" onsubmit="return validateGrade(this)">
                <fieldset class="form">
                <legend class="fit-title-blackgrad">Semester Examination Entry</legend>
                <div>
                    <label class="form-label">Previous Year</label>
                    <label class="form-label">
                        <input class="form-input" type="text" name="gyear" id="gyear" readonly="true" required="true" value="
_END;
                            echo prev_academic_year();
echo <<<_END
">   
                </div>
                <div>
                    <label class="form-label">Select Department</label>
                    <label class="form-label"><select class="form-input" name="gdept" id="gdept" required>
_END;
                        loadDept(1);
echo <<<_END
                        </select>
                </div>
                <div>
                    <label class="form-label">Select Semester</label>
                    <select class="form-input" name="gsem" id="gsem"  required>
_END;
                         loadSem();
echo <<<_END
                    </select>
                </div>
                <div>
                    <label class="form-label">Select Roll No</label>
                    <select class="form-input" name="groll" id="groll" required>
                    </select>   
                </div>
                <div>
                    <label class="form-label">Seat Number</label>
                    <input class="form-input" type="text" placeholder="Exam Seat No." name="gseat" id="gseat" value="" required/>
                </div>         
                <div>
                    <label class="form-label">Select Course</label>
                    <select class="form-input" name="gcourse" id="gcourse" required>
                    </select>
                </div>
                <div>
                    <label class="form-label">Practical Marks</label>
                    <input class="form-input" type="number" placeholder="PR" min="-1" max="50" name="gpr" required>
                </div>
                <div>
                    <label class="form-label">Oral Marks</label>
                    <input class="form-input" type="number" placeholder="OR" min="-1" max="50" name="gor" value="" required>
                </div>
                <div>
                    <label class="form-label">Theory Marks</label>
                    <input class="form-input" type="number" placeholder="TH" min="-1" max="100" name="gth" value="" required>
                </div>
                <div>
                    <label class="form-label">Term Work Marks</label>
                    <input class="form-input" type="number" placeholder="TW" min="-1" max="50" name="gtw" value="" required>
                </div>
                <div>
                    <label class="form-label">Internal Assessment Marks</label>
                    <input class="form-input" type="number" placeholder="IA" min="-1" max="20" name="gia" value="" required>
                </div>
                <div>
                    <input type="submit" class="button form-button" value="Submit">
                </div>
            </fieldset>
        </form>
      
    </div>     
_END;
}
else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
      header("Refresh: 1 ;url=index.php");
      
}

}

 else{
     echo'<span class="error">Please sign up and/or login to use the system</span>';
     header("location: login.php");
 }
 
        require_once 'functions/footer.php';
?>                            