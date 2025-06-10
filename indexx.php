<!DOCTYPE html>
<html>
<head>
    <title>AJAX CRUD with Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4">Student Records</h2>
    <table class="table table-bordered" id="studentTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody><!--used to display all data-->
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h4>Edit Student</h4></div>
      <div class="modal-body">
        <input type="hidden" id="edit_id">
        <div class="mb-3">
            <input type="text" id="edit_name" class="form-control" placeholder="Name">
        </div>
        <div class="mb-3">
            <input type="email" id="edit_email" class="form-control" placeholder="Email">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" id="updateBtn">Update</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
function fetchRecords() {
    $.get("ajax2.php", { action: "read" }, function(data) {
        $('#studentTable tbody').html(data);
    });
}
fetchRecords();

// Delete
$(document).on("click", ".deleteBtn", function() {
    if (confirm("Are you sure you want to delete?")) {
        let id = $(this).data("id");
        $.post("ajax2.php", { action: "delete", id: id }, fetchRecords);
    }
});

// Edit
$(document).on("click", ".editBtn", function() {
    let id = $(this).data("id");
    $.get("ajax2.php", { action: "get", id: id }, function(res) {
        console.log(res); // Debug response
        let data = JSON.parse(res);
        $('#edit_id').val(data.id);
        $('#edit_name').val(data.name);
        $('#edit_email').val(data.email);
        new bootstrap.Modal(document.getElementById('editModal')).show();
    });
});

// Update
$("#updateBtn").click(function() {
    let data = {
        action: "update",
        id: $("#edit_id").val(),
        name: $("#edit_name").val(),
        email: $("#edit_email").val()
    };
    $.post("ajax2.php", data, function() {
        fetchRecords();
        bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
    });
});
</script>

<!--Bootstrap JS bundle for modal support-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
