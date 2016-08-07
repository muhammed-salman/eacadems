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
        insertStudentDetails();
        echo '<div id="left">';
        echo '<div class="info-box"><div class="full-title-redgrad">Important Guidelines</div>'
            . '<ul>'
                .'<li>'.$checkmark.' Please Verify the data before submitting the form</li>'
                .'<li>'.$checkmark.' Name should be written in following sequenceSurname FirstName MiddleName</li>'
                .'<li>'.$checkmark.' Please provide correct Phone / Mobile NumberIt will be verified</li>'
                .'<li>'.$checkmark.' Please provide correct and working E-mail IDIt is very important for online communication.</li>'
                .'<li>'.$checkmark.' Disciplinary action will be taken if information is found to be Incorrect.</li>'
            . '</ul>'
            . '</div>'
            . '</div>';
?>
    <div id="right">   
     <form method="post" action="studentdetails.php">
         <fieldset class="form">
            <legend class="fit-title-blackgrad">Student Details</legend> 
            <fieldset class="form fieldset-sub">
                <legend class="fit-title-blackgrad">Personal Details</legend> 
                <div> 
                    <label class="form-label">Roll no</label>
                    <input class="form-input" type="text" tabindex="1" maxlength="10" placeholder="Your Roll No, Ex: 14CO00" name="sdrollno" id="sdrollno" required>
                    <span id="rollerr"></span>
                </div>
                <div>
                    <label class="form-label">Time Spent on Study (hrs/day)</label>
                    <input class="form-input" type="number" tabindex="2" name="sdstudy" min="0" max="12" required value="0">
                </div>    
                <div>
                    <label class="form-label">Physical Health</label>
                    <span class="form-input">
                        <label class="form-label"><input class="form-radio" type="radio" tabindex="3" name="sdhealth" id="sdpoor" value="poor" required>Poor</label> 
                        <label class="form-label"><input class="form-radio" type="radio" tabindex="4" name="sdhealth" id="sdaverage" value="average" required>Average</label> 
                        <label class="form-label"><input class="form-radio" type="radio" tabindex="5" name="sdhealth" id="sdgood" value="good" required>Good</label>
                        <label class="form-label"><input class="form-radio" type="radio" tabindex="6" name="sdhealth" id="sdexcellent" value="excellent" required>Excellent</label>
                    </span>
           </div>
                <div style="display: block;">
                <label class="form-label">Did you take private tution classes ?</label>
                <span class="form-input">
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="7" name="sdclasses" id="sdclassyes" value="yes" required>Yes</label> 
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="8" name="sdclasses" id="sdclassno" value="no" required>No</label>                 
                </span>    
           </div>
           <div> 
                <label class="form-label">Source of fees</label>
                <span class="form-input">
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="9" name="sdsource" id="sdparents" value="parents" required>Parents</label>
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="10" name="sdsource" id="sdrealtives" value="relatives" required>Relatives</label>
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="11" name="sdsource" id="sdscholar" value="scholarship" required>Scholarship</label>
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="12" name="sdsource" id="sdmultiple" value="multiple" required>Multiple Sources</label>
                </span>
            </div>
            <div>
                <label class="form-label">Have you ever got the educational drop in engg?</label>
                <span class="form-input">
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="13" name="sddrop" id="sddropyes" value="yes" required>Yes</label> 
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="14" name="sddrop" id="sddropno" value="no" required>No</label>                
                </span>    
            </div>
            <div>
                <label class="form-label">Please rate the overall Campus Environment?</label>
                <span class="form-input">
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="15" name="sdcampus" id="sdworts" value="1" required>Worst</label>
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="16" name="sdcampus" id="sdbad" value="2" required>Not good</label>
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="17" name="sdcampus" id="sdneutral" value="3" required>Neutral</label>
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="18" name="sdcampus" id="sdcampusgood" value="4" required>Good</label>
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="19" name="sdcampus" id="sdbest" value="5" required>Best</label>
                </span>    
            </div>
            <div>
                <label class="form-label">Total time spent in travelling to college (in mins)</label>
                
                <input class="form-input" type="number" tabindex="20" min="0" max="720" step="1" name="sdtravel" id="sdtravel" required>
            </div>
            <div>
                <label class="form-label">Traveling Medium</label>
                
                    <select class="form-input" name="sdtrav_med"  tabindex="" required>
                        <option value="">------</option>
                        <option value="">ST/Public Bus</option>
                        <option value="1 to 1.99 Lakhs">1 to 1.99 Lakhs</option>
                        <option value="2 to 2.99 Lakhs">2 to 2.99 Lakhs</option>
                        <option value="3 to 3.99 Lakhs">3 to 3.99 Lakhs</option>
                        <option value="4 to 4.99 Lakhs">4 to 4.99 Lakhs</option>
                        <option value="5 Lakhs and above">5 Lakhs and above</option>
                    </select>
            </div>
            <div> 
                <label class="form-label">Your's Residential district name</label>
                
                    <input class="form-input" type="text" tabindex="" maxlength="20" placeholder="Ex: THANE" name="sdloc" id="sdloc" required>
            </div>
            <div>
                <label class="form-label">what type of area do you stay?</label>
                <span class="form-input">
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="13" name="sdloc_type" id="sdrural"  value="RURAL" required>Rural</label>
                    <label class="form-label"><input class="form-radio" type="radio" tabindex="14" name="sdloc_type" id="sdurban" value="URBAN" required>Urban</label>                
                </span>    
            </div>
         </fieldset>
         <fieldset class="form fieldset-sub">
            <legend class="fit-title-blackgrad">Family Details</legend>
            <div>
                <label class="form-label">Family Type</label>
                <span class="form-input">
                    <label class="form-label" style="white-space: nowrap;"><input class="form-radio" type="radio" tabindex="21" name="sdfamily" id="sdsimple" value="nuclear" required>Nuclear / Simple Family</label>
                    <label class="form-label"><input class="form-radio" type="radio" name="sdfamily" tabindex="22" id="sdjoint" value="joint" required>Joint Family</label>
                    <label class="form-label"><input class="form-radio" type="radio" name="sdfamily" tabindex="23" id="sdextend" value="extended" required>Extended Family</label>
                </span>    
            </div> 
            <div>
                <label class="form-label">Parents Annual Income</label>
                
                    <select name="sdincome"  tabindex="24" class="form-input" required>
                        <option value="">------</option>
                        <option value="Less Than 1 Lakh">Less Than 1 Lakh</option>
                        <option value="1 to 1.99 Lakhs">1 to 1.99 Lakhs</option>
                        <option value="2 to 2.99 Lakhs">2 to 2.99 Lakhs</option>
                        <option value="3 to 3.99 Lakhs">3 to 3.99 Lakhs</option>
                        <option value="4 to 4.99 Lakhs">4 to 4.99 Lakhs</option>
                        <option value="5 Lakhs and above">5 Lakhs and above</option>
                    </select>
            </div>
            <div>
                <label class="form-label">Fathers Education</label>
                
                    <select name="sdfatheredu"  tabindex="25" class="form-input" required>
                        <option value="">------</option>
                        <option value="0">Illetrate</option>
                        <option value="1">Metric</option>
                        <option value="2">Post Metric</option>
                        <option value="3">Graduate</option>
                        <option value="4">Post Graduate</option>
                        <option value="5">Phd</option>
                    </select>
                
            </div>
            <div>
                    <label class="form-label">Mothers Education</label>
                    
                        <select name="sdmotheredu"  tabindex="26" class="form-input" required>
                            <option value="">------</option>
                            <option value="0">Illetrate</option>
                            <option value="1">Metric</option>
                            <option value="2">Post Metric</option>
                            <option value="3">Graduate</option>
                            <option value="4">Post Graduate</option>
                            <option value="5">Phd</option>
                        </select>
            </div>
            <div>
                    <label class="form-label">Fathers Occupation</label>
                    
                       <input class="form-input" type="text" tabindex="27" name="sdfaoccup" required/> 
            </div>
            <div>
                    <label class="form-label">Mothers Occupation</label>
                    
                        <input class="form-input" type="text" tabindex="28" name="sdmoccup" required/>
            </div>
            <div>
                    <label class="form-label">Challanges in Family</label>
                    
                        <input class="form-input" type="text" tabindex="29" name="sdchallenge" required/>
            </div>
            <div>
                    <label class="form-label">Cast</label>
                    
                        <input class="form-input" type="text" tabindex="30" name="sdcast" required/>
            </div>
            <div>
                    <label class="form-label">Mother tongue</label>
                    
                        <select name="sdlang"  tabindex="31" class="form-input" required>
                            <option value="">------</option>
                            <option value="Assamese">Assamese</option>
                            <option value="Bengali">Bengali</option>
                            <option value="Bodo">Bodo</option>
                            <option value="Dogri">Dogri</option>
                            <option value="Gujarati">Gujarati</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Kannada">Kannada</option>
                            <option value="Kashmiri">Kashmiri</option>
                            <option value="Konkani">Konkani</option>
                            <option value="Maithili">Maithili</option>
                            <option value="Malayalam">Malayalam</option>
                            <option value="Manipuri">Manipuri</option>
                            <option value="Marathi">Marathi</option>
                            <option value="Nepali">Nepali</option>
                            <option value="Odia">Odia</option>
                            <option value="Punjabi">Punjabi</option>
                            <option value="Sanskrit">Sanskrit</option>
                            <option value="Santali">Santali</option>
                            <option value="Sindhi">Sindhi</option>
                            <option value="Tamil">Tamil</option>
                            <option value="Telugu">Telugu</option>
                            <option value="Urdu">Urdu</option>
                        </select>
            </div>
            <div>
                    <label class="form-label">Orphan</label>
                    <span class="form-input">
                        <label class="form-label"><input class="form-radio" type="radio" tabindex="32" name="sdorphan" id="sdorpyes"  value="yes" required>Yes</label>
                        <label class="form-label"><input class="form-radio" type="radio" tabindex="33" name="sdorphan" id="sdorpno" value="no" required>No</label> 
                    </span>    
            </div>
         </fieldset>
         <fieldset class="form fieldset-sub">
            <legend class="fit-title-blackgrad">Academic Details</legend>
            <div>
                    <label class="form-label">Number of live KTs</label>
                    
                        <input class="form-input" type="number" tabindex="34" name="sdkt" min="0" max="12" required/>
            </div>
            <div>
                    <label class="form-label">SSC Percentage</label>
                    
                        <input class="form-input" type="number" tabindex="35" name="sdssc" min="0" max="100" step="0.01" required/>
                       
            </div>
            <div>
                    <label class="form-label">HSC Percentage</label>
                    
                        <input class="form-input" type="number" tabindex="36" name="sdhsc" min="0" max="100" step="0.01" required/>
                       
            </div>
            <div>
                    <label class="form-label">Medium of Education</label>
                    <span class="form-input">
                        <label class="form-label"><input class="form-radio" type="radio" tabindex="37" name="sdmedium" id="sdeng" value="english" required>English</label>
                        <label class="form-label"><input class="form-radio" type="radio" tabindex="38" name="sdmedium" id="sdother" value="vernacular" required>Vernacular</label>
                    </span>    
            </div>
            <div>
                    <label class="form-label">Admission Type</label>
                    
                        <select name="sdadmission"  tabindex="39" class="form-input" required>
                            <option value="">------</option>
                            <option value="CAP">CAP</option>
                            <option value="Minority">Minority</option>
                            <option value="Management">Management</option>
                        </select>
            </div>
        </fieldset>
            <br>
                <input type="submit" tabindex="40" class="button form-button" value="Submit">
     </fieldset>
            
        
     </form>
    </div>
<?php }
 else {echo '<span class="error">Access Denied! You are not authorized to view this section</span>';}
}
else {
      echo'<span class="error">Please sign up and/or login to use the system</span>';
}
     require_once 'functions/footer.php'; 
?>