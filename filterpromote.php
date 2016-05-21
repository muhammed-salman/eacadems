<!--
/*                                             License
*   The following license governs the use of Eacadems in academic and educational environments. Commercial use requires a commercial license from Muhammed Salman Shamsi.
*  ACADEMIC PUBLIC LICENSE
*  Copyright (C) 2014 - 2015  Muhammed Salman Shamsi.
*   FOR DETAILED TERMS AND CONDITION SEE LICENSE.TXT FILE
*   NO WARRANTY
*   BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.
*   IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED ON IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.
*   END OF TERMS AND CONDITIONS
*   [license text: http://www.omnetpp.org/intro/license]   
*/
-->
<?php 
        require_once 'functions/header.php';
        
if($loggedin){
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'||$_SESSION['grid']==='2'||$_SESSION['grid']==='6'){
echo <<<_END
        <div id="left">
_END;
echo '<div class="info-box"><div class="full-title-redgrad">Important Guidelines</div>';
echo '<ul>'
        .'<li>'.$checkmark.' Student should be Promoted before the beining of each semester.</li>'
        .'<li>'.$checkmark.' Students who are not promoted are dropped.</li>'
        .'<li>'.$checkmark.' Students should be detained only if the termwork is not submitted.</li>'
        .'<li>'.$checkmark.' Before proceeding on this form always consult exam cell / respected exam co-ordinator.</li>'
   . '</ul>'
   . '</div>';

echo <<<_END
   </div>
    <div id="right">    
        
        <form method="post" id="form1">
          
            <fieldset class="form">
                <legend class="fit-title-blackgrad">Students Information for Promotion / Detention</legend>
                <div>
                    <label class="form-label">Select Department</label> 
                    
                        <select name="fpdept" id="fpdept" required="true" class="form-input" >
_END;
                        loadDept(1);
echo <<<_END
                        </select>
                </div>
                <div>
                    <label class="form-label">Select Semester</label>
                    
                        <select name="fpsem" id="fpsem" class="form-input"   required="true">
_END;
                                loadSem();
echo <<<_END
                        </select>
                </div>
                <div>
                    <label class="form-label">Year</label>
                    
                        <select name="fpyear" id="fpyear" class="form-input" required="true">
_END;
                             loadTakesyear();
echo <<<_END
                        </select>
                </div>
                
                <div>
                   <input type="button" class="button form-button" name="promote" id="promote" value="Proceed to Promote" />
                   <input type="button" class="button form-button" name="detain" id="detain" value="Proceed to Detain" />
                </div>

            </fieldset>
          
        </form>
      </div>
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