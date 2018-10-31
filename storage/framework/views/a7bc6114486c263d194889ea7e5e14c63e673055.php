<!DOCTYPE html>
<html>
<head>
    <title>AJAX</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--bscdncss -->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/b-1.5.4/r-2.2.2/datatables.min.css"/><!--dtcdncss -->
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mt-3 mb-3" id="dsplTbl">
            <!-- main page -->
            <table id="myDataTbl" class="table table-hover">
                <thead>
                <tr class="table-primary">
                    <th>#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Reg Number</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
            <div class="row">
                <div class="col-lg-4 offset-4" id="dsplMessages"></div>
            </div>

            <!-- create modal -->
            <div class="modal fade" id="CreateForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Student form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="CreateForm-name">Name</label>
                                    <input name="name" type="text" class="form-control" id="CreateForm-name"
                                           aria-describedby="emailHelp" placeholder="Enter Name">
                                </div>


                                <div class="form-group">
                                    <label for="CreateForm-semester">Semester</label>
                                    <input name="semester" type="text" class="form-control" id="CreateForm-semester"
                                           placeholder="Enter Semester">
                                </div>


                                <div class="form-group">
                                    <label for="CreateForm-reg">Registration Number</label>
                                    <input name="reg_no" type="text" class="form-control" id="CreateForm-reg"
                                           placeholder="Enter Registration Number">
                                </div>
                                <button id="CreateForm-submit" onclick="createFormSubmit()" type="submit" class="btn btn-primary"
                                        data-dismiss="modal">Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- update form modal -->
            <div class="modal fade" id="UpdateForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Student form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="UpdateForm-name">Name</label>
                                    <input name="name" type="text" class="form-control" id="UpdateForm-name"
                                           aria-describedby="emailHelp" placeholder="Enter Name">
                                </div>


                                <div class="form-group">
                                    <label for="UpdateForm-semester">Semester</label>
                                    <input name="semester" type="text" class="form-control" id="UpdateForm-semester"
                                           placeholder="Enter Semester">
                                </div>


                                <div class="form-group">
                                    <label for="UpdateForm-reg">Registration Number</label>
                                    <input name="reg_no" type="text" class="form-control" id="UpdateForm-reg"
                                           placeholder="Enter Registration Number">
                                </div>
                                <input type="hidden" id="IDforUpdate">
                                <button id="UpdateForm-submit" type="submit" onclick="updateFormSubmit()" class="btn btn-primary"
                                        data-dismiss="modal">Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- create form modal trigger button -->
            <button type="button" id="dsplCreateNew" onclick="EmptyFormFields()" class="btn btn-primary" data-toggle="modal" data-target="#CreateForm">Add New Student</button>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><!--jquerycdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script><!--poopercdn -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script><!--bscdnjs -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/b-1.5.4/r-2.2.2/datatables.min.js"></script>
<!--dtcdnjs -->

<!-- custom jQuery -->
<script type="text/javascript">
  $.ajaxSetup({ //csrf tokken
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });


  var items = []; //array containing data
  function dataList() { //get data from db
    items = [];
    $.ajax({
      url: '/datalist',
      type: 'GET',
      dataType: 'JSON',
      success: function (success) {
        //console.log(success);
        for (var i = 0; i < success.length; i++) {
          items.push([
            i + 1,
            success[i]['name'],
            success[i]['semester'],
            success[i]['reg_no'],
            "<button class='btn btn-info' onclick='UpdateData(" + success[i]['id']+")' data-toggle='modal' data-target='#UpdateForm'>Update</button>"+
            "<button class='btn btn-danger ml-2'  onclick='DeleteData(" + success[i]['id']+")'>Delete</button>"
          ]);
        }
        datatableFunction();
      }
    });
   // console.log(items);
  }


  function DeleteData (id) { //delete requested data
    $.ajax({
      url: '/' + id,
      type: 'post',
      data: {
        _method: 'DELETE'
      },
      success: function (success) {
        $('#dsplMessages').delay(5000).fadeOut('400').append("<div class='alert alert-success'>" + success + "</div>");
        
        dataList();
      },
      error: function (err) {
        console.log(err);
      }
    })
  };

  function EmptyFormFields () { //empty create form
    $('#CreateForm-name').val('');
    $('#CreateForm-semester').val('');
    $('#CreateForm-reg').val('');
  };

  function datatableFunction() { //dataTable
    $('#myDataTbl').DataTable({
      data: items,
      destroy: true,
    });
  }
  
  function createFormSubmit() { //post request to submit form
    var form_action = $('#CreateForm').find('form').attr('action');
    var create_name = $('#CreateForm').find('#CreateForm-name').val();
    var create_semester = $('#CreateForm').find('#CreateForm-semester').val();
    var create_reg = $('#CreateForm').find('#CreateForm-reg').val();
    $.ajax({
      url: '/create',
      type: 'post',
      data: {
        name: create_name,
        semester: create_semester,
        reg_no: create_reg
      },
      error: function (err) {
        if (err.status == 422) {
          var errors = err.responseJSON.errors;
          $.each(errors, function (index, val) {
            $('#dsplMessages').delay(5000).fadeOut('400').append("<div class='alert alert-danger'>" + val + "</div>");
          });
        }
      },
      success: function (success) {
        $('#dsplMessages').delay(5000).fadeOut('400').append("<div class='alert alert-success'>Student registration successful!</div>");
        dataList();
      }
    })
  };

  function updateFormSubmit(){ //updating data
    var update_name = $('#UpdateForm-name').val();
    var update_semester = $('#UpdateForm-semester').val();
    var update_reg = $('#UpdateForm-reg').val();
    var id = $('#IDforUpdate').val();
    $.ajax({
      url: '/update/'+ id,
      type: 'POST',
      dataType: 'JSON',
      data: {
        name: update_name,
        semester: update_semester,
        reg_no: update_reg,
        _method: 'PUT' 
      },
      success: function(success){
        dataList();
        console.log(success);
      },
      error: function(err){
        if (err.status == 422) {
          var errors = err.responseJSON.errors;
          $.each(errors, function (index, val) {
            $('#dsplMessages').delay(5000).fadeOut('400').append("<div class='alert alert-danger'>" + val + "</div>");
          });
        }
      }
    })
    
  }

  function UpdateData(id){ //request 'id' for updation
    $.ajax({
      url: '/' + id,
      type: 'POST',
      success: function(success){
        //console.log(success);
        $('#UpdateForm-name').val(success.name);
        $('#UpdateForm-semester').val(success.semester);
        $('#UpdateForm-reg').val(success.reg_no);
        $('#IDforUpdate').val(id);
      }
    })
  }


  $(document).ready(function () {
    dataList();
  });
</script>
</body>
</html>
            
                    