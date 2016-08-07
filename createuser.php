
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
*   Author: MUhammed Salman Shamsi
*/

require_once 'functions/header.php';
if($loggedin){
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='9'){
insertUser();  
echo '<div id="left">';
echo '<div class="info-box">'
        . '<div class="full-title-redgrad slidebutton">Important Guidelines<span class="arrow-up"></span></div>'
            . '<ul class="slidebox">'
                .'<li>'.$checkmark.' All username\'s should follow a standard naming scheme.</li>'
                .'<li>'.$checkmark.' Please do not assign username randomly.</li>'
                .'<li>'.$checkmark.' It is recommended that username is based on First Name and Surname of person seprated by underscore ( _ ).</li>'
                .'<li>'.$checkmark.' Password should be minimum of 8 characters and must have atleast one of each of the following'
                    . 'UPPERCASE alphabet,lowercase alphabet,digits and special characters such as @ # $ & * ! etc .</li>'
            . '</ul>'
    . '</div>';
echo <<<_END
   </div>
    <div id="right">    

        <form method="post" action="createuser.php" onsubmit="return validateUser(this)">
        
        <fieldset class="form">
            <legend class="fit-title-blackgrad">Create Account</legend>
            <div>
              <label class="form-label">Select Department</label>
              <select name="cudept" class="facstaffdept form-input" required>
_END;
    loadDept(1);
echo <<<_END
                </select>
            </div>
            <div>
                <label class="form-label">Select Faculty/Staff</label>
                <select name="cufsname" class="facstaff form-input" required>
                    <option value="">-----</option>
                    </select>
            </div>
            <div><span id="cufserr" class="inline-error"></div>
            <div>
                <label class="form-label">Enter Username</label>
                <input class="form-input" type="text" placeholder="Min 5 characters" id="user" name="user" disabled="true" required><span id="usererr"></span>
            </div>
            <div>
                <label class="form-label">Enter Password</label>
                <input class="form-input" type="password" placeholder="Min 8 characters" id="pass" name="pass" required>
            </div>
            <div>
                <label class="form-label">Confirm Password</label>
                <input class="form-input" type="password" id="cpass" placeholder="Repeat Password" name="cpass" required><span id="cpasserr"></span>
            </div>
            <div>
              <label class="form-label">Select Type</label>
              <select name="cutype" class="form-input" id="cutype" required>
_END;
loadGroup();
if($_SESSION['grid']==='3')
    echo "<option value='3'>Admin</option>";
echo <<<_END
                  </select>
            </div>
            <input type="submit" class="button form-button" value="Create Account"> 
        
        </fieldset>
        </form>
        </div>
        
_END;
}
else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
}

}
 else{
     echo'<span class="error">Please sign up and/or login to use the system</span>';
     header('Refresh:1 ,url=login.php');
 }
require_once 'functions/footer.php';
?>
        
