<?php
$conn = mysqli_connect("localhost", "root", "", "ajax_demo)");

$sql = "SELECT * FROM students"; // Change table name if needed
$result = mysqli_query($conn, $sql);
$output = "";

if (mysqli_num_rows($result) > 0) {
    $output = "<table>
                <tr>
                    <th>ID</th><th>First Name</th><th>Last Name</th><th>Actions</th>
                </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>
                            <button class='update-btn' data-id='{$row['id']}'>Edit</button>
                            <button class='delete-btn' data-id='{$row['id']}'>Delete</button>
                        </td>
                    </tr>";
    }
    $output .= "</table>";
    echo $output;
} else {
    echo "No Records Found.";
}
?>
