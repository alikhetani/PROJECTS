<?php
$conn = new mysqli("localhost", "root", "", "project");
//Check if action is 'read' to fetch all students
if ($_GET['action'] === 'read') {
  $result = $conn->query("SELECT * FROM students ORDER BY id DESC");
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>{$row['roll_no']}</td>
      <td>{$row['name']}</td>
      <td>{$row['dob']}</td>
      <td>{$row['standard']}</td>
      <td>{$row['status']}</td>
      <td>{$row['created_at']}</td>
      <td><button class='btn btn-info btn-sm' onclick='openModal({$row['id']})'>Edit</button></td>
    </tr>";
  }
}
// gectch a single student
if (isset($_GET['action']) === 'get' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $result = $conn->query("SELECT * FROM students WHERE id = $id");
  echo json_encode($result->fetch_assoc());
}
// check if action is save to create or UPDATE or do whatever u can doo
if (isset($_GET['action']) === 'save') {
  $id = intval($_POST['id']);
  $roll_no = $conn->real_escape_string($_POST['roll_no']);
  $name = $conn->real_escape_string($_POST['name']);
  $dob = $_POST['dob'];
  $standard = $conn->real_escape_string($_POST['standard']);
  $status = $_POST['status'];

  if ($id > 0) {
    $conn->query(
      "UPDATE students SET roll_no='$roll_no', name='$name', dob='$dob', standard='$standard', status='$status' WHERE id=$id");
  } else {
    $conn->query("INSERT INTO students (roll_no, name, dob, standard, status) VALUES ('$roll_no', '$name', '$dob', '$standard', '$status')");
  }
}
?>
