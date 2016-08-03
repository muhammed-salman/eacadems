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
if($loggedin)
{ 
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
    
echo '<div id="left">';
echo '<div class="info-box"><div class="full-title-redgrad slidebutton">Important Guidelines<span class="arrow-up"></span></div>';
echo '<ul class="slidebox">'
        .'<li>'.$checkmark.' It is manadatory to mark daily attendence record.</li>'
        .'<li>'.$checkmark.' If you don\'t fill this form daily, your lecture record will be lost.</li>'   
        .'<li>'.$checkmark.' After this page it is manadatory to mark attendance of students.</li>'
        .'<li>'.$checkmark.' If you abort process all the student will be marked present</li>'
    . '</ul>'
    . '</div>';

echo <<<_END
   </div>
    <div id="right">    
            
        <form method="post" action="attendence.php" onsubmit="return confirm('After this page it is MANADATORY to MARK ATTENDENCE of students.You CANNOT Abort Process else no absentee will be marked for this lecture. Are you sure you want to proceed?')">
        <fieldset class="form">
            <legend class="fit-title-blackgrad">Attendence Selection</legend>
                  <input type="hidden" name="fyear" id="fyear" class="teachyear form-input" required value="
_END;
                    echo academic_year();
echo <<<_END
" readonly="true"/>
            <div>
                <label class="form-label">Select Subject</label>
                    <select name="fsub" id="fsub" class="teachsub form-input" required>
_END;
                    echo loadTeachesCourse('none',academic_year());
echo <<<_END
                    </select>
            </div>        
            <div>
                <label class="form-label">Select Type</label>
                <select class="attendtype form-input" name="fthpr" id="fthpr" required>
                </select>
            </div>        
            <div>
                <label class="form-label">Select Batch</label>
                <select class="form-input" name="fbatch" id="fbatch" required>
                </select>
            </div>
            <div>
                <label class="form-label">Date of Lecture</label>
                <input class="form-input" type="text"  name="fdol" required value="
_END;
echo date('d/m/Y');
echo <<<_END
"/>
            </div>
            <div>
                <label class="form-label">Time Slot</label>
                <select class="form-input" name="fslot" id="fslot" required>
_END;
                    loadTimeSlot();
echo <<<_END
                </select>
            </div>
            <input type="submit" class="button form-button" value="Proceed">
                    
           </fieldset>
_END;
          echo '<input class="form-input" type="hidden" name="ffac_id" id="ffac_id" value="'.$_SESSION['fac_id'].'" />';
          echo '<input class="form-input" type="hidden" name="fnol" id="fnol" value="1" required />';  
          echo '</form>';
          echo '</div>';
          
             
     }
     else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
    }

}

 else{
     echo'<span class="error">Please sign up and/or login to use the system</span>';
 
     header('Location:  login.php');
 }
 
     require_once 'functions/footer.php';
?>

