    
@extends('layouts.login')

@section('content')

<div class="splash-container">
    <div class="panel panel-default panel-border-color panel-border-color-primary">
        <div class="panel-heading">
<!--            <img src="assets/img/logo-xx.png" alt="logo" width="102" height="27" class="logo-img">
            ction="{{url('authenticateuser')}}"
            -->
            <span class="splash-description">Please enter your user information.</span></div>
        <div class="panel-body">
          
            <div style="display: none" id='divresponse' role="alert" class="alert alert-danger alert-dismissible">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true" class="mdi mdi-close"></span>
                </button><span class="icon mdi mdi-close-circle-o"></span>
                <span id='response'></span>
            </div>
            <form id="loginForm" >

                {{ csrf_field() }}

                <div class="form-group">
                    <input  type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" required>
                </div>
                <div class="form-group">
                    <input id="password" type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <div class="form-group row login-tools">
                    <div class="col-xs-6 login-remember">
                        <div class="be-checkbox">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-xs-6 login-forgot-password"><a href="#">Forgot Password?</a></div>
                </div>
                <div class="form-group login-submit">
                    <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Sign me in</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('customjs')
<script type="text/javascript">
    $(document).ready(function(){
        testconnection();
    });

    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        console.log(formData);

        $('input:submit').attr("disabled", true);

        $.ajax({
            url: "{{url('authenticateuser')}}",
            type: "POST",
            data: formData,
            success: function (data) {
                console.log('data : '+data);
                if (data == "success") {
                    window.location = "dashboard";
                } else {
                    $('#divresponse').show();
                    $('#response').html(data);
                }

            },
            error: function (jXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });



    });
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

</script>

@endsection