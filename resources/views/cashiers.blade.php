@extends('layouts.master')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Cashiers</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Configuration</a></li>
            <li class="active">Cashiers</li>
        </ol>
    </div>
    <div class="main-content container-fluid">
        
        
        
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default table-responsive">

                    <div class="panel-body">
                        <table id="transactionTbl" class="table table-condensed table-hover table-bordered table-striped">
                       
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Toll</th>
                                     <th>District Name</th>
                                    <th>Date Created</th>
                                </tr>
                            </thead>
                            <tbody>

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
        App.dataTables();
        $('.loader').addClass('be-loading-active');
        var datatable = $('#transactionTbl').DataTable();
        $.ajax({
            url: "{{url('getcashiers')}}",
            type: "GET",
            dataType: 'json',
            success: function (data) {
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
                        r[++j] = '<td class="subject"> ' + value.contact + '</td>';
                        r[++j] = '<td class="subject">' + value.area + '</td>';
                         r[++j] = '<td class="subject">' + value.district_name + '</td>';
                        r[++j] = '<td class="subject">' + value.dateadded + '</td>';

                        rowNode = datatable.row.add(r);
                    });

                    rowNode.draw().node();
                }

                $('.loader').removeClass('be-loading-active');

            }

        });
    });
</script>
@endsection
