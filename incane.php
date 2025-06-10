<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Form</title>
</head>
<body>
    <!-- Add this inside your form -->
<form id="addForm">
    <input type="hidden" id="edit-id"> <!-- Hidden field for editing -->
    First Name: <input type="text" id="fname"><br><br>
    Last Name: <input type="text" id="lname"><br><br>
    <input type="submit" id="save-button" value="Save">
</form>


<script type="text/javascript">
    $(document).ready(function () {
        function loadTable() {
            $.ajax({
                url: "ajax-load.php",
                type: "POST",
                success: function (data) {
                    $("#table-data").html(data);
                }
            });
        }

        loadTable();

        $("#save-button").on("click", function (e) {
            e.preventDefault();
            var id = $("#edit-id").val();
            var fname = $("#fname").val();
            var lname = $("#lname").val();

            if (fname === "" || lname === "") {
                alert("Both fields are required.");
                return;
            }

            // Determine URL: insert or update
            let ajaxUrl = (id === "") ? "ajax-insert.php" : "ajax-update.php";

            $.ajax({
                url: ajaxUrl,
                type: "POST",
                data: { id: id, first_name: fname, last_name: lname },
                success: function (data) {
                    if (data == 1) {
                        loadTable();
                        $("#addForm").trigger("reset");
                        $("#edit-id").val("");
                        $("#save-button").val("Save");
                    } else {
                        alert("Failed to save/update record.");
                    }
                }
            });
        });

        // 🗑 Delete Record
        $(document).on("click", ".delete-btn", function () {
            var studentId = $(this).data("id");

            if (confirm("Are you sure you want to delete this record?")) {
                $.ajax({
                    url: "ajax-delete.php",
                    type: "POST",
                    data: { id: studentId },
                    success: function (data) {
                        if (data == 1) {
                            loadTable();
                        } else {
                            alert("Failed to delete record.");
                        }
                    }
                });
            }
        });

        // ✏️ Edit Record
        $(document).on("click", ".update-btn", function () {
            var row = $(this).closest("tr");
            var id = $(this).data("id");
            var fname = row.find("td:eq(1)").text();
            var lname = row.find("td:eq(2)").text();

            $("#edit-id").val(id);
            $("#fname").val(fname);
            $("#lname").val(lname);
            $("#save-button").val("Update");
        });
    });
</script>
</body>
</html>