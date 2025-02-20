<?php
$host = 'localhost';  // Change this to your database host
$db = 'g_bar'; // Your database name
$user = 'root';   // Your database username
$pass = ''; // Your database password
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted data
    $attendanceDate = $_POST['attendance_date'];  // Date of attendance
    $attendanceData = json_decode($_POST['attendance'], true); // Decode the JSON attendance data

    // Check if an attendance record for today already exists
    $query = "SELECT id FROM employee_attendance WHERE attendance_date = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$attendanceDate]);
    $existingRecord = $stmt->fetch();

    if ($existingRecord) {
        // Update the existing record
        $query = "UPDATE employee_attendance SET attendance = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([json_encode($attendanceData), $existingRecord['id']]);
    } else {
        // Insert a new attendance record
        $query = "INSERT INTO employee_attendance (attendance_date, attendance) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$attendanceDate, json_encode($attendanceData)]);
    }

    echo json_encode(['success' => true]);
}
?>
