<?php
$conn = new mysqli("localhost", "root", "", "ajax_crud_demo");

//  read 
if (isset($_GET['action']) && $_GET['action'] == 'read') {
    $result = $conn->query("SELECT * FROM students ORDER BY id ASC");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td> 
            <td>{$row['email']}</td>
            <td>
                <button class='btn btn-sm btn-danger editBtn' data-id='{$row['id']}'>Edit</button>
                <button class='btn btn-sm btn-info deleteBtn' data-id='{$row['id']}'>Delete</button>
            </td>
        </tr>";
    }
}

//  delete 
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = ($_POST['id']); // secure with 
    $conn->query("DELETE FROM students WHERE id=$id");
}

//  GET one record for edit
if (isset($_GET['action']) && $_GET['action'] == 'get') {
    $id = ($_GET['id']); // secure with 
    $result = $conn->query("SELECT * FROM students WHERE id=$id");
    echo json_encode($result->fetch_assoc());
}

// UPDATE record
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = ($_POST['id']); // secure
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $conn->query("UPDATE students SET name='$name', email='$email' WHERE id=$id");
}
?>
