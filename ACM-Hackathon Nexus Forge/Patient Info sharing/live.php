<?php

$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$sex=$_POST['sex'];
$dateOfBirth=$_POST['dateOfBirth'];
$phoneNumber=$_POST['phoneNumber'];
$email=$_POST['email'];
$streetAddress=$_POST['streetAddress'];
$city=$_POST['city'];
$state=$_POST['state'];
$postalCode=$_POST['postalCode'];
$isYoungerThan18=$_POST['isYoungerThan18'];
$parentFirstName=$_POST['parentFirstName'];
$parentLastName=$_POST['parentLastName'];
$parentPhoneNumber=$_POST['parentPhoneNumber'];
$emergencyFirstName=$_POST['emergencyFirstName'];
$emergencyLastName=$_POST['emergencyLastName'];
$relationship=$_POST['relationship'];
$emergencyContactNumber=$_POST['emergencyContactNumber'];
$anyFamilyDoctor=$_POST['anyFamilyDoctor'];
$familyDoctorFirstName=$_POST['familyDoctorFirstName'];
$familyDoctorLastName=$_POST['familyDoctorLastName'];
$familyDoctorPhoneNumber=$_POST['familyDoctorPhoneNumber'];
$pharmacyPhoneNumber=$_POST['pharmacyPhoneNumber'];
$healthHistory=$_POST['healthHistory'];
$takingMedications=$_POST['takingMedications'];
$medications=$_POST['medications'];

//Database Connection
$conn = new mysqli('localhost','root','','test');

if ($conn->connect_error){
    die('Connection Failed :'.$conn->connect_error);
}else{
    $stmt=$conn->prepare("insert forms(firstName,lastName,sex,dateOfBirth,phoneNumber,email,streetAddress,city,state,postalCode,isYoungerThan18,parentFirstName,parentLastName,parentPhoneNumber,emergencyFirstName,emergencyLastName,relationship,emergencyContactNumber,anyFamilyDoctor,familyDoctorFirstName,familyDoctorLastName,familyDoctorPhoneNumber,pharmacyPhoneNumber,healthHistory,takingMedications,medications)
    values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssisssisssisssiisss",$firstName,$lastName,$sex,$dateOfBirth,$phoneNumber,$email,$streetAddress,$city,$state,$postalCode,$isYoungerThan18,$parentFirstName,$parentLastName,$parentPhoneNumber,$emergencyFirstName,$emergencyLastName,$relationship,$emergencyContactNumber,$anyFamilyDoctor,$familyDoctorFirstName,$familyDoctorLastName,$familyDoctorPhoneNumber,$pharmacyPhoneNumber,$healthHistory,$takingMedications,$medications);
    $stmt->execute();
    echo "Registration Successful.";
    $stmt->close();
    $conn->close();
}

?>