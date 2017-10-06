@extends('layouts.forms')

@section('content')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Toll</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Configuration</a></li>
            <li class="active">TOll</li>
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
                    <div class="panel-heading panel-heading-divider">Toll Information
                        <div class="panel-body">
                            <form id="tollForm" >

                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class=" control-label">Regions</label>

                                            <select class="select2 select2-hidden-accessible" name="regions" id="regions" tabindex="-1" aria-hidden="true" required>

                                                <option value="">Select ---</option>

                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label>Area Name</label>
                                            <input type="text" name="area" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class=" control-label">District</label>

                                            <select class="select2 select2-hidden-accessible" name="districts" id="districts" tabindex="-1" aria-hidden="true" required>

                                                <option value="">Select ---</option>

                                            </select>

                                        </div>

                                    </div>
                                </div>


                                <div class="row">

                                    <div class="row xs-pt-15">
                                        <div class="col-xs-6">

                                        </div>
                                        <div class="col-xs-6">
                                            <p class="text-right">
                                                <button type="submit" class="btn btn-space btn-primary">Submit</button>

                                            </p>
                                        </div>
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

        $.ajax({
            url: "{{url('gettollpoints')}}",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                var dataSet = data.data;

                $.each(dataSet, function (i, item) {

                    $('#tollpoints').append($('<option>', {
                        value: item.id,
                        text: item.area
                    }));
                });
                $('#loaderModal').modal('hide');
            }
        });

        $.ajax({
            url: "{{url('getregions')}}",
            type: "GET",
            dataType: 'json',
            success: function (data) {

                var dataSet = data.data;

                $.each(dataSet, function (i, item) {

                    $('#regions').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });
                $('#loaderModal').modal('hide');
            }
        });


        $.ajax({
            url: "{{url('getdistricts')}}",
            type: "GET",
            dataType: 'json',
            success: function (data) {

                var dataSet = data.data;

                $.each(dataSet, function (i, item) {

                    $('#districts').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });
                $('#loaderModal').modal('hide');
            }
        });

        $('#tollForm').on('submit', function (e) {

            e.preventDefault();
            var formData = $(this).serialize();
            console.log(formData);
            //  var formData = new FormData($(this)[0]);
//add class to div
            $('.loader').addClass('be-loading-active');
            $.ajax({
                url: "{{url('savetoll')}}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (data) {
                    $('.loader').removeClass('be-loading-active');
                    console.log('server data :' + data.status);
                    var status = data.status;
                    if (status == 0) {
                        document.getElementById("tollForm").reset();

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