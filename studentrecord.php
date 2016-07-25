<?php

/*                                             License
*   The following license governs the use of CollegeERP in academic and educational environments. Commercial use requires a commercial license from Muhammed Salman Shamsi.
*   ACADEMIC PUBLIC LICENSE
*   Copyright (C) 2014 - 2015  Muhammed Salman Shamsi.
*   FOR DETAILED TERMS AND CONDITION SEE LICENSE.TXT FILE
*   NO WARRANTY
*   BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.
*   IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED ON IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.
*   END OF TERMS AND CONDITIONS
*   [license text: http://www.omnetpp.org/intro/license]   
*   Created On: 23 Jun, 2015, 8:15:36 PM
*   Author: Muhammed Salman Shamsi
*/

require_once 'functions/header.php';
if($loggedin){        
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='2'||$_SESSION['grid']==='6'){
                     
?>
    <div id="right" style="width:100%;">    
        <form method="post" id="form1">
          
              <img class="search-img" src="images/search_logo.png"/>
              <input type="text" name="stext" id="stext" placeholder="Search......" style="width:50%;vertical-align:middle;"/>
              <button class="button" id="ssearchbtn" name="ssearchbtn" style="width:5%;height:1.75em;
                      padding: 0;vertical-align:middle;">
              <span class="searchico"></span>
              </button>
              <div id="search-container"></div>
          
        </form>   
    </div>
   <?php
 }
 else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
 }

}

 else echo'<span class="error">Please sign up and/or login to use the system</span>';
require_once 'functions/footer.php';?>