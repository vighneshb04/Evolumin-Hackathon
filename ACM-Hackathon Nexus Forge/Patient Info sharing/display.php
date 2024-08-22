<?php

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'test');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $sql = "SELECT * FROM forms";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Form Data</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Sex</th><th>Date of Birth</th><th>Phone Number</th><th>Email</th><th>Street Address</th><th>City</th><th>State</th><th>Postal Code</th><th>Is Younger Than 18</th><th>Parent First Name</th><th>Parent Last Name</th><th>Parent Phone Number</th><th>Emergency First Name</th><th>Emergency Last Name</th><th>Relationship</th><th>Emergency Contact Number</th><th>Any Family Doctor</th><th>Family Doctor First Name</th><th>Family Doctor Last Name</th><th>Family Doctor Phone Number</th><th>Pharmacy Phone Number</th><th>Health History</th><th>Taking Medications</th><th>Medications</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
            echo "<td>" . htmlspecialchars($row['firstName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['lastName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['sex']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dateOfBirth']) . "</td>";
            echo "<td>" . htmlspecialchars($row['phoneNumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['streetAddress']) . "</td>";
            echo "<td>" . htmlspecialchars($row['city']) . "</td>";
            echo "<td>" . htmlspecialchars($row['state']) . "</td>";
            echo "<td>" . htmlspecialchars($row['postalCode']) . "</td>";
            echo "<td>" . htmlspecialchars($row['isYoungerThan18']) . "</td>";
            echo "<td>" . htmlspecialchars($row['parentFirstName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['parentLastName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['parentPhoneNumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['emergencyFirstName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['emergencyLastName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['relationship']) . "</td>";
            echo "<td>" . htmlspecialchars($row['emergencyContactNumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['anyFamilyDoctor']) . "</td>";
            echo "<td>" . htmlspecialchars($row['familyDoctorFirstName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['familyDoctorLastName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['familyDoctorPhoneNumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['pharmacyPhoneNumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['healthHistory']) . "</td>";
            echo "<td>" . htmlspecialchars($row['takingMedications']) . "</td>";
            echo "<td>" . htmlspecialchars($row['medications']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found";
    }

    $conn->close();
}
?>
