@extends('layouts.forms')

@section('content')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Monthly Report</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Report</a></li>
            <li class="active">Monthly Report</li>
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
                                            <label class=" control-label">Year</label>

                                            <select class="select2 select2-hidden-accessible" name="year"  tabindex="-1" aria-hidden="true">

                                                <option value="">Select ---</option>
                                                <?php
                                                $i = '2017';
                                                $year = date("Y") + 3;
                                                while ($i < $year) {
                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                    $i++;
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=" control-label">Month</label>

                                            <select class="select2 select2-hidden-accessible"  name="month" tabindex="-1" aria-hidden="true" required>

                                                <option value="">Select ---</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class=" control-label">Toll</label>

                                            <select class="select2 select2-hidden-accessible" id="tollpoints" name="toll" tabindex="-1" aria-hidden="true" required>

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
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">



                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="transactionTbl" class="table table-striped table-hover table-fw-widget">
                                <thead>
                                    <tr>
                                        <th>Transaction Month</th>
                                        <th>Transaction Year</th>
                                        <th>Toll</th>
                                        <th>Category</th>
                                        <th>No Of Transactions</th>
                                        <th>Total Transactions(GHS)</th>



                                    </tr>
                                </thead>
    <!--                            <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align:right">Total:</th>
                                        <th></th>
                                    </tr>
                                </tfoot>-->
                                <tbody id="transactionbody">

                                </tbody>

                                <tfoot style="font-size: 20px;">
                                    <tr>
                                        <th colspan="3"></th>


                                        <th colspan="2">
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
            ],
            "columnDefs": [
                {"width": "15%", "targets": 0},
                {"width": "15%", "targets": 1},
                {"width": "25%", "targets": 2},
                {"width": "25%", "targets": 3},
                {"width": "10%", "targets": 4}
            ]
        });

        datatable.buttons().container()
                .appendTo('#transactionTbl_wrapper .col-sm-6:eq(0)');

        $('#reportForm').on('submit', function (e) {
            $('.loader').addClass('be-loading-active');
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{url('reports/monthlyreport')}}",
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
                        $('#totalcost').html('GHS 0.00');

                        $('#infoModal').modal('show');

                        return;
                    } else {
                        $.each(dataSet, function (key, value) {




                            var j = -1;
                            var r = new Array();
                            // represent columns as array
                            r[++j] = '<td>' + value.transaction_month + '</td>';
                            r[++j] = '<td>' + value.transaction_year + '</td>';
                            r[++j] = '<td class="subject"> ' + value.toll_name + '</td>';
                            r[++j] = '<td class="subject">' + value.category_name + '</td>';

                            r[++j] = '<td class="subject">' + value.nooftransactions + '</td>';
                            r[++j] = '<td class="subject"> GHS ' + value.totaltransactions + '</td>';
                            rowNode = datatable.row.add(r);
                        });
                        rowNode.draw().node();
                    }
                    var total = datatable.column(5).data().sum();
                    $('#totalcost').html('GHS ' + total.toLocaleString("en"));

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
    </script>
    @endsection