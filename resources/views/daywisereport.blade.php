@extends('layouts.forms')

@section('content')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Daily Report</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li class="active">Daily Report</li>
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
                                            <label class=" control-label">Toll</label>

                                            <select class="select2 select2-hidden-accessible" id="tollpoints" name="tollpoints" tabindex="-1" aria-hidden="true">

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
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">



                    <div class="panel-body">
                        <table id="transactionTbl" class=" table-responsive table table-striped table-hover table-fw-widget">
                            <thead>
                                <tr>
                                    <th>Transaction Date</th>
                                    <th>Toll</th>
                                    <th>Category</th>
                                    <th>No Of Transactions</th>
                                    <th>Total Transactions(GHS)</th>


                                </tr>
                            </thead>
                            <tbody id="transactionbody">

                            </tbody>
                            <tfoot style="font-size: 20px;">
                                <tr>
                                    <th colspan="3"></th>


                                    <th >
                                        Total Transactions Cost :
                                    </th>
                                    <th  id="totalcost"></th>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



    @endsection

    @section('customjs')
    <script type="text/javascript">


//        var datatable = $('#transactionTbl').DataTable({
//            buttons: [
//                'copy', 'excel', 'pdf'
//            ]
//        });
//        datatable.buttons().container()
//                .appendTo($('.col-sm-6:eq(0)', datatable.table().container()));

        var datatable = $('#transactionTbl').DataTable({
            lengthChange: false,
            buttons: [
                {extend: 'copyHtml5', footer: true},
                {extend: 'excelHtml5', footer: true},
                {extend: 'csvHtml5', footer: true},
                {extend: 'pdfHtml5', footer: true},
                {extend: 'print', footer: true}
            ]
        });

        datatable.buttons().container()
                .appendTo('#transactionTbl_wrapper .col-sm-6:eq(0)');

        $('#reportForm').on('submit', function (e) {
            $('.loader').addClass('be-loading-active');
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{url('reports/dailyreport')}}",
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
                    console.log('server data :' + data.data);
                    var dataSet = data.data;
                    console.log(dataSet);
                    datatable.clear().draw();
                    console.log('size' + dataSet.length);
                    if (dataSet.length == 0) {
                        $('#infoModal').modal('show');

                        return;
                    }

                    $.each(dataSet, function (key, value) {




                        var j = -1;
                        var r = new Array();
                        // represent columns as array
                        r[++j] = '<td>' + value.transaction_date + '</td>';
                        r[++j] = '<td class="subject"> ' + value.toll_name + '</td>';
                        r[++j] = '<td class="subject">' + value.category_name + '</td>';
                        r[++j] = '<td class="subject">' + value.nooftransactions + '</td>';
                        r[++j] = '<td class="subject">' + value.totaltransactions + '</td>';
                        rowNode = datatable.row.add(r);
                    });
                    rowNode.draw().node();


                    var total = datatable.column(4).data().sum();
                    $('#totalcost').html('GHS ' + total.toFixed(2));

                    $('.loader').removeClass('be-loading-active');
                }



            });
        });
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