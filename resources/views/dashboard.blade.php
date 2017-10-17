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
            <div class="col-xs-12 col-md-12">
                <div class="panel panel-default table-responsive">
                    <div class="panel-heading"> 

                        <div class="title">Cumulative Report On TollPoint Level</div>
                    </div>


                    <div class="panel-body">
                        <table id="reportTbl" class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                                                    
                                    <th style="width:25%;" >Toll</th>
                                    <th >Number Of Transactions</th>
                                    <th> Total Transactions(GHS)</th>
                                </tr>
                            </thead>
                            <tbody class="no-border-x">
                                <?php
                                foreach ($reports as $value) {
                                    echo '<tr>'
                                    . '<td>' . $value['tollname'] . '</td>'
                                    . '<td>' . $value['nooftransactions'] . '</td>'
                                    . '<td>' . number_format((float)$value['totaltransactions'], 2, '.', '')  . '</td>'
                                    . '</tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div style="margin-top: 20px"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default table-responsive">
                    <div class="panel-heading"> 

                        <div class="title">Cumulative Report On Regional Level</div>
                    </div>


                    <div class="panel-body">
                        <table id="transactionTbl" class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th style="width:50%;">Region</th>

                                    <th >Number Of Transactions</th>
                                    <th> Total Transactions</th>
                                </tr>
                            </thead>
                            <tbody class="no-border-x">
                                <?php
                                foreach ($regionsreport as $value) {
                                    echo '<tr>'
                                    . '<td class="text-success">' . $value['region_name'] . '</td>'
                                    . '<td>' . $value['nooftransactions'] . '</td>'
                                    . '<td> GHS ' . $value['totaltransactions'] . '</td>'
                                    . '</tr>';
                                }
                                ?>

                            </tbody>
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
    $(document).ready(function () {
        //initialize the javascript
        App.init();
        App.dashboard();
        //App.formElements();
    });

    var datatable = $('#reportTbl').DataTable({
         lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'print', 'colvis'],
        

    });

    datatable.buttons().container()
            .appendTo('#reportTbl_wrapper .col-sm-6:eq(0)');
    var datatable = $('#transactionTbl').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
    });

    datatable.buttons().container()
            .appendTo('#transactionTbl_wrapper .col-sm-6:eq(0)');




</script>
@endsection