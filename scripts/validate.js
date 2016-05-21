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

 function validateCourse(form)
            {   var fail="";
                fail += validateCourseId(form.cid.value);
                fail += validateTitle(form.ctitle.value);
                fail += validateAbbrv(form.cabbrv.value);
                fail += validateCombo(form.csem.value);
                fail += validateObjectives(form.cobj.value);
                fail += validateOutcomes(form.cout.value);
                fail += validateCombo(form.cdept.value);
                fail += validateMarks(form.cpr.value);
                fail += validateMarks(form.cor.value);
                fail += validateMarks(form.cth.value);
                fail += validateMarks(form.ctw.value);
                fail += validateMarks(form.cia.value);
                fail += validateCredit(form.cthcr.value);
                fail += validateCredit(form.cprcr.value);
                fail += validateCredit(form.ctutcr.value);
                fail += validateHours(form.cthhrs.value);
                fail += validateHours(form.cprhrs.value);
                fail += validateHours(form.ctuthrs.value);
                if (fail==="") 
                    return true;
                else 
                { 
                    alert(fail); 
                    return false;
                }
            }
    
     function validateDept(form)
            {   var fail="";
                fail += validateDeptId(form.dept_id.value);
                fail += validateName(form.dname.value);
                fail += validateIntake(form.dintake.value);
                fail += validateMonthYear(form.destd.value);
                if (fail==="") 
                    return true;
                else 
                { 
                    alert(fail); 
                    return false;
                }
            }
            
     function validateFaculty(form)
            {   var fail="";
                fail += validateFacultyId(form.cfsfacid.value);
                fail += validateName(form.cfsname.value);
                fail += validateAddress(form.cfspaddress.value);
                fail += validateAddress(form.cfsraddress.value);
                fail += validatePhoneno(form.cfsphonenop.value);
                fail += validatePhoneno(form.cfsphonenos.value);
                fail += validateEmail(form.cfsemail.value);
                fail += validateExperience(form.cfsexp.value);
                fail += validateDate(form.cfsdoj.value);
                fail += validateDate(form.cfsdob.value);
                fail += validateSalary(form.cfssalary.value);
               
                if (fail==="") 
                    return true;
                else 
                { 
                    alert(fail); 
                    return false;
                }
            }
      function validateStudent(form)
            {   var fail="";
                fail += validateRollno(form.srollno.value);
                fail += validateName(form.sname.value);
                fail += validateAddress(form.saddress.value);
                fail += validateDate(form.sdoa.value);
                fail += validateDate(form.sdob.value);
                fail += validatePhoneno(form.sphoneno.value);
                fail += validatePhoneno(form.spphoneno.value);
                fail += validateEmail(form.semail.value);
                
                if (fail==="") 
                    return true;
                else 
                { 
                    alert(fail); 
                    return false;
                }
            }
       
       function validateUser(form)
            {   var fail="";
                fail += validateUsername(form.user.value);
                fail += validatePassword(form.pass.value);
                fail += validatePassword(form.cpass.value);
                
                if (fail==="") 
                    return true;
                else 
                { 
                    alert(fail); 
                    return false;
                }
            }
            
       function confirmSubmit()
            {
                
                return confirm('Are you sure you want to submit the records?'); 
           
            }    
            
        function validateTestMarks(form)
        {
            
            var tmagg=document.getElementsByClassName("tmagg");
            var tmroll=document.getElementsByClassName("tmroll");
            var i,flag8,flag7,msg="";
            msg+="ARE YOU SURE YOU WANT TO SUBMIT?\n";
            msg+="YOU WILL NOT BE ABLE TO MODIFY THE MARKS LATER\n\n";
            for(i=0; i < tmagg.length;i++)
            {
              if(parseInt(tmagg[i].value)==7)
              {
                  msg +=""+tmroll[i].value+",";
                  flag7=1; 
              }
            }
            if(flag7===1)
                msg +=" aggregate is 7\n\n";
            for(i=0; i < tmagg.length;i++)
            {
              if(parseInt(tmagg[i].value)<8)
              {
                  msg +=""+tmroll[i].value+",";
                  flag8=1; 
              }
            }
            if(flag8===1)
                msg +=" aggregate is less than 8\n";
            if(confirm(msg))
                submitForm('tm.php');
            else
                return false;
        }
        
        function validateAssignCourse(form)
        {
            var fail="";
            fail += validateHours(form.ahours.value);
            var check=document.getElementsByClassName("acheck");
            var flag=0,i;
            for(i=0;i<check.length;i++)
            {
                if(check[i].checked==true){
                    if (fail==="") 
                        return confirm("Are you sure you want to submit?");
                    else 
                    { 
                    alert(fail); 
                    return false;
                    }
                }
                     
            }
            
                alert("Atleast One Batch should be Selected!");
                return false;
            
        }
            
        function validateGrade(form)
        {
            var fail="";
            fail += validateSeatNo(form.gseat.value);
            if(fail==="")
            {
                return confirm('This data will be finalized. Hence modification will not be allowed later. Are you sure you want to proceed?');
            }
            else{
                alert(""+fail);
                return false;
            }
                
        }    
        
        function validateClassroom(form)
        {
            var fail="";
            fail += validateClassId(form.class_id.value);
            fail += validateClassAbbrv(form.class.value);
            
            if(fail==="")
            {
                return confirm('This data will be finalized. Hence modification will not be allowed later. Are you sure you want to proceed?');
            }
            else{
                alert(""+fail);
                return false;
            }
                
        }   