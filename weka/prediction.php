<?php
session_start();
function academic_year()
{
    $month=date('m');
    if($month>=1 && $month<=6){return 'First Half '.date('Y');}
 else {return 'Second Half '.date('Y');}
}
define('__ROOT__', dirname(dirname(__FILE__))); 
//echo __ROOT__;
require_once(__ROOT__.'/functions/connect.php'); 
echo "<!DOCTYPE html>\n<html>\n<head><meta charset='UTF-8'>";
$userstr='(Guest)';
if(isset($_SESSION['user']))
{
    $user=$_SESSION['user'];
    $loggedin=TRUE;
    $userstr="($user)";
}
 else $loggedin=FALSE;
  
echo "<title>$appname$user</title>".
     "<link rel='stylesheet' href='/eacadems/style/coresheet.css' type='text/css' />".
     "<script src='/eacadems/jquery/jquery-1.11.2.js'></script>".
     "<script src='/eacadems/jquery/jquery-ui-1.11.4/jquery-ui.js'></script>".
     "<script src='/eacadems/scripts/assigndependent.js'></script>".
     "<script src='/eacadems/scripts/validate_functions.js'></script>".
     "<script src='/eacadems/scripts/validate.js'></script>".
     "<script src='/eacadems/scripts/misc.js'></script>".
     '<meta name="viewport" content="width=device-width,initial-scale=1" />'.
     " <noscript>
      Your browser doesn't support or has disabled JavaScript
    </noscript>". 
     "<noscript><meta http-equiv='refresh' content='0;url=/eacadems/nojs.php'></noscript>".   
     "</head><body>".
     "<div id='header'>"
        . "<div class='hcontainer'>"
            . "<div id='applogo-name'>"
                . "<img src='/eacadems/images/erp_logo.png' class='logo-image'>"
                . "<div id='appname'>".$appname."</div>"
            . "</div>"
            . "<div id='collogo-name'>"
                . "<img src='/eacadems/images/college_logo.png' class='collogo-image'>"
                . "<div id='colname'>".$colname."</div>"
            . "</div>"
        . "</div>";
        
if($loggedin){
            
    echo  "<ul class='menu'>"
            ."<span id='headerDate'>".date('d-m-Y')." (".academic_year().")</span>"
            . "<span id='headerapp'>$appname$userstr</span>"
            . "<li><a class='menubtn btnwhite' href='/eacadems/contact.php'>Contact Us</a></li>"
            . "<li><a class='menubtn btnwhite' href='/eacadems/logout.php'>Logout</a></li>"
            ."<li><a class='menubtn btnwhite' href='/eacadems/index.php'>Home</a></li>"
            . "<li class='nav-menu'>"
            ."<span></span><span></span><span></span>" 
            . "</li>"
            . "</ul>";
}
    echo "<link rel='stylesheet' href='/eacadems/jquery/jquery-ui-themes-1.11.4/themes/smoothness/jquery-ui.css' type='text/css' />";
 
if(!$loggedin){
    echo '<div class="banner">Welcome To '.$appname.'</div>';
}
echo '</div>';
$checkmark='<span class="checkmark"><div class="checkmark_circle"></div><div class="checkmark_stem"></div>
    <div class="checkmark_kick"></div></span>';

echo '<div class="container">';

$path=" export CLASSPATH=/var/www/html/eacadems/weka/weka.jar; "
        . "export CLASSPATH=\$CLASSPATH:/var/www/html/eacadems/weka;  "
        . "export CLASSPATH=\$CLASSPATH:/usr/share/java/mysql-connector-java-5.1.28.jar; "
        . "export CLASSPATH=\$CLASSPATH:/usr/local/netbeans-8.1/ide/modules/ext/mysql-connector-java-5.1.23-bin.jar;";

$path=$path." javac Predictor.java; "." java Predictor";
// echo $path;
echo nl2br(shell_exec($path));

echo '</div>';
echo '<div id="footer">';
echo '<center>'
        . '<a href="http://aiktc.org/school-of-engineering/computer-engineering/">&copy; Muhammed Salman Shamsi</a>';
echo '<a href="http://www.flaticon.com">Dashboard Icons designed by Freepik & others</a>'
. '<a href="/eacadems/notice.php">Academic Public License</a>';
echo '</center>';
echo '</div>';
echo '</body>';
echo '</html>';
?>
