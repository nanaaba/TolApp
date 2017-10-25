@extends('layouts.master')

@section('content')


<div class="be-content">
    <div class="main-content container-fluid">


        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="widget widget-tile">
                    <div  class="icon">

                        <div class="data-info">
                            <div class="desc">No Of Cashiers</div>
                            <div class="value">
                                <span class="indicator indicator-equal mdi mdi-chevron-right">

                                </span>
                                <span data-toggle="counter" data-end="{{$summation['totalcashiers']}}" class="number">
                                    {{$summation['totalcashiers']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="widget widget-tile">
                    <div  class="icon">

                        <div class="data-info">
                            <div class="desc">No Of TollPointss</div>
                            <div class="value">
                                <span class="indicator indicator-equal mdi mdi-chevron-right">

                                </span><span data-toggle="counter" data-end="{{$summation['totaltoll']}}" class="number">
                                    {{$summation['totaltoll']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="widget widget-tile">
                    <div  class="icon">

                        <div class="data-info">
                            <div class="desc">Number Of Transactions</div>
                            <div class="value">
                                <span class="indicator indicator-equal mdi mdi-chevron-right">

                                </span><span data-toggle="counter" data-end="{{$summation['numberoftransactions']}}" class="number">
                                    {{$summation['numberoftransactions']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">

                    <div class="panel-heading panel-heading-divider">

                        <span class="title">10 Best Performing Cashiers ( Across Country)</span>
                        <span class="panel-subtitle">
                            These are 10 best performing cashiers in this year across the country
                        </span>
                    </div>
                    <div class="panel-body">
                        <canvas id="cashiersPerformance" ></canvas>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">

                        <span class="title">Last 10 Non-Performing Cashiers ( Across Country)</span>
                        <span class="panel-subtitle">
                            These are last 10 non performing cashiers in this year across the country
                        </span>
                    </div>
                    <div class="panel-body">
                        <canvas id="cashiersNonPerformance"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">

                        <span class="title">Region Performance(This Year)</span>
                        <span class="panel-subtitle">
                            Performance of regions in this year
                        </span>
                    </div>
                    <div class="panel-body">
                        <canvas id="regions"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">

                        <span class="title">Shift Performance(This Year)</span>
                        <span class="panel-subtitle">
                            Performance of shift in this year
                        </span>
                    </div>
                    <div class="panel-body">
                        <canvas id="shift"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">

                        <span class="title">Best 10 Performing Tolls ( Across Country)</span>
                        <span class="panel-subtitle">
                            These are best performing tolls in this year across the country
                        </span>
                    </div>
                    <div class="panel-body">
                        <canvas id="perfomingtolls"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">

                        <span class="title">Last 10 Non-Performing Tolls ( Across Country)</span>
                        <span class="panel-subtitle">
                            These are last 10 non performing tolls in this year across the country
                        </span>
                    </div>
                    <div class="panel-body">
                        <canvas id="nonperformingtolls" ></canvas>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">

                        <span class="title">Cars Categories Performance (This Year)</span>
                        <span class="panel-subtitle">

                        </span>
                    </div>
                    <div class="panel-body">
                        <canvas id="categories"></canvas>
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


        function getPerformingCashiers() {



            return    $.ajax({
                url: "{{url('reports/performingcashiers')}}",
                type: "GET",
                dataType: 'json'

            });
        }

        function getNonPerformingCashiers() {



            return    $.ajax({
                url: "{{url('reports/nonperformingcashiers')}}",
                type: "GET",
                dataType: 'json'

            });
        }


        function getRegionPerformance() {



            return    $.ajax({
                url: "{{url('reports/regionperformance')}}",
                type: "GET",
                dataType: 'json'

            });
        }

        function getShiftPerformance() {



            return    $.ajax({
                url: "{{url('reports/shiftperformance')}}",
                type: "GET",
                dataType: 'json'

            });
        }

        function getPerformingTolls() {



            return    $.ajax({
                url: "{{url('reports/performingtolls')}}",
                type: "GET",
                dataType: 'json'

            });
        }
        function getNonPerformingTolls() {



            return    $.ajax({
                url: "{{url('reports/nonperformingtolls')}}",
                type: "GET",
                dataType: 'json'

            });
        }

        function getCategoryPerformance() {



            return    $.ajax({
                url: "{{url('reports/categoryperformance')}}",
                type: "GET",
                dataType: 'json'

            });
        }

        $.when(getPerformingCashiers()).done(function (response) {
            console.log(response);
    // the code here will be executed when all four ajax requests resolve.
    // a1, a2, a3 and a4 are lists of length 3 containing the response text,
    // status, and jqXHR object for each of the four ajax calls respectively.
            var dataSet = response.data;
            var cashiers = [];
            var figures = [];
            console.log('data her: ' + response);
            $.each(dataSet, function (i, item) {

                cashiers.push(item.cashier_name);
                figures.push(item.value);
            });
            figures = figures.map(Number);
            console.log('figures: ' + figures);
            console.log('regions:' + cashiers);
            var ctx = document.getElementById("cashiersPerformance");

            new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: cashiers,
                    datasets: [{
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            "borderWidth": 1,
                            "pointRadius": 1,
                            "label": "Performig Cashiers",
                            "data": figures

                        }]

                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        });



        $.when(getNonPerformingCashiers()).done(function (response) {
            console.log(response);
    // the code here will be executed when all four ajax requests resolve.
    // a1, a2, a3 and a4 are lists of length 3 containing the response text,
    // status, and jqXHR object for each of the four ajax calls respectively.
            var dataSet = response.data;
            var cashiers = [];
            var figures = [];
            console.log('data her: ' + response);
            $.each(dataSet, function (i, item) {

                cashiers.push(item.cashier_name);
                figures.push(item.value);
            });
            figures = figures.map(Number);
            console.log('figures: ' + figures);
            console.log('regions:' + cashiers);
            var ctx = document.getElementById("cashiersNonPerformance");

            new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: cashiers,
                    datasets: [{
                            "backgroundColor": 'rgba(54, 162, 235, 0.2)',
                            "borderColor": 'rgba(54, 162, 235, 1)',
                            "borderWidth": 1,
                            "pointRadius": 1,
                            "label": "Non-Performig Cashiers",
                            "data": figures

                        }]

                }
            });
        });

        $.when(getRegionPerformance()).done(function (response) {
            console.log(response);
    // the code here will be executed when all four ajax requests resolve.
    // a1, a2, a3 and a4 are lists of length 3 containing the response text,
    // status, and jqXHR object for each of the four ajax calls respectively.
            var dataSet = response.data;
            var regions = [];
            var figures = [];
            console.log('data her: ' + response);
            $.each(dataSet, function (i, item) {

                regions.push(item.region_name);
                figures.push(item.value);
            });
            figures = figures.map(Number);
            console.log('figures: ' + figures);
            console.log('regions:' + regions);
            var ctx = document.getElementById("regions").getContext('2d');
            ;

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: regions,
                    datasets: [{
                            backgroundColor: [
                                "#2ecc71",
                                "#3498db",
                                "#95a5a6",
                                "#9b59b6",
                                "#f1c40f",
                                "#e74c3c",
                                "#34495e"
                            ],
                            data: figures
                        }]

                }
            });
        });


        $.when(getShiftPerformance()).done(function (response) {
            console.log(response);
    // the code here will be executed when all four ajax requests resolve.
    // a1, a2, a3 and a4 are lists of length 3 containing the response text,
    // status, and jqXHR object for each of the four ajax calls respectively.
            var dataSet = response.data;
            var shifts = [];
            var figures = [];
            console.log('data her: ' + response);
            $.each(dataSet, function (i, item) {

                shifts.push(item.shift);
                figures.push(item.value);
            });
            figures = figures.map(Number);
            console.log('figures: ' + figures);
            console.log('shifts:' + shifts);
            var ctx = document.getElementById("shift").getContext('2d');
            ;

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: shifts,
                    datasets: [{
                            backgroundColor: [
                                "#9b59b6",
                                "#f1c40f",
                                "#e74c3c",
                                "#34495e"
                            ],
                            data: figures
                        }]

                }
            });
        });



        $.when(getPerformingTolls()).done(function (response) {
            console.log(response);
    // the code here will be executed when all four ajax requests resolve.
    // a1, a2, a3 and a4 are lists of length 3 containing the response text,
    // status, and jqXHR object for each of the four ajax calls respectively.
            var dataSet = response.data;
            var cashiers = [];
            var figures = [];
            console.log('data her: ' + response);
            $.each(dataSet, function (i, item) {

                cashiers.push(item.area);
                figures.push(item.value);
            });
            figures = figures.map(Number);
            console.log('figures: ' + figures);
            console.log('regions:' + cashiers);
            var ctx = document.getElementById("perfomingtolls");

            new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: cashiers,
                    datasets: [{
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            "borderWidth": 1,
                            "pointRadius": 1,
                            "label": "Performig TollPoints",
                            "data": figures

                        }]

                }
            });
        });

        $.when(getNonPerformingTolls()).done(function (response) {
            console.log(response);
    // the code here will be executed when all four ajax requests resolve.
    // a1, a2, a3 and a4 are lists of length 3 containing the response text,
    // status, and jqXHR object for each of the four ajax calls respectively.
            var dataSet = response.data;
            var cashiers = [];
            var figures = [];
            console.log('data her: ' + response);
            $.each(dataSet, function (i, item) {

                cashiers.push(item.area);
                figures.push(item.value);
            });
            figures = figures.map(Number);
            console.log('tollfigures: ' + figures);
            console.log('toll regions:' + cashiers);
            var ctx = document.getElementById("nonperformingtolls");

            new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: cashiers,
                    datasets: [{
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            "borderWidth": 1,
                            "pointRadius": 1,
                            "label": "Non Performig TollPoints",
                            "data": figures

                        }]

                }
            });
        });


        $.when(getCategoryPerformance()).done(function (response) {
            console.log(response);
    // the code here will be executed when all four ajax requests resolve.
    // a1, a2, a3 and a4 are lists of length 3 containing the response text,
    // status, and jqXHR object for each of the four ajax calls respectively.
            var dataSet = response.data;
            var cashiers = [];
            var figures = [];
            console.log('data her: ' + response);
            $.each(dataSet, function (i, item) {

                cashiers.push(item.category_name);
                figures.push(item.value);
            });
            figures = figures.map(Number);
            console.log('figures: ' + figures);
            console.log('regions:' + cashiers);
            var ctx = document.getElementById("categories");

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: cashiers,
                    datasets: [{
                            "backgroundColor": 'rgba(54, 162, 235, 0.2)',
                            "borderColor": 'rgba(54, 162, 235, 1)',
                            "borderWidth": 1,
                            "pointRadius": 1,
                            "label": "Cars Categories",
                            "data": figures

                        }]

                }
            });
        });


    </script>
    @endsection