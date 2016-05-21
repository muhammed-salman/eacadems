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


function validateName(feild)
{
    if(/[^a-zA-Z ]/.test(feild))
        return "Invalid Name.\n";
    else
        return (feild === "")?"No Name was entered.\n":"";

}


function validateRollno(feild)
{
     if(/[^a-zA-Z0-9]/.test(feild))
        return "Invalid Roll number. Only 0-9, a-z, A-Z are allowed.\n";
    if(!(/[a-z]/i.test(feild)))
        return "Invalid Roll number. Characters a-z, A-Z are not present.\n";
    if(!(/[0-9]/.test(feild)))
        return "Invalid Roll number. Numbers from 0-9 not present.\n";
     if(feild === "")
         return "No Roll number was entered.\n";
     return "";
}

function validateFacultyId(feild)
{
    if(/[^a-zA-Z0-9]/.test(feild))
        return "Invalid Faculty ID. Only 0-9, a-z, A-Z are allowed.\n";
    if(!(/[a-z]/i.test(feild)))
        return "Invalid Faculty ID. Characters a-z, A-Z are not present.\n";
    if(!(/[0-9]/.test(feild)))
        return "Invalid Faculty ID. Numbers from 0-9 not present.\n";
    return (feild === "")?"No Faculty Id was entered.\n":"";
}

function validateAddress(feild)
{
    if(feild.length<50)
        return "Address Cannot Be Less than 50 characters.\n";
    return (feild === "")?"No Residential/Permanent Address was entered.\n":"";
}

function validateDate(feild)
{
    if(!(/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/.test(feild)))
        return "Invalid Date.\n";
    else
        return (feild === "")?"No Date was selected.\n":"";
}

function validatePhoneno(feild)
{
    if (feild.length<10) 
        return "Phone number should be atleast of 10 digits.\n";
    else if(feild.length>12)
        return "Phone number should be maximum of 12 digits only.\n";
    else if (isNaN(feild)|| feild ==="0123456789" ||feild ==="1234567890" || feild ==="0000000000")
        return "Please enter a valid phone number.\n";
    else
    return (feild === "")?"No Phone number was entered.\n":"";
}

function validateUsername(feild)
{
    if(feild === "")
        return "No Username was entered.\n";
    if(feild.length<5)
        return "Username must be at least 5 character.\n ";
    if(/[^a-zA-Z0-9_-]/.test(feild))
        return "Only a-z, A-Z, 0-9, - and _allowed in Username.\n";
    return "";
}

function validatePassword(feild)
{
    if(feild === "")
        return "No password was entered.\n";
    if (feild.length<8)
        return "Password must be at least 8 character.\n";
    if (!/[a-z]/.test(feild) || !/[A-Z]/.test(feild) || !/[0-9]/.test(feild) || !/[!@#$%^&*]/.test(feild))
        return "Password should contain atleast one of each a-z, A-Z, ! @ # $ % ^ & * and 0-9.\n ";
    return "";
}

function validateEmail(feild)
{
    if(feild==="")
        return "No Email was entered.\n";
    else if (!((feild.indexOf(".")>0)&&(feild.indexOf("@")>0))||/[^a-zA-Z0-9.@_-]/.test(feild))
        return "The Email address is invalid.\n";
    return "";
}

function validateExperience(feild)
{
    if(feild ==="")
        return "No Experience was entered.\n";
    else if(isNaN(feild))
        return "Invalid Experience. Please enter a numeric value.\n";
    return "";
}

function validateSalary(feild)
{
    if(feild ==="NULL")
        return "";
    if(feild === "")
        return "No Salary was entered.\n";
    else if (feild.length<5)
        return "Salary Must be of atleast 5 digits.\n";
    else if (isNaN(feild))
        return "Invalid Salary. Please enter a numeric value.\n";
    return "";
}

function validateBudget(feild)
{
    if(feild ==="0")
        return "";
    if(feild === "")
        return "No Budget was entered.\n";
    else if (feild.length<5)
        return "Budget Must be of atleast 5 digits.\n";
    else if (isNaN(feild))
        return "Invalid Budget. Please enter a numeric value.\n";
    else if(feild < "0")
        return "Budget cannot be negative.\n";
    return "";
}

function validateIntake(feild)
{
    if(feild ==="0")
        return "";
    if(feild === "")
        return "No Intake was entered.\n";
    else if (feild.length>3)
        return "Intake cannot be more than 3 digits.\n";
    else if (isNaN(feild))
        return "Invalid Intake. Please enter a numeric value.\n";
    else if(feild < "0")
        return "Intake cannot be negative.\n";
    return "";
}

function validateDeptId(feild)
{
    if(/[^a-zA-Z-]/.test(feild))
        return "Only a-z, A-Z, and - allowed in Department Id.\n";
    if(feild === "")
        return "No Department Id was entered.\n";
    if(feild.length<2)
        return "Department Id cannot be less than two digits.\n";
    return "";
}

function validateCourseId(feild)
{
    if(feild === "")
        return "No Course Id was entered.\n";
    if(feild.length<6)
        return "Cousre Id cannot be less than six digits.\n";
    if(/[^a-zA-Z0-9_-]/.test(feild))
        return "Only a-z, A-Z, 0-9, - and _allowed in Cousre Id.\n";
    return "";
}

function validateTitle(feild)
{
    if(feild === "")
        return "No title was entered.\n";
    if(feild.length<3)
        return "Title cannot be less than 3 digits.\n";
    if(/[^a-zA-Z0-9 ]/.test(feild))
        return "Only a-z, A-Z, 0-9 and . is allowed in title.\n";
    return "";
}

function validateMarks(feild)
{
    if(feild ==="0")
        return "";
    if(feild === "")
        return "No Marks were entered.\n";
    else if (feild.length<1)
        return "Marks Must be of atleast 1 digits.\n";
    else if (feild > 200)
        return "Marks cannot be more than 200.\n";
    else if (isNaN(feild))
        return "Invalid Marks. Please enter a numeric value.\n";
    else if(feild < 0)
        return "Marks cannot be negative.\n";
    return "";
}

function validateCredit(feild)
{
    if(feild ==="0")
        return "";
    if(feild === "")
        return "No Credit were entered.\n";
    else if (feild.length<0)
        return "Credit Must be of atleast 1 digit.\n";
    else if (feild > 10)
        return "Credit cannot be greater than 10.\n";
    else if (isNaN(feild))
        return "Invalid Credit. Please enter a numeric value.\n";
    else if(feild < 0)
        return "Credit cannot be negative.\n";
    return "";
}

function validateHours(feild)
{
    if(feild ==="0")
        return "";
    if(feild === "")
        return "No Hours were entered.\n";
    else if (feild.length<0)
        return "Hours Must be of atleast 1 digit.\n";
    else if (feild > 10)
        return "Hours cannot be greater than 10.\n";
    else if (isNaN(feild))
        return "Invalid Hours. Please enter a numeric value.\n";
    else if(feild < 0)
        return "Hours cannot be negative.\n";
    return "";
}

function validateCombo(feild)
{
    if(feild === "")
        return "Please select value from the combo box(es).\n";
    return "";
}

function validateAbbrv(feild)
{
    if(feild === "")
        return "Please specify Abbreviation for the subject.\n";
    if (feild.length>8)
        return "Length of Abbreviation cannot be greater than 8.\n";
    if(/[^a-zA-Z0-9_-]/.test(feild))
        return "Only a-z, A-Z, 0-9, - and _allowed in Abbreviation.\n";
    return "";
}
function validateObjectives(feild)
{
    if(feild.length<25)
        return "Specified Objectives too Short.\n";
    return (feild === "")?"No Objectives was entered.\n":"";
}
function validateOutcomes(feild)
{
    if(feild.length<25)
        return "Specified Outccomes too Short.\n";
    return (feild === "")?"No Outcomes was entered.\n":"";
}

function validateMonthYear(feild)
{
    if(/[^a-zA-Z0-9 ]/.test(feild))
        return "Invalid Month and Year. Only 0-9, a-z, A-Z are allowed.\n";
    if(!(/[a-z]/i.test(feild)))
        return "Invalid Month and Year. Characters a-z, A-Z are not present.\n";
    if(!(/[0-9]/.test(feild)))
        return "Invalid Month and Year. Numbers from 0-9 not present.\n";
    if(feild.length<8)
        return "Invalid Month and year.\n";
    return (feild === "")?"No Month and Year was entered.\n":"";
}

function validateSeatNo(feild)
{
    if(/[^a-zA-Z0-9 ]/.test(feild))
        return "Invalid Seat No. Only 0-9, a-z, A-Z are allowed.\n";
    if(!(/[a-z]/i.test(feild)))
        return "Invalid Seat No. Characters a-z, A-Z are not present.\n";
    if(!(/[0-9]/.test(feild)))
        return "Invalid Seat No. Numbers from 0-9 not present.\n";
    if(feild.length<6)
        return "Invalid Seat No. Length cannot be less than 6 characters.\n";
    return (feild === "")?"No Seat No. was entered.\n":"";
}

function validateClassId(feild)
{
    if(feild === "")
        return "No Class Id was entered.\n";
    if(feild.length<3)
        return "Class Id cannot be less than three digits.\n";
    if(/[^a-zA-Z0-9_-]/.test(feild))
        return "Only a-z, A-Z, 0-9, - and _ allowed in Class Id.\n";
    return "";
}

function validateClassAbbrv(feild)
{
    if(feild === "")
        return "Please specify Abbreviation for the Classroom.\n";
    if (feild.length < 2)
        return "Length of Abbreviation cannot be less than 2.\n";
    if(/[^a-zA-Z0-9_-]/.test(feild))
        return "Only a-z, A-Z, 0-9, - and _ allowed in Abbreviation.\n";
    return "";
}