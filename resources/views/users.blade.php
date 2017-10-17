@extends('layouts.forms')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Users</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>

            <li class="active">Users</li>
        </ol>
    </div>
    <div class="main-content container-fluid">

        <div id="errormsg">
            <div role="alert" id="successdiv" class="alert alert-success alert-icon alert-dismissible"  style="display: none">
                <div class="icon"><span class="mdi mdi-check"></span></div>
                <div class="message">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
                    <span class="feedback"></span>
                </div>
            </div> 
            <div id="errordiv" role="alert" class="alert alert-danger alert-icon alert-dismissible"  style="display: none">
                <div class="icon"><span class="mdi mdi-close"></span></div>
                <div class="message">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
                    <span class="feedback"></span>
                </div>
            </div>
        </div>


        <div class="row"  >
            <div class="col-lg-12">
                <div class="pull-right">
                    <button data-toggle="modal" data-target="#newuser" type="button" class="btn btn-space btn-primary">New User</button>
                    <!--                    <a  class="btn btn-primary" href="bulk-beneficiary-upload" >New Category</a>-->

                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default table-responsive">

                    <div class="panel-body">
                        <table id="usersTbl" class="table table-condensed table-hover table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th>Name</th>  
                                    <th>Email</th>  
                                    <th>Contact</th>  
                                    <th>Role</th>  
                                    <th>Date Created</th>
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
</div>

<!--Form Modals-->
<div id="newuser" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">New User</h3>
            </div>
            <form id="userForm">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Contact</label>
                        <input type="text" name="contact" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select class="select2" name="role" id="roles" required>
                            <option value="">Select ---</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Supervisor">Supervisor</option>

                        </select>
                    </div>

                    <div class="form-group" style="display: none" id="regiondiv">
                        <label>Region</label>
                        <select class="form-control select2" name="region" id="regions" >
                            <option value="">Select ---</option>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
                    <button type="submit" class="btn btn-info ">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="edituser" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Update User</h3>
            </div>
            <form id="updateuserForm">
                <div class="modal-body">
                    {{ csrf_field() }}

                    <input type="hidden" id="userid" name="userid"/>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name"id="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Contact</label>
                        <input type="text" name="contact" id="contact" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role" id="editrole" required>
                            <option value="">Select ---</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Supervisor">Supervisor</option>

                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
                    <button type="submit" class="btn btn-info ">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('customjs')

<script type="text/javascript">
    $(document).ready(function () {
        //initialize the javascript
        App.init();
        App.dataTables();
        //   $('.loader').addClass('be-loading-active');


    });

    $('#roles').change(function () {

        var value = $(this).val();
        if (value == "Supervisor") {
            $('#regiondiv').show();
        } else {
            $('#regiondiv').hide();
        }
        console.log('value :' + value);

    });


    $.ajax({
        url: "{{url('getregions')}}",
        type: "GET",
        dataType: 'json',
        success: function (data) {

            if (data == "401") {
                $('#sessionModal').modal({backdrop: 'static'}, 'show');
            }

            if (data == "500") {
                $('#errorModal').modal({backdrop: 'static'}, 'show');
            }
            var dataSet = data.data;

            $.each(dataSet, function (i, item) {

                $('#regions').append($('<option>', {
                    value: item.id,
                    text: item.name
                }));
            });

        }
    });

    var datatable = $('#usersTbl').DataTable();


    $('.loader').addClass('be-loading-active');
    getUsers();

    function getUsers() {
        $.ajax({
            url: "{{url('users/all')}}",
            type: "GET",
            dataType: 'json',
            success: function (data) {

                if (data == "401") {
                    $('#sessionModal').modal({backdrop: 'static'}, 'show');
                }

                if (data == "500") {
                    $('#errorModal').modal('show');
                }
                console.log('server data :' + data.data);
                var dataSet = data.data;
                console.log(dataSet);
                datatable.clear().draw();
                console.log('size' + dataSet.length);
                if (dataSet.length == 0) {
                    console.log("NO DATA!");
                } else {
                    $.each(dataSet, function (key, value) {


                        var j = -1;
                        var r = new Array();
                        // represent columns as array
                        r[++j] = '<td class="subject"> ' + value.name + '</td>';
                        r[++j] = '<td class="subject">' + value.email + '</td>';
                        r[++j] = '<td class="subject">' + value.contact + '</td>';
                        r[++j] = '<td class="subject">' + value.role + '</td>';
                        r[++j] = '<td class="subject">' + value.datecreated + '</td>';
                        r[++j] = '<td class="actions">' +
                                '<a  href="#"  onclick="editUser(' + value.id + ')"  type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title="View" class="mdi mdi-eye""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a>' +
                                '<a  href="#" onclick="deleteUser(' + value.id + ')" type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title ="Delete" class="mdi mdi-delete""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a>' +
                                '</td>';
                        rowNode = datatable.row.add(r);
                    });
                    rowNode.draw().node();
                }

                $('.loader').removeClass('be-loading-active');
            }

        });
    }

    function editUser(id) {

        $.ajax({
            url: "users/" + id,
            type: "GET",
            dataType: 'json',
            success: function (data) {

                if (data == "401") {
                    $('#sessionModal').modal({backdrop: 'static'}, 'show');
                }

                if (data == "500") {
                    $('#errorModal').modal('show');
                }
                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var dataArray = data.data;

                $('#username').val(dataArray[0].name);
                $('#email').val(dataArray[0].email);
                $('#contact').val(dataArray[0].contact);
                $('#role').val(dataArray[0].role);
                $('#userid').val(dataArray[0].id);

                $('#edituser').modal('show');
            }

        });
    }


    function deleteUser(id) {
        $('#itemid').val(id);
        $('#deleteModal').modal('show');
    }


    $('#userForm').on('submit', function (e) {

        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $('.loader').addClass('be-loading-active');
        $.ajax({
            url: "{{url('users/save')}}",
            type: "POST",
            data: formData,
            dataType: 'json',
            success: function (data) {

                if (data == "401") {
                    $('#sessionModal').modal({backdrop: 'static'}, 'show');
                }

                if (data == "500") {
                    $('#errorModal').modal('show');
                }
                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var status = data.status;
                if (status == 0) {
                    $('#newuser').modal('hide');
                    document.getElementById("userForm").reset();

                    $('.feedback').html(data.message);
                    $('#successdiv').show();
                    $('#errordiv').hide();
                    getUsers();

                }
                if (status == 1) {
                    $('.feedback').html(data.message);
                    $('#errordiv').show();
                    $('#successdiv').hide();
                }

            }

        });
    });



    $('#updateuserForm').on('submit', function (e) {

        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $('.loader').addClass('be-loading-active');
        $.ajax({
            url: "{{url('users/update')}}",
            type: "PUT",
            data: formData,
            dataType: 'json',
            success: function (data) {

                if (data == "401") {
                    $('#sessionModal').modal({backdrop: 'static'}, 'show');
                }

                if (data == "500") {
                    $('#errorModal').modal('show');
                }
                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var status = data.status;
                if (status == 0) {

                    $('#edituser').modal('hide');


                    document.getElementById("userForm").reset();

                    $('.feedback').html(data.message);
                    $('#successdiv').show();
                    $('#errordiv').hide();
                    getUsers();

                }
                if (status == 1) {
                    $('.feedback').html(data.message);
                    $('#errordiv').show();
                    $('#successdiv').hide();
                }

            }

        });
    });

    $('#deleteForm').on('submit', function (e) {

        e.preventDefault();
        var itemid = $('#itemid').val();
        var token = $('#token').val();
        $('#deleteModal').modal('hide');
        $('.loader').addClass('be-loading-active');
        $.ajax({
            url: "users/" + itemid,
            type: "DELETE",
            data: {_token: token},
            dataType: 'json',
            success: function (data) {

                if (data == "401") {
                    $('#sessionModal').modal({backdrop: 'static'}, 'show');
                }

                if (data == "500") {
                    $('#errorModal').modal('show');
                }

                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var status = data.status;
                if (status == 0) {
                    getUsers();
                    document.getElementById("deleteForm").reset();
                    $('.feedback').html(data.message);
                    $('#successdiv').show();
                    $('#errordiv').hide();
                }
                if (status == 1) {
                    $('.feedback').html(data.message);
                    $('#errordiv').show();
                    $('#successdiv').hide();
                }

            }

        });
    });




</script>
@endsection


