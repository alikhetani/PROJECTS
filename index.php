<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ajax CRUD</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    #record-box {
      margin-top: 20px;
      padding: 10px;
      width: 500px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid #999;
      text-align: center;
      padding: 8px;
    }
    h2 {
      margin-bottom: 10px;
      text-align: center;
    }
    .delete-btn, .edit-btn {
      cursor: pointer;
      padding: 4px 8px;
      margin: 2px;
    }

    /* Modal styles */
    #model {
      display: none;
      position: fixed;
      top: 20%;
      left: 35%;
      background: white;
      padding: 20px;
      border: 2px solid #999;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
      z-index: 10;
    }
    #model-form {
      position: relative;
    }
    #close-btn {
      position: absolute;
      top: -10px;
      right: -10px;
      background: red;
      color: white;
      padding: 4px 8px;
      font-weight: bold;
      cursor: pointer;
      border-radius: 50%;
    }
  </style>
</head>
<body>
  <h1>Add Record With the Help Of Ajax</h1>

  <form id="addForm">
    First Name: <input type="text" id="fname"><br><br>
    Last Name: <input type="text" id="lname"><br><br>
    <input type="submit" id="save-button" value="Save">
  </form>

  <div id="record-box">
    <h2>Stored Records:</h2>
    <div id="table-data">
      <!-- Records loaded here -->
    </div>
  </div>

  <!-- Modal Edit Form -->
  <div id="model">
    <div id="model-form">
      <span id="close-btn">X</span>
      <h2>Edit Form</h2>
      <input type="hidden" id="edit-id">
      <table>
        <tr>
          <td>First Name</td>
          <td><input type="text" id="edit-fname"></td>
        </tr>
        <tr>
          <td>Last Name</td>
          <td><input type="text" id="edit-lname"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" id="edit-submit" value="Save"></td>
        </tr>
      </table>
    </div>
  </div>

  <script>
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

      // INSERT
      $("#save-button").on("click", function (e) {
        e.preventDefault();
        var fname = $("#fname").val();
        var lname = $("#lname").val();

        if (fname === "" || lname === "") {
          alert("Both fields are required.");
          return;
        }

        $.ajax({
          url: "ajax-insert.php",
          type: "POST",
          data: { first_name: fname, last_name: lname },
          success: function (data) {
            if (data == 1) {
              loadTable();
              $("#addForm").trigger("reset");
            } else {
              alert("Can't send record");
            }
          }
        });
      });

      // DELETE
      $(document).on("click", ".delete-btn", function () {
        var studentId = $(this).data("id");
        var confirmDelete = confirm("Are you sure you want to delete this record?");
        if (confirmDelete) {
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

      // OPEN EDIT MODAL
      $(document).on("click", ".edit-btn", function () {
        var row = $(this).closest("tr");
        var id = $(this).data("id");
        var fname = row.find("td:eq(1)").text();
        var lname = row.find("td:eq(2)").text();

        $("#edit-id").val(id);
        $("#edit-fname").val(fname);
        $("#edit-lname").val(lname);
        $("#model").show();
      });

      // CLOSE MODAL
      $(document).on("click", "#close-btn", function () {
        $("#model").hide();
      });

      // UPDATE
      $(document).on("click", "#edit-submit", function () {
        var stuID = $("#edit-id").val();
        var fname = $("#edit-fname").val();
        var lname = $("#edit-lname").val();

        $.ajax({
          url: "ajax-update.php",
          type: "POST",
          data: { id: stuID, first_name: fname, last_name: lname },
          success: function (data) {
            if (data == 1) {
              $("#model").hide();
              loadTable();
            } else {
              alert("Update failed.");
            }
          }
        });
      });

    });
  </script>
</body>
</html>
 
