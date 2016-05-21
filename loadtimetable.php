<!DOCTYPE html>
<!--
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
*   Author: MUhammed Salman Shamsi
*/
-->
<?php 
 require_once 'functions/header.php';
    if($loggedin){    
        if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'||$_SESSION['grid']==='5'||
                     $_SESSION['grid']==='4'||$_SESSION['grid']==='2'||$_SESSION['grid']==='1'){
       
        
?>
    <div id="left">
    </div>
    <div id="right">    

        <form method="post" action="timetable.php">
          
            <fieldset class="form">
                <legend class="fit-title-blackgrad">Select Details</legend>
<?php 
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='4'||$_SESSION['grid']==='1'){
        
            echo '<div>'
                    .'<label class="form-label">Select Department</label>'
                    .'<select name="ltdept" id="ltdept" required class="form-input" onchange="post">';
                        loadDept(1);
                    
                   echo '</select>'
                        . '</div>';
    }
    else {
        echo '<input type="hidden" name="ltdept" id="ltdept" required value="'.loadFacultyDept().'" />';
    }
?>
                <div>
                    <label class="form-label">Select Semester</label>
                    <select name="ltsem" id="ltsem" class="form-input"  required >
                        <?php loadSem(); ?>
                    </select>
                </div>
                
                <input type="hidden" name="ltyear" class="form-input" id="ltyear" value="<?php echo academic_year()?>"required readonly="true"/>
                
                <div>
                    <input type="submit" class="button form-button" value="Load Time Table">
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
    require_once 'functions/footer.php';
?>