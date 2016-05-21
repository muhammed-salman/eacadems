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
*   Created On: 25 Jun, 2015, 12:24:14 PM
*   Author: Muhammed Salman Shamsi
*/
session_start();
echo "<!DOCTYPE html>\n<html>\n<head><meta charset='UTF-8'>";

require_once 'functions/functions.php';

$userstr='(Guest)';

if(isset($_SESSION['user']))
{
    $user=$_SESSION['user'];
    $loggedin=TRUE;
    $userstr="($user)";
}
 else $loggedin=FALSE;
if($loggedin){  
echo "<title>$appname$user</title>".
     "<link rel='stylesheet' href='/ecadems/style/coresheet.css' type='text/css' />".
     " <noscript>
        <div class='error'>Your browser doesn't support or has disabled JavaScript.Please enable javascript to continue</div>
        <br>
      </noscript>". 
     "</head><body>".
     "<div id='header'>"
        . "<div id='logo-image'>"
        . "<img src='/ecadems/images/college_logo.png' width='100px' height='100px'></div>"
        . "<div id='colname'>$colname<br></div>"
        . "</div>";

       echo '<noscript><center><p><h1><font color="red">Err! Something went wrong we are not expecting this.<br>'
        . 'You know javascript is must for this application to work.<br>'
               . 'So what you are wating for ?  Enabled it now!</font></h1></p></center></noscript>';

 
              require_once 'functions/footer.php';
}
 else {
echo <<<_END
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL /ecadems/nojs.php was not found on this server.</p>
<hr>
<address>Apache/2.4.7 (Ubuntu) Server at localhost Port 80</address>
</body></html>
_END;
 }
?>