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
*   Created On: 30 Jun, 2015, 11:08:04 AM
*   Author: Muhammed Salman Shamsi
*/

require_once 'functions/header.php';
insertFacultyStaff();
/*if($loggedin)
{
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='2'||$_SESSION['grid']==='9'){*/
echo '<div id="left">';
echo '<div class="info-box">'
        . '<div class="full-title-redgrad">Important Guidelines</div>'
            . '<ul>'
                .'<li>'.$checkmark.' Employee ID could be assigned as Faculty / Staff ID</li>'
                .'<li>'.$checkmark.' Name Should be written in following sequence.<br>FirstName MiddleName Surname</li>'
                .'<li>'.$checkmark.' Photo Should be of Passport size in .jpg/.png format only.</li>'
                .'<li>'.$checkmark.' Max photo upload size is 3MB.</li>'
            . '</ul>'
    . '</div>';
echo <<<_END
   </div>
    <div id="right">    
      <form method="post" enctype="multipart/form-data" action="createfacultystaff.php"  onsubmit="return validateFaculty(this)">
        
          <fieldset class="form" >
            
            <legend class="fit-title-blackgrad">Faculty / Staff Registration</legend>
            
            <div>
                <label class="form-label">Faculty/Staff ID</label>
                <input class="form-input" type="text" name="cfsfacid" placeholder="Alloted Unique ID" required>
            </div>
            <div>
                <label class="form-label">Name</label>
                <input class="form-input" type="text" name="cfsname" placeholder="Your Full Name" required>
            </div>
            <div>
                <label class="form-label">Job Type</label>
                
                    <select name="cfsjob"required class="form-input" required="true">
                        <option value="">------</option>
                        <option value="Jr. Clerk">Junior Clerk</option>
                        <option value="Sr. Clerk">Senior Clerk</option>
                        <option value="Assistant Professor">Assistant Professor</option>
                        <option value="Associate Professor">Associate Professor</option>
                        <option value="Professor">Professor</option>
                    </select>
            </div>
            <div>
                <label class="form-label">Permanent Address</label>
                
                    <textarea placeholder="Your Full Permanent Address" class="peradd form-input" rows=2 cols=23 required name="cfspaddress" wrap="soft"></textarea>  
            </div>
            <div>
                <input type="checkbox" name="cfaddcheck" class="addcheck form-check">
                <label class="form-label">Same as above</label>
            </div>
            <div>
                <label class="form-label">Residential Address</label>
                
                    <textarea placeholder="Your Full Residential Address" class="resiadd form-input" rows=2 cols=23 required name="cfsraddress" wrap="soft"></textarea>  
            </div>
            <div>
                <label class="form-label">Phone Number (Primary)</label>
                <input class="form-input" type="tel" placeholder="10/12 Digits Mobile Number" maxlength="12" required name="cfsphonenop">
            </div>
            <div>
                <label class="form-label">Phone Number (Secondary)</label>
                <input class="form-input" type="tel" placeholder="Type Same as Above if N/A" maxlength="12" required name="cfsphonenos">
            </div>
            <div>
                <label class="form-label">Email</label>
                <input class="form-input" type="email" placeholder="example@example.com" required name="cfsemail">
            </div>
            <div>
                <label class="form-label">Qualification</label>
                <select name="cfsqual" class="form-input" required="true">
                                    <option value="">------</option>
                                    <option value="SSC/Metric">SSC/Metric</option>
                                    <option value="HSC/Post Metric">HSC/Post Metric</option>
                                    <option value="B.Sc">B.Sc</option>
                                    <option value="B.Com">B.Com</option>
                                    <option value="B.A">B.A</option>
                                    <option value="B.E/B.Tech">B.E/B.Tech</option>
                                    <option value="B.C.A">B.C.A</option>
                                    <option value="M.Com">M.Com</option>
                                    <option value="M.Sc">M.Sc</option>
                                    <option value="M.C.A">M.C.A</option>
                                    <option value="M.E/M.Tech">M.E/M.Tech</option>
                                    <option value="P.hd">P.hd</option>
                    </select>
                </label>
            </div>
            <div>
                <label class="form-label">Experience</label>
                <input class="form-input" type="number" placeholder="Experience in Years" name="cfsexp" min="0" required>
            </div>
            <div>    
                <label class="form-label">Date of Joining</label>  
                <input class="form-input" type="text" class="datepicker" placeholder="dd/mm/yyyy" name="cfsdoj"  required>
            </div>
            <div>
               <label class="form-label">Date of Birth</label>
   <input class="form-input" type="text" class="datepicker" placeholder="dd/mm/yyyy" name="cfsdob" required>
            </div>
            
            <div>
                <label class="form-label">Salary</label>
                <input class="form-input" type="number" name="cfssalary" min="0" placeholder="renumeration" required="true">&nbsp;
                    <!--<br><font size="2">[Please Enter NULL if Salary is not applicable.]</font>-->
            </div>
            <div>
                <label class="form-label">Department</label>
                
                    <select name="cfsdept" required="true" class="form-input">
_END;
                    loadDept(1);
echo <<<_END
                    </select>
                </label>
            </div>
            <div>
                <label class="form-label">Areas of Interest</label>
                <textarea class="form-input" name="cfareas" placeholder="values seprated by semicolon(;)" required="true"></textarea>
            </div>
            <div>
                <label class="form-label">Upload Your Photo[<font size="2">Max Size 3 MB</font>]</label>    
                
                    <input class="form-input" type="file" name="image" required="true"/>
            <div>
                <input type="submit" class="button form-button" value="Register">
            </div>
          </fieldset>
            
     </form>  
     </div>
       
_END;
 /*}
  else {
      echo '<br><br><span class="error">Access Denied! You are not authorized to view this section</span>';
      
  }
}
 else echo'<br><br><span class="error">Please sign up and/or login to use the system</span>';
 */
 
 require_once 'functions/footer.php';  
?>