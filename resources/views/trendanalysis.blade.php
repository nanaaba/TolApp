@extends('layouts.master')

@section('content')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Trend Analysis</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Analytics</a></li>
            <li class="active">Trend Analysis</li>
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

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=" control-label"> Report</label>

                                            <select class="select2 " name="report" id="report" tabindex="-1" aria-hidden="true">

                                                <option value="">Select ---</option>
                                                <option value="weekly">Weekly</option>  
                                                <option value="monthly">Monthly</option> 
                                                <option value="yearly">Yearly</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=" control-label">Type</label>

                                            <select class="select2 " id="type" name="type" tabindex="-1" aria-hidden="true">

                                                <option value="">Select ---</option>
                                                <option value="toll">Tollpoints</option>  
                                                <option value="cashier">Cashiers</option> 
                                                <option value="category">Categories</option>
                                                <option value="shift">Shift</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=" control-label">Data</label>

                                            <select class="select2 select2-hidden-accessible" name="value" id="resultdata" tabindex="-1" aria-hidden="true">

                                                <option value="">Select ---</option>

                                            </select>

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

                        <span class="title">Trend Analysis</span>
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
    $(document).ready(function () {
        //initialize the javascript

        App.dashboard();
        //App.formElements();
    });
    function ordinal_suffix_of(i) {
        var j = i % 10,
                k = i % 100;
        if (j == 1 && k != 11) {
            return i + "st";
        }
        if (j == 2 && k != 12) {
            return i + "nd";
        }
        if (j == 3 && k != 13) {
            return i + "rd";
        }
        return i + "th";
    }

    function isInt(value) {
        return !isNaN(value) && (function (x) {
            return (x | 0) === x;
        })(parseFloat(value))
    }





    $('#reportForm').on('submit', function (e) {
        $('.loader').addClass('be-loading-active');
        e.preventDefault();
        var formData = $(this).serialize();

        var value = $('#resultdata').val();
        var type = $('#type').val();
        var report = $('#report').val();
        var valuetext = $('#resultdata option:selected').text();


        if (report == 'weekly') {

            $.when(weeklyreport(value, type)).done(function (response) {
                console.log(response);
// the code here will be executed when all four ajax requests resolve.
// a1, a2, a3 and a4 are lists of length 3 containing the response text,
// status, and jqXHR object for each of the four ajax calls respectively.
                var dataSet = response.data;
                var results = [];
                var figures = [];
                console.log('data her: ' + dataSet.length);

                if (dataSet.length == 0) {
                    $('#infoModal').modal('show');

                    return;
                }

                $.each(dataSet, function (i, item) {

                    results.push(item.date);
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
                                "label": "Weekly Trend for " + type + " " + valuetext
                            }]

                    }
                });
            });

            $('.loader').removeClass('be-loading-active');
        }

        if (report == 'monthly') {

            $.when(monthlyreport(value, type)).done(function (response) {
                console.log(response);
// the code here will be executed when all four ajax requests resolve.
// a1, a2, a3 and a4 are lists of length 3 containing the response text,
// status, and jqXHR object for each of the four ajax calls respectively.
                var dataSet = response.data;
                var results = [];
                var figures = [];
                console.log('data her: ' + response);

                if (dataSet.length == 0) {
                    $('#infoModal').modal('show');

                    return;
                }
                $.each(dataSet, function (i, item) {
                    var boolval = isInt(item.date);         // true
                    console.log('bool val :' + boolval);
                    if (boolval == true) {
                        results.push(ordinal_suffix_of(item.date));
                        figures.push(item.value);
                    } else {
                        results.push(item.date);
                        figures.push(item.value);
                    }
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
                                "label": "Weekly Trend for " + type + " " + valuetext
                            }]

                    }
                });
            });

            $('.loader').removeClass('be-loading-active');
        }




        if (report == 'yearly') {

            $.when(yearlyreport(value, type)).done(function (response) {
                console.log(response);
// the code here will be executed when all four ajax requests resolve.
// a1, a2, a3 and a4 are lists of length 3 containing the response text,
// status, and jqXHR object for each of the four ajax calls respectively.
                var dataSet = response.data;
                var results = [];
                var figures = [];
                console.log('data her: ' + response);

                if (dataSet.length == 0) {
                    $('#infoModal').modal('show');

                    return;
                }
                $.each(dataSet, function (i, item) {

                    results.push(item.date);
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
                                "label": "Yearly Trend for " + type + " " + valuetext
                            }]

                    }
                });
            });

            $('.loader').removeClass('be-loading-active');
        }
    });

    function weeklyreport(value, type) {



        return    $.ajax({
            url: "{{url('reports/weekly')}}",
            type: "POST",
            data: {
                type: type,
                value: value,
                _token: "{{ csrf_token() }}",
            },
            dataType: 'json'

        });
    }


    function yearlyreport(value, type) {



        return    $.ajax({
            url: "{{url('reports/yearly')}}",
            type: "POST",
            data: {
                type: type,
                value: value,
                _token: "{{ csrf_token() }}",
            },
            dataType: 'json'

        });
    }




    function monthlyreport(value, type) {



        return    $.ajax({
            url: "{{url('reports/monthly')}}",
            type: "POST",
            data: {
                type: type,
                value: value,
                _token: "{{ csrf_token() }}",
            },
            dataType: 'json'

        });
    }


    $('#type').change(function () {
        var type = $(this).val();
        $('#resultdata').empty();
        if (type == 'cashier') {
            getCashiers();
        }
        if (type == 'category') {
            getCategories();
        }
        if (type == 'toll') {
            getTolls();
        }
        if (type == 'shift') {

            $('#resultdata').append($('<option>', {
                value: "",
                text: "Select -- "
            }));
            $('#resultdata').append($('<option>', {
                value: 'morning',
                text: 'Morning'
            }));
            $('#resultdata').append($('<option>', {
                value: 'afternoon',
                text: 'Afternoon'
            }));
            $('#resultdata').append($('<option>', {
                value: 'night',
                text: 'Night'
            }));
        }
    });

    function getCategories() {

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
                $('#resultdata').append($('<option>', {
                    value: "",
                    text: "Select -- "
                }));
                $.each(dataSet, function (i, item) {



                    $('#resultdata').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });
                $('#loaderModal').modal('hide');
            }
        });

    }


    function getCashiers() {

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
                $('#resultdata').append($('<option>', {
                    value: "",
                    text: "Select -- "
                }));
                $.each(dataSet, function (i, item) {

                    $('#resultdata').append($('<option>', {
                        value: item.id,
                        text: item.name + ' :  ' + item.region_name
                    }));
                });
                $('#loaderModal').modal('hide');
            }
        });

    }


    function getTolls() {

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
                $('#resultdata').append($('<option>', {
                    value: "",
                    text: "Select -- "
                }));
                $.each(dataSet, function (i, item) {

                    $('#resultdata').append($('<option>', {
                        value: item.id,
                        text: item.area + ' :  ' + item.region_name
                    }));
                });
                $('#loaderModal').modal('hide');
            }
        });

    }

</script>
@endsection

