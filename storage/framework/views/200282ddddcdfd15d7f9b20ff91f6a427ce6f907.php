<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PNWHS</title>

        <link href="<?php echo e(asset('public/css/style.default.css')); ?>" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <style>
            .center{
                margin-left: auto;
                margin-right: auto;
                float: none;
            }
        </style>
    </head>

    <body class="signin">
        <section>
            <br>
            <div class="signinpanel">
                <div class="row" style='margin-top: -175px;'>
                    <div class="col-md-8 center">
                        <?php echo $__env->yieldContent('signin'); ?>
                    </div>
                </div>

                <div class="signup-footer center" style="width: 41%;">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center">
                            Developed By <a href="www.alisonstech.com" style="color: #1CAF9A">Alisons Technology</a><br>&copy;<?php echo date('Y') ?>. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="<?php echo e(asset('public/js/jquery-1.11.1.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/js/jquery-migrate-1.2.1.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/js/modernizr.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/js/jquery.sparkline.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/js/jquery.cookies.js')); ?>"></script>
        <script src="<?php echo e(asset('public/js/toggles.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/js/retina.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/js/custom.js')); ?>"></script>
        <script>
            $('#cell').keydown(function(){
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

            jQuery(document).ready(function(){
                // Please do not use the code below
                // This is for demo purposes only
                var c = jQuery.cookie('change-skin');
                if (c && c == 'greyjoy') {
                    jQuery('.btn-success').addClass('btn-orange').removeClass('btn-success');
                } else if(c && c == 'dodgerblue') {
                    jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
                } else if (c && c == 'katniss') {
                    jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
                }
            });
        </script>
    </body>
</html>