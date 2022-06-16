<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PNWHS</title>

        <!-- CSS -->
        <link href="{{ asset('public/css/style.default.css') }}" rel="stylesheet">
        <link href="{{ asset('public/autocomplete/jquery-auto-complete.css') }}" rel="stylesheet">
        <link href="{{asset('public/css/jquery-ui-1.10.3.css')}}" rel="stylesheet">
        <link href="{{asset('public/css/bootstrap-timepicker.min.css')}}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{url('public/css/jquery.datatables.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('public/css/themeroller.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/daterangepicker.css') }}" />

        <!-- Script -->
        <script type="text/javascript" charset="utf8" src="{{url('public/js/jquery-1.7.1.min.js')}}"></script>
        <script type="text/javascript" charset="utf8" src="{{url('public/js/jquery.datatables.min.js')}}"></script>
        <script src="{{asset('public/js/jquery-ui-1.10.3.min.js')}}"></script>
        <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/js/jquery.validate.min.js')}}"></script>
        <script src="{{asset('public/autocomplete/jquery-auto-complete.js')}}"></script>
        <script src="{{asset('public/js/jquery.autogrow-textarea.js')}}"></script>

        <!--Script for calender -->
        <link href="{{asset('public/css/Calender/style.css')}}" rel="stylesheet">
        <script src="{{ asset('public//js/moment-with-locales.min.js') }}"></script>
        <script src="{{asset('public/js/Calender/Script.js')}}"></script>
        <!-- Bootstrap wizard progressbar -->
        <script src="{{asset('')}}/public//js/bootstrap-wizard.min.js"></script>
        <script type="text/javascript" src="{{ asset('public/js/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/daterangepicker.min.js') }}"></script>
    </head>

    <style>
        .error{
            color:red;
        }
        .c{
            background-color: #1caf9a;
            color: white;
        }

        .ui-widget-header{
            border: 0;
            background: 0;
        }
        .ui-state-default, .ui-widget-content .ui-state-default{
            border: 0;
            background: 0;
            color: #636E7B;
        }
        .bootstrap-timepicker-widget table td input{
            width: 100%;
        }
    </style>

    <body>
        <section>
            <?php
                $user_id = Auth::id();
                $user = DB::table('users')->where('id',Auth::id())->first();
            ?>
                @include('admin.adminsidebar')

            <div class="mainpanel">
                @include('admin.header')
                <div class="contentpanel">
                    @yield('content')
                </div>
            </div>

            <div class="rightpanel">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#rp-alluser" data-toggle="tab"><i class="fa fa-users"></i></a></li>
                    <li><a href="#rp-favorites" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#rp-history" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
                    <li><a href="#rp-settings" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
                </ul>
            </div>
        </section>

        <script>
            $('input').on('keyup', function (event) {
              
                var regex = new RegExp("^[a-zA-Z0-9 @._]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                event.preventDefault();
                $(this).val('');
                return false;
                }
            });
        </script>

        <script>
            $('.cnic').keydown(function(){
                //allow  backspace, tab, ctrl+A, escape, carriage return
                if (event.keyCode == 8 || event.keyCode == 9 
                                    || event.keyCode == 27 || event.keyCode == 13 
                                    || (event.keyCode == 65 && event.ctrlKey === true) )
                                        return;
                if((event.keyCode < 48 || event.keyCode > 57 && event.keyCode < 96 || event.keyCode > 105))
                    event.preventDefault();
                    var length = $(this).val().length; 
                            
                if(length == 5 || length == 13)
                    $(this).val($(this).val()+'-');
            });

            $('.mobile').keydown(function(){
                //allow  backspace, tab, ctrl+A, escape, carriage return
                if (event.keyCode == 8 || event.keyCode == 9 
                                || event.keyCode == 27 || event.keyCode == 13 
                                || (event.keyCode == 65 && event.ctrlKey === true) )
                                    return;
                if((event.keyCode < 48 || event.keyCode > 57 && event.keyCode < 96 || event.keyCode > 105))
                    event.preventDefault();
                    var length = $(this).val().length; 
                            
                if(length == 5)
                    $(this).val($(this).val()+'-');
            });

            // Used to format phone number
            $('#phone').keydown(function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length == 7) {
                    number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
                } else if (number.length == 11) {
                    number = number.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
                }
                $(this).val(number)
            });
        </script>
        
        <script src="{{ asset('public/js/jquery-migrate-1.2.1.min.js') }}"></script>
        <script src="{{ asset('public/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('public/js/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('public/js/toggles.min.js') }}"></script>
        <script src="{{ asset('public/js/retina.min.js') }}"></script>
        <script src="{{ asset('public/js/jquery.cookies.js') }}"></script>

        <script src="{{ asset('public/js/morris.min.js') }}"></script>
        <script src="{{ asset('public/js/raphael-2.1.0.min.js') }}"></script>
        <script src="{{ asset('public/js/bootstrap-timepicker.min.js') }}"></script>
        <script src="{{ asset('public/js/custom.js') }}"></script>
    </body>
</html>