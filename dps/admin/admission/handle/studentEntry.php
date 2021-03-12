
<?php
    if(  isset($_POST['submitDetails'])   ) {
        
            $firstName=preg_replace('/\s+/', '', strip_tags($_POST['firstName'])); 
            $middleName=preg_replace('/\s+/', '', strip_tags($_POST['middleName'])); 
            $lastName=preg_replace('/\s+/', '', strip_tags($_POST['lastName'])); 
        
  
            $DOB=strip_tags($_POST['DOB']);
            $bloodGrp=strip_tags($_POST['blood_group']);
            $gender=strip_tags($_POST['gender']);
            $nationality=strip_tags($_POST['nationality']);
            $religion=strip_tags($_POST['religion']);
            $category=strip_tags($_POST['category']);
        
            $student_email=strip_tags($_POST['student_email']);
            $student_contact=strip_tags($_POST['student_contact']);
        
            $house_number=strip_tags($_POST['house_number']);
            $locality=strip_tags($_POST['locality']);
            $state=strip_tags($_POST['state']);
            $city=strip_tags($_POST['city']);
            $zip=strip_tags($_POST['zip']);
        
            $fatherName=strip_tags($_POST['FatherName']);
            $fatherOccupation=strip_tags($_POST['FatherOccupation']);
            $fatherContact=strip_tags($_POST['FatherContact']);
            $fatherEmail=strip_tags($_POST['father_email']);
        
            $motherName=strip_tags($_POST['MotherName']);
            $motherOccupation=strip_tags($_POST['MotherOccupation']);
            $motherContact=strip_tags($_POST['MotherContact']);
        
            $guardianName=strip_tags($_POST['GuardianName']);
            $guardianContact=strip_tags($_POST['GuardianContact']);
            $guardianOccupation=strip_tags($_POST['GuardianOccupation']);
            $guardianEmail=strip_tags($_POST['guardian_email']);
        
            $PreviousClass=strip_tags($_POST['PreviousClass']);
            $Board=strip_tags($_POST['PreviousBoard']);
            $Percentage=strip_tags($_POST['PreviousPercentage']);
            $YOP=strip_tags($_POST['YearOfPassing']);
            $AppliedClass=strip_tags($_POST['AppliedClass']);
                    $x=explode(" ",$_POST['AppliedClass']);
            $currClass= $x[1];
            $facility=strip_tags($_POST['facility']);
        
                               
            $database->AddStudent($firstName,$middleName,$lastName,$DOB,$bloodGrp,$gender,$nationality,$religion,$category, $student_email,$student_contact,
                                    $house_number,$locality,$state,$city,$zip,$fatherName,$fatherOccupation,$fatherContact,$fatherEmail,$motherName,$motherOccupation,
                                    $motherContact,$guardianName,$guardianContact,$guardianOccupation,$guardianEmail,$PreviousClass,$Board,$Percentage, $YOP,$AppliedClass,
                                    $currClass,$facility);     
        }              
?>