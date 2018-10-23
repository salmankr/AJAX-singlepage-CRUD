<!DOCTYPE html>
<html>
<head>
    <title>AJAX</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"><!--bscdncss -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/b-1.5.4/r-2.2.2/datatables.min.css"/><!--dtcdncss -->
</head>
<body>
    
    <div class="container-fluid">

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNew-title">Add New Item</h5>
                <h5 class="modal-title" id="edit-title">Edit current item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="modal-body">
                    <!-- add new form -->
                    <form id="addNew-form" action="/add-new-student" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter name" name="name">
                      </div>
                      <div class="form-group">
                        <label for="semester">Enter Semester Number</label>
                        <input type="text" pattern="[1-8]{1}" class="form-control" placeholder="Enter Semester... only one digit allowed" name="semester">
                      </div>
                      <div class="form-group">
                        <label for="registrationnumber">Reg. Number</label>
                        <input type="text" pattern="[0-9]{3}-[0-9]{2}" class="form-control" placeholder="Pattern: 016-12" name="reg_no">
                      </div>
                      <div class="form-group">
                        <label for="image">Upload image</label>
                        <input class="d-block" type="file" name="image">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                 

                    <!-- edit item form-->
                    <form id="edit-form" class="col-lg-6 col-sm-8 col-xs-12" action="/add-new-student" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter name" name="name">
                      </div>
                      <div class="form-group">
                        <label for="semester">Enter Semester Number</label>
                        <input type="text" pattern="[1-8]{1}" class="form-control" placeholder="Enter Semester... only one digit allowed" name="semester">
                      </div>
                      <div class="form-group">
                        <label for="registrationnumber">Reg. Number</label>
                        <input type="text" pattern="[0-9]{3}-[0-9]{2}" class="form-control" placeholder="Pattern: 016-12" name="reg_no">
                      </div>
                      <div class="form-group">
                        <label for="image">Upload image</label>
                        <input class="d-block" type="file" name="image">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="modal-close" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                <button type="button" class="btn btn-primary" id="modal-addNew">Add New</button>
              </div>
            </div>
          </div>
        </div>

        <!-- main page-->
        <div class="row">
            <div class="col-lg-12">
                <div class="mt-3">
                  <table id="dataTbl" class="table table-hover">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Added</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr data-toggle="modal" data-target="#exampleModal">
                          <th scope="row" class="data-col">1</th>
                          <td class="data-col">Hello world</td>
                          <td class="data-col">Awesome</td>
                          <td class="data-col">Good</td>
                          <td class="data-col">wow</td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- Button trigger modal -->
                  <button type="button" id="addNew-btn" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Add New
                  </button>
                </div>
            </div>
        </div>
    </div>
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><!--jquerycdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script><!--poopercdn -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script><!--bscdnjs -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/b-1.5.4/r-2.2.2/datatables.min.js"></script><!--dtcdnjs -->
    <script type="text/javascript">
    $(document).ready( function () {
       $('#dataTbl').DataTable(); // for dataTable


       $(".data-col").click(function(event) { //edit
        var value = $(this).text();

           $('#edit-title').show();
           $('#addNew-title').hide();
           $('#edit-form').show();
           $('#addNew-form').hide();
           $('#modal-close').show();
           $('#modal-save').show();
           $('#modal-addNew').hide();
       });

       $("#addNew-btn").click(function(event) { //create
           $('#edit-title').hide();
           $('#addNew-title').show();
           $('#edit-form').hide();
           $('#addNew-form').show();
           $('#modal-close').hide();
           $('#modal-save').hide();
           $('#modal-addNew').show();
       });
  } );
  </script>
</body>
</html>