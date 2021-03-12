<?php
    if(isset($_POST['submitForm'] ) ) 
    {
        $firstName=preg_replace('/\s+/', '', strip_tags($_POST['firstName'])); 
        $middleName=preg_replace('/\s+/', '', strip_tags($_POST['middleName'])); 
        $lastName=preg_replace('/\s+/', '', strip_tags($_POST['lastName'])); 
    
        $DOB=strip_tags($_POST['DOB']);
        $blood_grp=strip_tags($_POST['blood_group']);
        $gender=strip_tags($_POST['gender']);
        
        $nationality=strip_tags($_POST['nationality']);
        $religion=strip_tags($_POST['religion']);
        $category=strip_tags($_POST['category']);

        $staff_email=strip_tags($_POST['staff_email']);
        $staff_contact=strip_tags($_POST['staff_contact']);

        $house_number=strip_tags($_POST['house_number']);
        $locality=strip_tags($_POST['locality']);
        $state=strip_tags($_POST['state']);
        $city=strip_tags($_POST['city']);
        $zip=strip_tags($_POST['zip']);
            
        $relation=strip_tags($_POST['relation']);
        $relationName=strip_tags($_POST['relation_name']);
            
        $highSchool_roll=strip_tags($_POST['highSchoolRoll']);
        $highSchool_board=strip_tags($_POST['highSchoolBoard']);
        $highSchool_YOP=strip_tags($_POST['highSchoolYOP']);
        $highSchool_major=strip_tags($_POST['highSchoolMajor']);
        $highSchool_aggr=strip_tags($_POST['highSchool_agr']);
        
        $graduation_name=strip_tags($_POST['grad_name']);
        $graduation_roll=strip_tags($_POST['grad_Roll']);
        $graduation_university=strip_tags($_POST['grad_university']);
        $graduation_YOP=strip_tags($_POST['graduationYOP']);
        $graduation_major=strip_tags($_POST['graduationMajor']);
        $graduation_aggr=strip_tags($_POST['graduation_agr']);

        $oth_qauali_name=strip_tags($_POST['otherQuali_Name']);
        $oth_qauali_roll=strip_tags($_POST['otherQuali_roll']);
        $oth_qauali_university=strip_tags($_POST['otherQuali_University']);
        $oth_qauali_YOP=strip_tags($_POST['OtherQuali_YOP']);
        $oth_qauali_mojor=strip_tags($_POST['otherQuali_Major']);
        $oth_qauali_aggr=strip_tags($_POST['otherQuali_aggr']);
            
        $staff=strip_tags($_POST['Sch_Pos']);
        $satff_post=strip_tags($_POST['Sch_Post']);
        $subject_assigned=strip_tags($_POST['Sub_assigned']);

        if($_POST['class_assigned'] != " "){
            $classes_assigned=$_POST['class_assigned'];
        }else{
            $classes_assigned='NULL';
        }
        
        $database->AddStaff($firstName,$middleName,$lastName,$DOB,$blood_grp,$gender,$nationality,
        $religion,$category,$staff_email,$staff_contact,$house_number,$locality,$state,$city,
        $zip,$relation,$relationName,$highSchool_roll,$highSchool_board,$highSchool_YOP,$highSchool_major,
        $highSchool_aggr,$graduation_name,$graduation_roll,$graduation_university,$graduation_YOP,$graduation_major,$graduation_aggr,
        $oth_qauali_name,$oth_qauali_roll,$oth_qauali_university,$oth_qauali_YOP,$oth_qauali_mojor,$oth_qauali_aggr,
        $staff,$satff_post,$subject_assigned,$classes_assigned); 
    }

?>