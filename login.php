<?php ob_start();
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

//require_once 'functions/functions.php';
require_once 'functions/header.php';
echo '<div class="login-box">';      


if($_POST)
{
 if(!$loggedin)
 {
    
    $error=$user=$pass="";    
 if (isset($_POST['username']))
  {
      
    $user = sanitizeString($_POST['username']);
    $pass = sanitizeString($_POST['pass']);
     
    if ($user == "" || $pass == "")
        $error = "<span class='inline-error'>Not all fields were entered</span>";
    else
    {
      $s1="su*!#er";
      $s2="ts&a@s#";
      $token= hash('ripemd128', "$s1$pass$s2");  
      $result = queryMySQL("SELECT userid,fac_id,grid FROM Access
        WHERE userid='$user' AND pass='$token'");
      $row = mysql_fetch_array($result);
      
      if (!$row)
      {
        $error = "<span class='inline-error'>Username or Password
                  invalid</span>";
        //echo ''.$error;
      }
      else
      {
        insertAccessInfo($user);  
        $_SESSION['user'] = $row['userid'];
        $_SESSION['fac_id']=$row['fac_id'];
        $_SESSION['grid'] = $row['grid'];
        $sessionfac_id=$row['fac_id'];
        $loggedin=TRUE;
        echo "<div class='main'>You are now logged in.<br>"
            . "You are now being redirected to home page."
            . "<a href='index.php' style='font-size:1em; color:white;'>Click here</a> to redirect manually</div>";
        
        header("Refresh: 0; url=index.php");
        exit();
      }
    }
  }
 }


 
}
ob_end_flush(); ?>
<?php
if(!$loggedin)
{
//echo "<center><h3>Please enter your details to log in.</h3></center>";
echo <<<_END
    
        <form method="post" action="login.php">

            <div id="logincontainer" class="shadowbox">
                <div><span class="full-title-blackgrad">Login</span></div>
                <div><span><img src='images/college_logo.png' width='70px' height='70px'></span></div>
_END;
                    echo '<div>'.$error.'</div>';
echo <<<_END
                <div>
                    <span><input type="text" name="username" placeholder="Username" 
_END;
                    echo 'value="'.$user.'" ';
                    if($user!="")
                        echo 'class="input-error"';
echo <<<_END
                            required>
                    </span>
                </div>
                <div>
                    <span><input type="password" name="pass" placeholder="Password" 
_END;
                    if($user!="")
                        echo 'class="input-error"';
echo <<<_END
                            required></span>
                </div>
                <div>
                    <span><input type="submit" class="button" value="Sign In"></span>
                </div>
            </div>
        </form>
    </div>

_END;
}
else {
         echo "<div class='main'><h3>You are already logged In as ".$user.
          ". Please <a href='logout.php' style='color:white; font-size:1em;'>Log Out</a> to Sign In as different User </h3></div>";
          echo '</div>';
     header("Refresh: 1; url=index.php");
     //exit();
}
require_once 'functions/footer.php'; 
?>