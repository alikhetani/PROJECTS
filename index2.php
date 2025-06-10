<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Table Data</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="p-4">
    <div class="container mt-4">
        <h2 class>STUDENTT TABLE RECORS</h2>
         <!--<button class="btn btn-primary mb-3" onclick="openModal()">Add Students</button>-->
        <table class="table table-bordered">
            <thead>
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>email</td>
            <td>created_at</td>
        </tr>
        </thead>
        <tbody id="studentData"></tbody>
        </table>
    </div>
<!--Edit MOdel-->
<div class="modal" id="studentModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="studentForm">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Student Form</h5></div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                    <input type="date" name="email" class="form-control mb-2" required>>
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
    function fetchRecord() {
        $.get("ajax2.php", { action:"read" },function(data){
            $('#studentTable tbody').html(data);
        });
    }
    fetchRecord();


    //DELETE
    $.(docunment).on("click","deleteBtn",function(){
        if(conform("Are u sure to delete data?")) {
            let id = $(this).data("id");
            $.post("ajax2.php",P{action: "delete",id: id} ,fetchRecord);
        }
    });
    
    //EDIT
    $(docunment).on("click","editBtn",function(){
        let id =$(this).data("id");
        $.get("ajax2.php",{action: "get",id: id}, function(res){
            console.log(res);
            let data= JSON.parse(res);
            $('#editid').val(data.id);
            $('#editid').val(data.name);
            $('#editid').val(data.email);
            new bootstrap.Model(docunmwnt.getElementById('editModel')).show();
        });
    });

    //update
    $("updateBtn").click(function(){
        let date= {
            action: "update",
            id: $("#edit_id").val(),
            name: $("#edit_name").val(),
            email: $("#edit_email").val(),
        };
        $.post("ajax2.php", data, function() {
            fetchRecord();
                 bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>