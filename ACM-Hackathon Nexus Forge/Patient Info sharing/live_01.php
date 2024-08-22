<?php
// Retrieve POST data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$sex = $_POST['sex'];
$dateOfBirth = $_POST['dateOfBirth'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$streetAddress = $_POST['streetAddress'];
$streetAddressLine2 = $_POST['streetAddressLine2'];
$city = $_POST['city'];
$state = $_POST['state'];
$postalCode = $_POST['postalCode'];
$isYoungerThan18 = $_POST['isYoungerThan18'];
$parentFirstName = $_POST['parentFirstName'];
$parentLastName = $_POST['parentLastName'];
$parentPhoneNumber = $_POST['parentPhoneNumber'];
$emergencyFirstName = $_POST['emergencyFirstName'];
$emergencyLastName = $_POST['emergencyLastName'];
$relationship = $_POST['relationship'];
$emergencyContactNumber = $_POST['emergencyContactNumber'];
$anyFamilyDoctor = $_POST['anyFamilyDoctor'];
$familyDoctorFirstName = $_POST['familyDoctorFirstName'];
$familyDoctorLastName = $_POST['familyDoctorLastName'];
$familyDoctorPhoneNumber = $_POST['familyDoctorPhoneNumber'];
$pharmacyPhoneNumber = $_POST['pharmacyPhoneNumber'];
$healthHistory = $_POST['healthHistory'];
$takingMedications = $_POST['takingMedications'];
$medications = $_POST['medications'];

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'university_healthcare');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO patients (
        first_name, last_name, sex, date_of_birth, phone_number, email, street_address, street_address_line2, city, state, postal_code, 
        is_younger_than_18, parent_first_name, parent_last_name, parent_phone_number, emergency_first_name, emergency_last_name, relationship, emergency_contact_number, 
        any_family_doctor, family_doctor_first_name, family_doctor_last_name, family_doctor_phone_number, pharmacy_phone_number, health_history, taking_medications, medications
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('Prepare Failed: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssssisssissssisss", 
        $firstName, $lastName, $sex, $dateOfBirth, $phoneNumber, $email, $streetAddress, $streetAddressLine2, $city, $state, $postalCode, 
        $isYoungerThan18, $parentFirstName, $parentLastName, $parentPhoneNumber, $emergencyFirstName, $emergencyLastName, $relationship, $emergencyContactNumber, 
        $anyFamilyDoctor, $familyDoctorFirstName, $familyDoctorLastName, $familyDoctorPhoneNumber, $pharmacyPhoneNumber, $healthHistory, $takingMedications, $medications);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Registration Successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
