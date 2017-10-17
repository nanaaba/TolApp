@extends('layouts.forms')

@section('content')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Category</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Configuration</a></li>
            <li class="active">category</li>
        </ol>
    </div>
    <div class="main-content container-fluid">
        <!--Basic forms-->
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
                    <strong>Good!</strong> Better check yourself, you're not looking too good.
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading panel-heading-divider">Category Information
                        <div class="panel-body">
                            <form id="categoryForm" >

                                {{ csrf_field() }}

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" name="name" placeholder="Category Name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Image Name</label>
                                        <input type="text" name="url" placeholder="Url" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" name="price" placeholder="Amount" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Description</label>
                                        <div>
                                            <textarea name="description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>





                                <div class="row xs-pt-15">
                                    <div class="col-xs-6">

                                    </div>
                                    <div class="col-xs-6">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-primary">Submit</button>

                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    @endsection

    @section('customjs')
    <script type="text/javascript">

        $('#categoryForm').on('submit', function (e) {

            e.preventDefault();
            var formData = $(this).serialize();
            console.log(formData);
            //  var formData = new FormData($(this)[0]);
//add class to div
            $('.loader').addClass('be-loading-active');
            $.ajax({
                url: "{{url('configuration/savecategory')}}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (data) {

                    if (data == "401") {
                        $('#sessionModal').modal({backdrop: 'static'}, 'show');
                    }

                    if (data == "500") {
                        $('#errorModal').modal('show');
                    }

                    $('.loader').removeClass('be-loading-active');
                    console.log('server data :' + data.status);
                    var status = data.status;
                    if (status == 0) {
                        document.getElementById("categoryForm").reset();

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