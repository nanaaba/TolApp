@extends('layouts.master')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Categories</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Configuration</a></li>
            <li class="active">Categories</li>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default table-responsive">

                    <div class="panel-body">
                        <table id="transactionTbl" class="table table-condensed table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount(GHS)</th>
                                    <th>Description</th>
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



        <div id="editmodal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
            <div class="modal-dialog custom-width">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                        <h3 class="modal-title">Update VehicleType</h3>
                    </div>
                    <form id="updateForm">
                        <div class="modal-body">
                            {{ csrf_field() }}

                            <input type="hidden" id="categoryid" name="categoryid"/>
                            <div class="form-group">
                                <label>Vehicle Type</label>
                                <input type="text" name="name" id="vehicletype" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Image Name</label>
                                <input type="text" name="url" placeholder="Url" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" name="price" id="amount" placeholder="Amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>
                                <div>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
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

    </div>
</div>
@endsection

@section('customjs')

<script type="text/javascript">
    $(document).ready(function () {
        //initialize the javascript
      
        $('.loader').addClass('be-loading-active');



    });
    var datatable = $('#transactionTbl').DataTable({
        "order": [[3, "desc"]]
    });

    $('.loader').addClass('be-loading-active');
    getCategories();

    function getCategories() {
        $.ajax({
            url: "{{url('configuration/getcategories')}}",
            type: "GET",
            dataType: 'json',
            success: function (data) {

                if (data == "401") {
                 
                    $('#sessionModal').modal({backdrop: 'static'}, 'show');
                    return;
                }

                if (data == "500") {
                    $('#errorModal').modal({backdrop: 'static'}, 'show');
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
                        r[++j] = '<td>' + value.name + '</td>';
                        r[++j] = '<td class="subject"> ' + value.amount + '</td>';
                        r[++j] = '<td class="subject">' + value.description + '</td>';
                        r[++j] = '<td class="subject">' + value.datecreated + '</td>';
                        r[++j] = '<td class="actions">' +
                                '<a  href="#"  onclick="editCategory(' + value.id + ')"  type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title="View" class="mdi mdi-eye""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a>' +
                                '<a  href="#" onclick="deleteCategory(' + value.id + ')" type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title ="Delete" class="mdi mdi-delete""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a>' +
                                '</td>';
                        rowNode = datatable.row.add(r);
                    });

                    rowNode.draw().node();
                }

                $('.loader').removeClass('be-loading-active');

            }

        });
    }
    function deleteCategory(id) {
        $('#itemid').val(id);
        $('#deleteModal').modal('show');
    }

    function editCategory(id) {

        $.ajax({
            url: "category/" + id,
            type: "GET",
            dataType: 'json',
            success: function (data) {
                if (data == "401") {
                    $('#sessionModal').modal({backdrop: 'static'}, 'show');
                }

                if (data == "500") {
                    $('#errorModal').modal({backdrop: 'static'}, 'show');
                }

                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var dataArray = data.data;

                $('#vehicletype').val(dataArray[0].name);
                $('#description').val(dataArray[0].description);
                $('#url').val(dataArray[0].url);
                $('#amount').val(dataArray[0].amount);
                ;
                $('#categoryid').val(dataArray[0].id);

                $('#editmodal').modal('show');
            }

        });
    }


    $('#updateForm').on('submit', function (e) {

        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $('.loader').addClass('be-loading-active');
        $.ajax({
            url: "{{url('configuration/updatecategory')}}",
            type: "PUT",
            data: formData,
            dataType: 'json',
            success: function (data) {

                if (data == "401") {
                    $('#sessionModal').modal({backdrop: 'static'}, 'show');
                }

                if (data == "500") {
                    $('#errorModal').modal({backdrop: 'static'}, 'show');
                }

                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var status = data.status;
                if (status == 0) {

                    $('#editmodal').modal('hide');


                    document.getElementById("updateForm").reset();

                    $('.feedback').html(data.message);
                    $('#successdiv').show();
                    $('#errordiv').hide();
                    getCategories();

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
            url: "deletecategory/" + itemid,
            type: "DELETE",
            data: {_token: token},
            dataType: 'json',
            success: function (data) {

                if (data == "401") {
                    $('#sessionModal').modal({backdrop: 'static'}, 'show');
                }

                if (data == "500") {
                    $('#errorModal').modal({backdrop: 'static'}, 'show');
                }

                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var status = data.status;
                if (status == 0) {
                    getCategories();
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
