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
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'||$_SESSION['grid']==='8'){
        insertStudent();

        echo '<div id="left">';
        echo '<div class="info-box">'
        . '<div class="full-title-redgrad slidebutton">Important Guidelines<span class="arrow-up"></span></div>'
            . '<ul class="slidebox">'
                .'<li>'.$checkmark.' Please Verify the data before submitting the form</li>'
                .'<li>'.$checkmark.' Name should be written in following sequence<br>Surname FirstName MiddleName</li>'
                .'<li>'.$checkmark.' Please provide correct Phone / Mobile Number<br>It will be verified</li>'
                .'<li>'.$checkmark.' Please provide correct and working E-mail ID<br>It is very important for online communication.</li>'
                .'<li>'.$checkmark.' Disciplinary action will be taken if information is found to be Incorrect.</li>'
            .'</ul>'
            .'</div></div>';
?>   

    <div id="right">   
     <form method="post" action="studentregister.php" onsubmit="return validateStudent(this)">
         <fieldset class="form">
           <legend class="fit-title-blackgrad">Student Registration</legend>
            
           <div> 
                <label class="form-label">Roll no</label>
                <input class="form-input"  type="text" tabindex="1" maxlength="10" placeholder="Your Roll No, Ex: 14CO00" name="srollno" required>
           </div>
           <div>
                <label class="form-label">Name</label>
                <input class="form-input"  type="text" tabindex="2" maxlength="45" name="sname" placeholder="Your full Name [Surname First]" required>
           </div>
           <div> 
                <label class="form-label">Gender</label>
                    <span class="form-input">
                        <label class="form-label"><input class="form-radio"  type="radio" tabindex="3" name="sgender" id="smale" value="MALE"  required> Male</label>
                        <label class="form-label"><input class="form-radio"  type="radio" tabindex="4" name="sgender" id="sfemale" value="FEMALE" required> Female</label>
                    </span>
           </div>
           <div>
                <label class="form-label">Permanent Address</label>
                    <textarea  tabindex="3" rows="3" cols="23" class="form-input peradd" maxlength="150"  name="saddress" placeholder="Your Permanent Address" wrap="soft" required></textarea>  
           </div>
            <div>
                <label class="form-label">
                    <input type="checkbox" name="cfaddcheck" class="form-check addcheck">
                    Same as above
                </label>
           </div>
           <div>
                <label class="form-label">Residential Address</label>
                <textarea  tabindex="3" rows="3" cols="23" class="form-input resiadd" maxlength="150"  name="sraddress" placeholder="Your Residential Address" wrap="soft" required></textarea>  
           </div>
           <div> 
                <label class="form-label">Semester</label>
                <select class="form-input"  tabindex="4" name="ssem" size=1  required>
                        <?php                        loadSem()?>
                </select>
            </div>
            <div>
                <label class="form-label">Date of Admission</label>
                <input  type="text" tabindex="5" class="form-input datepicker" placeholder="dd/mm/yyyy" name="sdoa" required >
            </div>
            <div>
                <label class="form-label">Date of Birth</label>
                <input type="text" tabindex="6" class="form-input datepicker" placeholder="dd/mm/yyyy" name="sdob" required >
            </div>
            <div>
                <label class="form-label">Your Mobile Number</label>
                <input class="form-input"  type="tel" tabindex="7" maxlength="12" placeholder="10/12 Digits Phone/Mobile No." name="sphoneno" id="sphoneno" required>
                    <br><span id="sphoneerr"></span>
            </div> 
            <div>
                <label class="form-label">Parents Mobile Number</label>
                <input class="form-input"  type="tel" tabindex="8" maxlength="12" placeholder="10/12 Digits Phone/Mobile No." name="spphoneno" id="spphoneno" required>
                    <br><span id="spphoneerr"></span>
            </div> 
            <div>
                <label class="form-label">Department</label>
                <select class="form-input"  name="sdept"  tabindex="9" size="1" required>
                        <?php loadDept(1)?>
                    </select>
            </div>
            <div>
                <label class="form-label">Email</label>
                <input class="form-input"  type="email" tabindex="10" maxlength="45" name="semail" Placeholder="example@example.com" required>
                
            </div>
            <div>
                    <label class="form-label">Current Year</label>
                    <input class="form-input"  type="text" name="syear" required="required" readonly="readonly" value="<?php echo academic_year(); ?>"/>
            </div>
            <div>
                    <label class="form-label">Select Batch</label>
                        <select class="form-input"  name="sbatch" tabindex="11" required>
                            <option value="">------</option>
                            <option value="1">B1</option>
                            <option value="2">B2</option>
                            <option value="3">B3</option>
                            <option value="4">B4</option>
                        </select>   
            </div>
                <input  type="submit" tabindex="12" class="button form-button" value="Register">
           </fieldset>
       </form>
    </div>
<?php }
 else {echo '<br><br><center><span class="error">Access Denied! You are not authorized to view this section</span></center>';}
}
else {
      echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';
}
     require_once 'functions/footer.php'; 
?>