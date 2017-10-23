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
