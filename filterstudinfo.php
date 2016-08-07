<!DOCTYPE html>
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
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='2'||
                     $_SESSION['grid']==='7'||$_SESSION['grid']==='1'||$_SESSION['grid']==='9'){
                     
?>
    <div id="left">
<?php

?>
   </div>
    <div id="right">    
   
        <form method="post" action="studentinfo.php">
          
            <fieldset class="form">
                <legend class="fit-title-blackgrad">Get Students Information</legend>
                <div>
                    <label class="form-label">Select Department</label>
                    <select class="form-input" name="fsidept" id="fsidept" required >
                        <?php
                        loadDept(1);
                        ?>
                    </select>
                </div>
                <div>
                    <label class="form-label">Select Semester</label>
                    <select class="form-input" name="fsisem" id="fsisem"   required >
                        <?php loadSem()?>
                    </select>
                </div>
                <div>
                    <label class="form-label">Semester Type</label>
                    <select class="form-input" name="fsihalf" required>
                            <option value="">------</option>
                            <option value="First Half">First Half(Even Semester)</option>
                            <option value="Second Half">Second Half(Odd Semester)</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Sem Start Year</label>
                    <select class="form-input" name="fsiyear" required>
                            <?php loadYear(2014);?>
                    </select>
                </div>
                <div><label class="form-label">Select the information required</label> </div>
                <div style="display:block;">
                    <label class="form-label"><input class="form-check" type="checkbox" name="fsirollno"  checked="checked">Roll no</label>
                    <label class="form-label"><input class="form-check" type="checkbox" name="fsiname"  checked="checked">Name</label>
                    <label class="form-label"><input class="form-check" type="checkbox" name="fsiaddress"  checked="checked">Address</label>
                    <label class="form-label"><input class="form-check" type="checkbox" name="fsidoa"  checked="checked">DOA</label>
                </div>
                <div style="display:block;">
                    <label class="form-label"><input class="form-check" type="checkbox" name="fsidob"  checked="checked">DOB</label>
                    <label class="form-label"><input class="form-check" type="checkbox" name="fsiphoneno"  checked="checked">Phone no</label>
                    <label class="form-label"><input class="form-check" type="checkbox" name="fsiemail"  checked="checked">Email</label>
                    <label class="form-label"><input class="form-check" type="checkbox" name="fsipphoneno"  checked="checked">Parents Phone</label>
                </div>
                    <input type="submit" class="button form-button" value="Get Info">
            </fieldset>
          
        </form>
    </div>
<?php
 }
 else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
 }

}
 else{
     echo'<span class="error">Please sign up and/or login to use the system</span>';
     header('Refresh:1 ,url=login.php');
 }
require_once 'functions/footer.php';?>