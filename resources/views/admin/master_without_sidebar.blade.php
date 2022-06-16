<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PNWHS</title>
  
        <link href="{{ asset('css/style.default.css') }}" rel="stylesheet">
        <link href="{{ asset('autocomplete/jquery-auto-complete.css') }}" rel="stylesheet">
        <link href="{{asset('css/jquery-ui-1.10.3.css')}}" rel="stylesheet">
        <link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{url('css/jquery.dataTables.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/themeroller.css')}}">
        <script type="text/javascript" charset="utf8" src="{{url('js/jquery-1.7.1.min.js')}}"></script>
        <script type="text/javascript" charset="utf8" src="{{url('js/jquery.dataTables.min.js')}}"></script>
        <!-- <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script> -->
        <script src="{{asset('js/jquery-ui-1.10.3.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/jquery.validate.min.js')}}"></script>
        <script src="{{asset('autocomplete/jquery-auto-complete.js')}}"></script>
        <script src="{{asset('js/jquery.autogrow-textarea.js')}}"></script>

        <!--Script for calender -->
        <link href="{{asset('css/Calender/style.css')}}" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
        <script src="{{asset('js/Calender/Script.js')}}"></script>
        <!-- Bootstrap wizard progressbar -->
        <script src="{{asset('')}}/js/bootstrap-wizard.min.js"></script>
        <!--    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
            <div>
             
                <div class="contentpanel">
                    @yield('contentss')
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
            $('input').on('keypress', function (event) {
                var regex = new RegExp("^[a-zA-Z0-9 !@&._-]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                event.preventDefault();
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
                if((event.keyCode < 48 || event.keyCode > 57))
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
                if((event.keyCode < 48 || event.keyCode > 57))
                event.preventDefault();

                var newArray = localNumber.match 
                (/^(92|)?(\d{3})(\d{3})(\d{4})$/); 
            
                // Checking the international code 
                var intlCountryCode=(newArray[1]?'+92':''); 
                
                // Resolving the above array we get 
                // the international number 
                var internationalNumber = intlCountryCode + ' (' 
                        + newArray[2] + ') ' + newArray[3] 
                        + '-' + newArray[4]; 
            });

           // Used to format phone number
            $('#phone').keydown(function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length == 7) {
                    number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
                } else if (number.length == 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
                }
                $(this).val(number)
            });
        </script>
        
        <script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
        <script src="{{ asset('js/modernizr.min.js') }}"></script>
        <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('js/toggles.min.js') }}"></script>
        <script src="{{ asset('js/retina.min.js') }}"></script>
        <script src="{{ asset('js/jquery.cookies.js') }}"></script>

        <script src="{{ asset('js/morris.min.js') }}"></script>
        <script src="{{ asset('js/raphael-2.1.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>