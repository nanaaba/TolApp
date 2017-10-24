@extends('layouts.forms')

@section('content')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Change Password</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Change Password</li>
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
                    <span class="feedback"></span>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading panel-heading-divider">Change Password
                        <div class="panel-body">
                            <form id="changepasswordForm" >

                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                                        </div>
                                    </div>
                                </div>



                                <div class="row xs-pt-15">
                                    <div class="col-xs-6">

                                    </div>
                                    <div class="col-xs-6">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-primary">Proceed</button>

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


        $('#changepasswordForm').on('submit', function (e) {

            e.preventDefault();
            var formData = $(this).serialize();
            console.log(formData);

            var password = $('#password').val();
            var confirmpassword = $('#confirm_password').val();
            if (password != confirmpassword) {
                $('.feedback').html('Password do not match');
                $('#errordiv').show();
                $('#successdiv').hide();
            } else {

                $('.loader').addClass('be-loading-active');
                $.ajax({
                    url: "{{url('users/changepassword')}}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (data) {

                        if (data == "401") {
                            $('#sessionModal').modal({backdrop: 'static'}, 'show');
                        }

                        if (data == "500") {
                            $('#errorModal').modal({backdrop: 'static'}, 'show');
                        }
                        
                        $('.loader').removeClass('be-loading-active');
                        console.log('server data :' + data.status);
                        var status = data.status;
                        if (status == 0) {
                            document.getElementById("changepasswordForm").reset();

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

            }
        });

    </script>
    @endsection