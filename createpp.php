<?php
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

require_once 'functions/header.php';
if($loggedin){
         if($_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
             insertPracPlan();
echo <<<_END
    <div id="left">
_END;
echo '<div class="info-box"><div class="full-title-redgrad slidebutton">Important Guidelines<span class="arrow-up"></span></div>'
      . '<ul class="slidebox">';
echo '<li>'.$checkmark.' This form should be filled by subject incharge strictly, only if he is taking any batch of practicals.</li>'
     .'<li>'.$checkmark.' If subject incharge does not take any batch then any other practical incharge can fill this form based on common agreement.</li>'
     .'<li>'.$checkmark.' This form should be filled only once. Hence all the practical incharge will have same format for plan</li>'
     .'<li>'.$checkmark.' Enter the number of experiments as per university syllabus strictly.</li>'
     .'<li>'.$checkmark.' If you are subject incharge and want to have sub-experiments'
        . ' than you should put total number of sub-experiments as No. of experiments</li>'
     .'<li>'.$checkmark.' For above case it is neccessary that all practical Incharge\'s'
        .' follows the same pattern</li>'
        . '</ul>'
        . '</div>';
echo <<<_END
   </div>
    <div id="right">    
                 
        <form method="post" action="createpp.php" onsubmit='return confirm("Are you sure you want to create a Practical Plan.You will not be able to undo this operation.")'>
        
        <fieldset class="form">
            <legend class="fit-title-blackgrad">Practical Plan Info</legend>
           
              <input type="hidden" name="ppyear" id="ppyear" class="teachyear form-input" required value="
_END;
                    echo academic_year();
echo <<<_END
" readonly="true"/>
            <div>
                <label class="form-label">Select Subject</label>
                <select name="ppsub" id="ppsub" class="teachsub form-input" required>
_END;
                loadTeachesCourse(0,academic_year());
echo <<<_END
                </select>
            </div>
            <div>
                <label class="form-label">Enter No. of Exp.</label>
                <input class="form-input" name="ppexp" type="number" min=1 max=20 required/>
            </div>
            <input type="submit" class="button form-button" value="Load">
           </fieldset>
          </div>
_END;
        
         echo '<input type="hidden" name="ffac_id" id="ffac_id" value="'.$_SESSION['fac_id'].'">';
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
       