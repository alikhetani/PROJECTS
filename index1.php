<!DOCTYPE html>
<html>
<head>
    <title>Student System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2>Student Table</h2>
    <button class="btn btn-primary mb-3" onclick="openModal()">Add Students</button>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Roll</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Standard</th>
            <th>Status</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="studentData"></tbody>
    </table>
</div>
  
<!-- Modal -->
<div class="modal" id="studentModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="studentForm">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Student Form</h5></div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="text" name="roll_no" class="form-control mb-2" placeholder="Roll No" required>
                    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                    <input type="date" name="dob" class="form-control mb-2" required>
                    <input type="text" name="standard" class="form-control mb-2" placeholder="Standard" required>
                    <select name="status" class="form-control mb-2">
                        <option value="on">On</option>
                        <option value="off">Off</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" onclick="$('#studentModal').hide()">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
function openModal(id = '') {
    $('#studentForm')[0].reset();
    $('#id').val('');
    if (id !== '') {
        $.get("ajax.php", {action: "get", id: id}, function(data){
           
            $('#id').val(student.id);
            $('[name="roll_no"]').val(student.roll_no);
            $('[name="name"]').val(student.name);
            $('[name="dob"]').val(student.dob);
            $('[name="standard"]').val(student.standard);
            $('[name="status"]').val(student.status);
        });
    }
    $('#studentModal').show();
}

function loadStudents() {
    $.get("ajax.php", {action: "read"}, function(data){
        $('#studentData').html(data);
    });
}

$('#studentForm').submit(function(e){
    e.preventDefault();
    $.post("ajax.php?action=save", $(this).serialize(), function(){
        $('#studentModal').hide();
        loadStudents();
    });
});

$(document).ready(function(){
    loadStudents();
});
</script>

  </body>
  </html>

