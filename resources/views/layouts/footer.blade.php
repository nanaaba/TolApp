<script src="{{ asset('assets/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/main.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/countup/countUp.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jqvmap/jquery.vmap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery.nestable/jquery.nestable.js')}}"  type="text/javascript"></script>
<script src="{{ asset('assets/lib/moment.js/min/moment.min.js')}}"  type="text/javascript"></script>
<script src="{{ asset('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"  type="text/javascript"></script>
<script src="{{ asset('assets/lib/daterangepicker/js/daterangepicker.js')}}"  type="text/javascript"></script>
<script src="{{ asset('assets/lib/select2/js/select2.min.js')}}"  type="text/javascript"></script>
<script src="{{ asset('assets/lib/select2/js/select2.full.min.js')}}"  type="text/javascript"></script>
<script src="{{ asset('assets/lib/bootstrap-slider/js/bootstrap-slider.js')}}"  type="text/javascript"></script>

<script src="{{ asset('assets/lib/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/datatables/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<!--<script src="{{ asset('assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/datatables/plugins/buttons/js/buttons.html5.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/datatables/plugins/buttons/js/buttons.flash.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/datatables/plugins/buttons/js/buttons.print.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/datatables/plugins/buttons/js/buttons.colVis.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js')}}" type="text/javascript"></script>-->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.colVis.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.0.2/js/dataTables.rowGroup.min.js"></script>

<script src="{{ asset('assets/lib/jquery.niftymodals/dist/jquery.niftymodals.js')}}" type="text/javascript"></script>

<script src="{{ asset('assets/lib/prettify/prettify.js')}}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>



<script type="text/javascript">
$(document).ready(function () {
    //initialize the javascript
    App.init();
    App.formElements();
    App.dataTables();
    App.loaders();

    //Runs prettify
    prettyPrint();

    $.fn.niftyModal('setDefaults', {
        overlaySelector: '.modal-overlay',
        closeSelector: '.modal-close',
        classAddAfterOpen: 'modal-show',
    });
    testconnection();
    checkTokenStatus();

});
function SignOut() {
    window.location = "{{url('logout')}}";
}

function testconnection() {

    $.ajax({
        url: "{{url('testconnection')}}",
        type: "GET",
        success: function (data) {
            console.log('connection status :' + data);
            if (data == "false") {
                
                $('#internetModal').modal({backdrop: 'static'}, 'show');
            }


        }
    });

}


function checkTokenStatus() {

    $.ajax({
        url: "{{url('validatetoken')}}",
        type: "GET",
        success: function (data) {
            console.log('token status :' + data);
            if (data == "401") {
                
                $('#sessionModal').modal({backdrop: 'static'}, 'show');
            }


        }
    });

}


</script>  