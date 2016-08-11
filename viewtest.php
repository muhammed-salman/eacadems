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
*   Created On: 22 Jun, 2015, 11:54:05 AM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
     if($loggedin){
         if($_SESSION['grid']==='7'||$_SESSION['grid']==='2'){
echo <<<_END
       
    <div id="wrapper" name="wrapper"  style="overflow-x:auto;">    
   <form method="post" id="form1">
        
        <fieldset class="form">
            <legend class="fit-title-blackgrad">Students Selection</legend>

              <input class="form-input" type="hidden" name="vtyear" id="vtyear" required value="
_END;
                echo academic_year();
echo <<<_END
" readonly="true"/>
            <div>
                <label class="form-label">Select Semester</label>
                <select class="form-input" name="vtsem" id="vtsem" required>
_END;
                loadSem();
echo <<<_END
                </select>
            </div>
            <button class="button form-button" name="loadtm" id="loadtm">Load</button>
                    
           </fieldset>
_END;

         echo '<input type="hidden" name="dept" id="dept" value="'.loadFacultyDept().'">';
         echo '<input type="hidden" name="user" id="user" value="'.$user.'">';
         echo '<input type="hidden" name="fac_id" id="fac_id" value="'.$_SESSION['fac_id'].'">';
         echo '</div>';
 }
  else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
}

}
else echo'<span class="error">Please sign up and/or login to use the system</span>';   

     require_once 'functions/footer.php';
?>
