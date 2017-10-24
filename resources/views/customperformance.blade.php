@extends('layouts.master')

@section('content')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Custom Performance</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Analytics</a></li>
            <li class="active">Custom Performance</li>
        </ol>
    </div>
    <div class="main-content container-fluid">
        <!--Basic forms-->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading panel-heading-divider">
                        <div class="panel-body">
                            <form id="reportForm" >

                                {{ csrf_field() }}

                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class=" control-label">Report Level</label>

                                            <select class="select2 select2-hidden-accessible" name="reportlevel" id="reportlevel" tabindex="-1" aria-hidden="true" required>

                                                <option value="">Select ---</option>
                                                <option value="region">Region level</option> 
                                                <option value="toll">Toll Level</option>
                                                <option value="cashier">Cashier Level</option> 
                                                <option value="category">Category Level</option> 
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-6"  >
                                        <div class="form-group">
                                            <label class=" control-label">Shift</label>

                                            <select class="select2 select2-hidden-accessible" name="shift" id="shift" tabindex="-1" aria-hidden="true">

                                                <option value="">Select ---</option>
                                                <option value="morning">Morning</option>
                                                <option value="afternoon">Afternoon</option>
                                                <option value="night">Night</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-6" id="regiondiv" style="display: none">
                                        <div class="form-group">
                                            <label class=" control-label">Regions</label>

                                            <select class="select2 select2-hidden-accessible" name="regions" id="regions" tabindex="-1" aria-hidden="true">

                                                <option value="">Select ---</option>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-6" id="tolldiv" style="display: none">
                                        <div class="form-group">
                                            <label class=" control-label">Toll</label>

                                            <select class="select2 select2-hidden-accessible" id="tollpoints" name="tollpoints" tabindex="-1" aria-hidden="true">

                                                <option value="">Select ---</option>

                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-sm-6" id="cashierdiv" style="display: none">
                                        <div class="form-group">
                                            <label class=" control-label">Cashiers</label>

                                            <select class="select2 select2-hidden-accessible" name="cashiers" id="cashiers" tabindex="-1" aria-hidden="true">

                                                <option value="">Select ---</option>

                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class=" control-label">Date Range</label>

                                            <input type="text" name="daterange" value="" class="form-control daterange">
                                        </div>
                                    </div>
                                </div>




                                <div class="row xs-pt-15">
                                    <div class="col-xs-6">

                                    </div>
                                    <div class="col-xs-6">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-primary">Spool Result</button>

                                        </p>
                                    </div>
                                </div>
                            </form>





                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">

                        <span class="title">Performance Analysis</span>
                        <span class="panel-subtitle">

                        </span>
                    </div>
                    <div class="panel-body">
                        <canvas id="results"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('customjs')
<script type="text/javascript">
    App.init();



    $('#reportlevel').change(function () {
        var reportlevel = $(this).val();

        if (reportlevel == 'cashier') {
            $('#regiondiv').show();
            $('#tolldiv').show();
            $('#categorydiv').hide();
            $('#cashierdiv').hide();
        }
        if (reportlevel == 'category') {
            $('#regiondiv').show();
            $('#tolldiv').show();

            $('#cashierdiv').show();
        }
        if (reportlevel == 'toll') {
            $('#regiondiv').show();
            $('#tolldiv').hide();
            $('#categorydiv').hide();
            $('#cashierdiv').hide();
        }
        if (reportlevel == 'region') {
            $('#regiondiv').hide();
            $('#tolldiv').hide();
            $('#categorydiv').hide();
            $('#cashierdiv').hide();
        }
    });


    $('#reportForm').on('submit', function (e) {
        $('.loader').addClass('be-loading-active');
        e.preventDefault();
        var formData = $(this).serialize();

        var level = $('#reportlevel option:selected').text();

        $.when(customPerformance(formData)).done(function (response) {
            console.log(response);
// the code here will be executed when all four ajax requests resolve.
// a1, a2, a3 and a4 are lists of length 3 containing the response text,
// status, and jqXHR object for each of the four ajax calls respectively.
            var dataSet = response.data;
            var results = [];
            var figures = [];
            console.log('data her: ' + response);
            $.each(dataSet, function (i, item) {

                results.push(item.description);
                figures.push(item.value);
            });
            figures = figures.map(Number);
            console.log('figures: ' + figures);
            console.log('data:' + results);
            var ctx = document.getElementById("results");
            ;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: results,
                    datasets: [{
                            "borderColor": 'rgba(54, 162, 235, 1)',
                            "borderWidth": 1,
                            data: figures,
                            "label": "Performance Analysis on  " + level
                        }]

                }
            });
        });

        $('.loader').removeClass('be-loading-active');





    });


    function customPerformance(formData) {



        return    $.ajax({
            url: "{{url('reports/customperformance')}}",
            type: "POST",
            data: formData,
            dataType: 'json'

        });
    }







    $.ajax({
        url: "{{url('configuration/gettollpoints')}}",
        type: "GET",
        dataType: 'json',
        success: function (data) {

            if (data == "401") {
                $('#sessionModal').modal({backdrop: 'static'}, 'show');
            }

            if (data == "500") {
                $('#errorModal').modal('show');
            }
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

            if (data == "401") {
                $('#sessionModal').modal({backdrop: 'static'}, 'show');
            }

            if (data == "500") {
                $('#errorModal').modal('show');
            }

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
        url: "{{url('configuration/getcategories')}}",
        type: "GET",
        dataType: 'json',
        success: function (data) {

            if (data == "401") {
                $('#sessionModal').modal({backdrop: 'static'}, 'show');
            }

            if (data == "500") {
                $('#errorModal').modal('show');
            }
            var dataSet = data.data;
            $.each(dataSet, function (i, item) {

                $('#categories').append($('<option>', {
                    value: item.id,
                    text: item.name
                }));
            });
            $('#loaderModal').modal('hide');
        }
    });
    $.ajax({
        url: "{{url('configuration/getcashiers')}}",
        type: "GET",
        dataType: 'json',
        success: function (data) {

            if (data == "401") {
                $('#sessionModal').modal({backdrop: 'static'}, 'show');
            }

            if (data == "500") {
                $('#errorModal').modal('show');
            }
            var dataSet = data.data;
            $.each(dataSet, function (i, item) {

                $('#cashiers').append($('<option>', {
                    value: item.id,
                    text: item.name
                }));
            });
            $('#loaderModal').modal('hide');
        }
    });



    $('#regions').change(function () {
        var region = $(this).val();
        console.log('region code ' + region);
        var url = 'getdistricts/' + region;
        $.ajax({
            url: url,
            type: "GET",
            dataType: 'json',
            success: function (data) {

                if (data == "401") {
                    $('#sessionModal').modal({backdrop: 'static'}, 'show');
                }

                if (data == "500") {
                    $('#errorModal').modal('show');
                }
                var dataSet = data.data;
                console.log('district data: ' + dataSet);
                $.each(dataSet, function (i, item) {

                    $('#districts').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });
                $('#loaderModal').modal('hide');
            }
        });
    });
</script>
@endsection