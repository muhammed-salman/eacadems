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
*/
require_once 'functions/header.php';
if($loggedin){
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'){
    insertSyllabus();
?>
    <div id="left">
<?php
echo '<div class="info-box"><div class="full-title-redgrad">Important Guidelines</div>';
echo '<ul>'
        . '<li>'.$checkmark.' No of Modules does not mean number of chapters</li>'
        .'<li>'.$checkmark.' No of Modules entry should be taken from University Syllabus copy.</li>'
    . '</ul>'
    . '</div>';
?>
    </div>
    <div id="right">    
        
     <form method="post" action="createsy.php" onsubmit="return confirm('Are you sure you want to submit?')">
        
         <fieldset class="form">
             <legend class="fit-title-blackgrad">Syllabus Creation</legend>
            
           <div>
                    <label class="form-label">Select Course</label>
                        <select name="cscourse" id="cscourse" required class="form-input">
                            <?php loadCourse(); ?>
                        </select>
           </div>
           <div>
               <div id="coursestatus"></div>
           </div>
           <div>
                <label class="form-label">No of Modules</label>
                <input class="form-input" type="text" name="cschap" id="cschap" value="" placeholder="Ex: 5" required disabled="disabled">  
           </div>
           <div>
                <input type="submit" class="button form-button" value="Create">
            </div>
         </fieldset>
        
     </form>
    </div>
          
<?php
    }
    else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
}

}

 else echo'<span class="error">Please sign up and/or login to use the system</span>';
require_once 'functions/footer.php'; ?>