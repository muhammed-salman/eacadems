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
*   Created On: 21 Jun, 2015, 12:02:04 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
if($loggedin){
    
    if($_SESSION['grid']!=='8'){
        changePass();
        $result=  queryMysql("select userid from Access where fac_id='".$_SESSION['fac_id']."'");
        while ($row = mysql_fetch_array($result)) {
            $userid=$row['userid'];
        }
echo <<<_END
<div id="left">
_END;
echo <<<_END
   </div>
    <div id="right">
        <form method="post" action="changepass.php" onsubmit="return validateUser(this)">
        
        <fieldset class="form">
            <legend class="fit-title-blackgrad">Change Password</legend>
            <div>
                <label class="form-label">Username</label>
                
_END;
if($_SESSION['grid']!=='3')
    echo '<input class="form-input" type="text" id="user" name="user" readonly="true" required value="'.$userid.'"/>';
else{
    echo '<select class="form-input" id="user" name="user"  required>';
    loadUserId();
    echo '</select>';
}        
echo '</div>';
if($_SESSION['grid']!=='3'){
echo <<<_END
            <div>
                <label class="form-label">Enter Old Password</label>
                <input class="form-input" type="password" id="oldpass" name="oldpass" required><span id="passerr"></span>
            </div>
            <div>
                <label class="form-label">Enter New Password</label>
                <input class="form-input" type="password" placeholder="Min 8 characters" id="pass" name="pass" disabled="required" required>
            </div>
            <div>
                <label class="form-label">Confirm Password</label>
                <input class="form-input" type="password" id="cpass" placeholder="Repeat Password" name="cpass" disabled="required" required><br><span id="cpasserr"></span>
            </div>
_END;
}
else{
echo <<<_END
           <div>
                <label class="form-label">Enter New Password</label>
                <input class="form-input" type="password" placeholder="Min 8 characters" id="pass" name="pass"  required>
            </div>
            <div>
                <label class="form-label">Confirm Password</label>
                <input class="form-input" type="password" id="cpass" placeholder="Repeat Password" name="cpass" required><br><span id="cpasserr"></span>
            </div>
_END;
}
echo <<<_END
            <div>
                <input type="submit" class="button form-button" value="Change Password"> 
            </div>
        
        </fieldset>
        </form>
</div>
_END;
}
else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
}

}

 else echo'Please sign up and/or login to use the system';
require_once 'functions/footer.php';
?>
        
