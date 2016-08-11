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
*   Created On: 20 Jun, 2015, 6:35:02 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
     if($loggedin){
         if($_SESSION['grid']==='2'){
echo <<<_END
 <div id="left">
_END;
echo <<<_END
   </div>
    <div id="right">    
                
        <form method="post" id="form1">
        
        <fieldset class="form">
            <legend class="fit-title-blackgrad">Select Details</legend>
            <div>
              <input type="hidden" name="vyear" id="vyear" class="teachyear form-input" required value="
_END;
                echo academic_year();
echo <<<_END
" readonly="true"/>
            </div>
            <div>
                <label class="form-label">Select Subject</label>
                <select name="vsub" id="vsub" class="teachsub form-input" required>
_END;
loadTeachCourse('none', academic_year());
echo <<<_END
                </select>
            </div>
            <div>
                <label class="form-label">Select Type</label>
                <div class="form-input">
                    <label class="form-label"><input type="radio" class="viewtype form-radio" name="vthpr" value=1 required>Theory</label>
                    <label class="form-label"><input type="radio" class="viewtype form-radio" name="vthpr" value=0 required>Practical</label>
                </div>    
            </div>
            <div>
                <label class="form-label">Select Faculty</label>
                <select class="form-input" name="vfac" id="vfac" required>
                </select>
            </div>

            <button class="button form-button" name="viewca" id="viewca" onclick="submitForm('viewca.php')" >View CA</button>
            <button class="button form-button" name="viewprint" id="viewprint" onclick="submitForm('printpp.php')">View Prac Plan</button>
            <button class="button form-button" name="viewtlo" id="viewtlo" onclick="submitForm('viewtlo.php')">View TLO</button>
            
           </fieldset>
_END;
        echo '<input type="hidden" id="uppcourse" name="uppcourse" value=""/>';
        echo '<input type="hidden" id="uppyear" name="uppyear" value="'.  academic_year().'"/>';
        echo '<input type="hidden" id="uppfac_id" name="uppfac_id" value=""/>';
        echo '<input type="hidden" id="tlcourse" name="tlcourse" value=""/>';
        echo '<input type="hidden" id="tlyear" name="tlyear" value="'.academic_year().'"/>';
        echo '<input type="hidden" id="cacourse" name="cacourse" value=""/>';
        echo '<input type="hidden" id="cayear" name="cayear" value="'.academic_year().'"/>';
        echo '<input type="hidden" id="title" name="title" value=""/>';
        echo '<input type="hidden" id="ffac_id" name="ffac_id" value=""/>';
        echo '</form>';
        echo '</div>';
         
     }
     else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
}

}

 else echo'<span class="error">Please sign up and/or login to use the system</span>';
     require_once 'functions/footer.php';
?>