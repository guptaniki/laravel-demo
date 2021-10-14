<?php
                $id = auth()->user()->id;
                $name = auth()->user()->name;
                ?>

@extends('layout')

  

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                        <h4 class="text-center">Subject Crud</h4>
                    </div>
                    <div class="col-md-12 mb-4 text-right">
                        <a class="btn btn-success" href="javascript:void(0)" id="createNewSubjects"> <i class="fas fa-plus"></i></a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-hover table-bordered data-table"  id="subjectTable">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Subject Title</th>
                                    <th>Subject Name</th>
                                    <th>Subject Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="subjectForm" name="subjectForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="user_id" id="id" value="{{$id}}">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Subject Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="s_name" name="subject_name" placeholder="Enter Subject Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-4 control-label">Subject Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="s_title" name="subject_title" placeholder="Enter Subject Title" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Subject Description</label>
                        <div class="col-sm-12">
                            <textarea id="s_description" name="subject_description" required="" placeholder="Enter Subject Description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModelView" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeadingView"></h4>
                </div>
                <div class="modal-body">
                    <form id="subjectForm" name="subjectForm" class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Id</label>
                        <div class="col-sm-12">
                        <input type="text"  class="form-control" name="id" id="id_view" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">User Name</label>
                        <div class="col-sm-12">
                        <input type="text"  class="form-control"  name="user_id" id="user_id" value="{{$name}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Subject Name</label>
                        <div class="col-sm-12">
                            <input type="text"  class="form-control" id="s_name_view" name="subject_name" placeholder="Enter Subject Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-4 control-label">Subject Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="s_title_view" name="subject_title" placeholder="Enter Subject Title" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Subject Description</label>
                        <div class="col-sm-12">
                            <textarea id="s_description_view" name="subject_description" required="" placeholder="Enter Subject Description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn_view" value="create">Save changes</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            dom: "Blfrtip",
            buttons: [
                    {
                        text: 'pdf',
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                        className: 'btn btn-primary glyphicon glyphicon-duplicate'
                    },
                    {
                        text: 'print',
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                        className: 'btn btn-primary glyphicon glyphicon-duplicate'
                    },
                ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('subjects.index') }}",
            columns : [
                {data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'subject_title',name:'subject_title'},
                {data:'subject_name',name:'subject_name'},
                {data:'subject_description',name:'subject_description'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                
            ], columnDefs: [{
                    orderable: false,
                    targets: -1
                }] 
        });

        $('#createNewSubjects').click(function () {
            $('#saveBtn').val("create-subject");
            $('#id').val('');
            $('#subjectForm').trigger("reset");
            $('#modelHeading').html("Create New subject");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editSubject', function () {
            var subject_id = $(this).data('id');
            $.get("{{ route('subjects.index') }}" +'/' + subject_id +'/edit', function (data) {

            $('#modelHeading').html("Edit Subject");
            $('#saveBtn').val("edit-subject");
            $('#ajaxModel').modal('show');

            $('#id').val(data.id);
            $("#id"). attr("disabled",false);
            $('#s_title').val(data.subject_title);
            $("#s_title"). attr("disabled",false);
            $('#s_name').val(data.subject_name);
            $("#s_name"). attr("disabled",false);
            $('#s_description').val(data.subject_description);
            $("#s_description"). attr("disabled",false);
            })
        });

        $('body').on('click', '.viewSubject', function () {
            var subject_id = $(this).data('id');
            $.get("{{ route('subjects.index') }}" +'/' + subject_id +'/view', function (data) {

            $('#modelHeadingView').html("View Subject");
            $('#saveBtn_view').hide();
            $('#ajaxModelView').modal('show');
            $('#id_view').val(data.id);
            $("#id_view"). attr("disabled", "disabled");
            $("#user_id"). attr("disabled", "disabled");
            $('#s_title_view').val(data.subject_title);
            $("#s_title_view"). attr("disabled", "disabled");
            $('#s_name_view').val(data.subject_name);
            $("#s_name_view"). attr("disabled", "disabled");
            $('#s_description_view').val(data.subject_description);
            $("#s_description_view"). attr("disabled", "disabled");
            })
        });
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
                data: $('#subjectForm').serialize(),
                url: "{{ route('subjects.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#subjectForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        $('body').on('click', '.deleteSubject', function (){
            var subject_id = $(this).data("id");
            var result = confirm("Are You sure want to delete !");
            if(result){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('subjects.store') }}"+'/'+subject_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }else{
                return false;
            }
        });
    });
</script>
@endsection