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
*   Created On: 19 Jun, 2015, 9:24:29 AM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
     if($loggedin)
     {
         if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='2'||$_SESSION['grid']==='7'){

echo <<<_END
        <div id="right">
            <div name="wrapper" id="wrapper" class="scrollwrapper">
            <form method="post">
        <fieldset class="form">
            <legend class="fit-title-blackgrad">Attendence Sheet Selection</legend>
             <input type="hidden" name="asyear" id="asyear" class="teachyear form-input" required value="
_END;
                    echo academic_year();
echo <<<_END
" readonly="true"/>
_END;
if($_SESSION['grid']=='3'){

echo <<<_END
    
            <div>
                <label class="form-label">Select Department</label>
                <select class="form-input" name="asdept" id="asdept" required>
_END;
loadDept(1);
echo <<<_END
                </select>
            </div>
_END;
}
else{
    echo '<input type="hidden" name="asdept" id="asdept" value="'.loadFacultyDept().'"/>';
}
if($_SESSION['grid']=='3' || $_SESSION['grid']==='7'){
echo <<<_END
            <div>
                <label class="form-label">Select Semester</label>
                
                    <select class="form-input" name="assem" id="assem" required>
_END;
loadSem();
echo <<<_END
                    </select>
            </div>
_END;
}
    
echo <<<_END
            <div>
                <label class="form-label">Select Subject</label>
                <select class="attsub form-input" name="assub" id="assub" required>
_END;
if($_SESSION['grid']=='5'){    loadTeachesCourse('none',  academic_year());}
echo <<<_END
                    </select>
            </div>
            <div>
                <label class="form-label">Type</label>
                <span class="form-input">
                    <input type="radio" class="form-radio" name="asthpr" value=1 required><label class="form-label">Theory</label>
                    <input type="radio" class="form-radio" name="asthpr" value=0 required><label class="form-label">Practical</label>
                </span>    
            </div>

            <div>
                <button class="button form-button" name="attsheet" id="attsheet">Load</button>
            </div>
                    
           </fieldset>
_END;
          echo '<input type="hidden" name="ffac_id" id="ffac_id" value="'.$_SESSION['fac_id'].'" />';
          echo '<input type="hidden" name="title" id="title" value=""/>'; 
          echo '</form>';
        echo '</div>'; 
        echo '</div>';
 
    
             
     }
     else {
      echo '<span clas="error">Access Denied! You are not authorized to view this section</span>';    
    }

}

 else echo'Please sign up and/or login to use the system';
  require_once 'functions/footer.php';
?>


