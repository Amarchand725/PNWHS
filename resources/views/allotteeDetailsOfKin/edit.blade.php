@extends('admin.master')
@section('content')
 @include('flash_msgs')


<div class="panel panel-dark">
	<div class="panel-heading">

		<h4 class="panel-title">Registration Form</h4>
	</div>
	<div class="panel-body panel-body-nopadding">

		<!-- BASIC WIZARD -->
		<div id="" class="basic-wizard">
			<ul class="nav nav-pills nav-justified">
				<li id='maintab' <?php if(Request::segment(3) == 'edit'){echo 'class= "active"';} ?>><a href="#ptab1"  data-toggle="tab"><span>Step 1:</span> Particular of the Applicant</a></li>
				<li <?php if(Request::segment(2) == 'create2edit'){echo 'class= "active"';} ?>><a href="#ptab2"  data-toggle="tab"><span>Step 2:</span> Details of Next of Kin/Parents</a></li>
				<li <?php if(Request::segment(2) == 'create3edit'){echo 'class= "active"';} ?>><a href="#ptab3" data-toggle="tab"><span>Step 3:</span>Upload Documents</a></li>

			</ul>
			<div class="tab-content">
				<div class="progress progress-striped active">
					<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div <?php if(Request::segment(3) == 'edit'){echo 'class= "tab-pane fade  in active"';}else{echo 'class="tab-pane fade "';} ?>  id="ptab1">
					@include('allotteeParticular.form1edit')
				</div>
				<div <?php if(Request::segment(2) == 'create2edit'){echo 'class= "tab-pane fade  in active"';}else{echo 'class="tab-pane fade "';} ?> class="tab-pane fade in active" id="ptab2">
					@include('allotteeParticular.form2edit')
				</div>
				<div <?php if(Request::segment(2) == 'create3edit'){echo 'class= "tab-pane fade  in active"';}else{echo 'class="tab-pane fade "';} ?> class="tab-pane fade" id="ptab3">
				@include('allotteeDetailsOfKin.form4edit')
				</div>
				</div><!-- tab-content -->
				</div><!-- #basicWizard -->
				</div><!-- panel-body -->
				</div><!-- panel -->

        {!! Form::close() !!}

			<Script>
				$(document).ready(function() {
          const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
          ];
          var qntYears = 74;
          var selectYear = $("#yeardob");
          var selectMonth = $("#monthdob");
          var selectDay = $("#daydob");
          var currentYear = new Date().getFullYear();

          for (var y = 0; y < qntYears; y++){
            let date = new Date(currentYear);
            var yearElem = document.createElement("option");
            yearElem.value = currentYear
            yearElem.textContent = currentYear;
            selectYear.append(yearElem);
            currentYear--;
          }
          for (var m = 0; m < 12; m++){
              let monthNum = new Date(2018, m).getMonth()
              let month = monthNames[monthNum];
              var monthElem = document.createElement("option");
              monthElem.value = monthNum+1;
              monthElem.textContent = month;
              selectMonth.append(monthElem);
            }
            var d = new Date();
            var month = d.getMonth();
            var year = d.getFullYear();
            var day = d.getDate();
            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);
            AdjustDays();
            selectDay.val(day)
            function AdjustDays(){
              var year = selectYear.val();
              var month = parseInt(selectMonth.val()) + 1;
              selectDay.empty();
              //get the last day, so the number of days in that month
              var days = new Date(year, month, 0).getDate();
              //lets create the days of that month
              for (var d = 1; d <= days; d++){
                var dayElem = document.createElement("option");
                dayElem.value = d;
                dayElem.textContent = d;
                selectDay.append(dayElem);
              }
            }
          var daydob = $("#daydob").val($('#dobdayvalue').val());
          var monthdob = $("#monthdob").val($('#dobmonthvalue').val());
          var yeardob = $("#yeardob").val($('#dobyearvalue').val());
        });

        //doe date picker
        $(document).ready(function() {
          const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
          ];
          
          var qntYears = 74;
          var selectYear = $("#yeardoe");
          var selectMonth = $("#monthdoe");
          var selectDay = $("#daydoe");
          var currentYear = new Date().getFullYear();

          for (var y = 0; y < qntYears; y++){
            let date = new Date(currentYear);
            var yearElem = document.createElement("option");
            yearElem.value = currentYear
            yearElem.textContent = currentYear;
            selectYear.append(yearElem);
            currentYear--;
          }

          for (var m = 0; m < 12; m++){
              let monthNum = new Date(2018, m).getMonth()
              let month = monthNames[monthNum];
              var monthElem = document.createElement("option");
              monthElem.value = monthNum+1;
              monthElem.textContent = month;
              selectMonth.append(monthElem);

            }
            var d = new Date();
            var month = d.getMonth();
            var year = d.getFullYear();
            var day = d.getDate();

            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);

            AdjustDays();
            selectDay.val(day)

            function AdjustDays(){
              var year = selectYear.val();
              var month = parseInt(selectMonth.val()) + 1;
              selectDay.empty();

              //get the last day, so the number of days in that month
              var days = new Date(year, month, 0).getDate();

              //lets create the days of that month
              for (var d = 1; d <= days; d++){
                var dayElem = document.createElement("option");
                dayElem.value = d;
                dayElem.textContent = d;
                selectDay.append(dayElem);
              }
            }
          $("#daydoe").val($('#doedayvalue').val());
          $("#monthdoe").val($('#doemonthvalue').val());
          $("#yeardoe").val($('#doeyearvalue').val());
        });

        //doc date picker
        $(document).ready(function() {
          const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
          ];
          var qntYears = 74;
          var selectYear = $("#yeardoc");
          var selectMonth = $("#monthdoc");
          var selectDay = $("#daydoc");
          var currentYear = new Date().getFullYear();

          for (var y = 0; y < qntYears; y++){
            let date = new Date(currentYear);
            var yearElem = document.createElement("option");
            yearElem.value = currentYear
            yearElem.textContent = currentYear;
            selectYear.append(yearElem);
            currentYear--;
          }

            for (var m = 0; m < 12; m++){
              let monthNum = new Date(2018, m).getMonth()
              let month = monthNames[monthNum];
              var monthElem = document.createElement("option");
              monthElem.value = monthNum+1;
              monthElem.textContent = month;
              selectMonth.append(monthElem);

            }

            var d = new Date();
            var month = d.getMonth();
            var year = d.getFullYear();
            var day = d.getDate();

            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);

            AdjustDays();
            selectDay.val(day)

            function AdjustDays(){
              var year = selectYear.val();
              var month = parseInt(selectMonth.val()) + 1;
              selectDay.empty();

              //get the last day, so the number of days in that month
              var days = new Date(year, month, 0).getDate();

              //lets create the days of that month
              for (var d = 1; d <= days; d++){
                var dayElem = document.createElement("option");
                dayElem.value = d;
                dayElem.textContent = d;
                selectDay.append(dayElem);
              }
            }
            $("#daydoc").val($('#docdayvalue').val());
          $("#monthdoc").val($('#docmonthvalue').val());
          $("#yeardoc").val($('#docyearvalue').val());
        });

        //dop date picker
        $(document).ready(function() {
          const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
          ];
          
          var qntYears = 74;
          var selectYear = $("#yeardop");
          var selectMonth = $("#monthdop");
          var selectDay = $("#daydop");
          var currentYear = new Date().getFullYear();

          for (var y = 0; y < qntYears; y++){
            let date = new Date(currentYear);
            var yearElem = document.createElement("option");
            yearElem.value = currentYear
            yearElem.textContent = currentYear;
            selectYear.append(yearElem);
            currentYear--;
          }

          for (var m = 0; m < 12; m++){
              let monthNum = new Date(2018, m).getMonth()
              let month = monthNames[monthNum];
              var monthElem = document.createElement("option");
              monthElem.value = monthNum+1;
              monthElem.textContent = month;
              selectMonth.append(monthElem);

            }

            var d = new Date();
            var month = d.getMonth();
            var year = d.getFullYear();
            var day = d.getDate();

            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);

            AdjustDays();
            selectDay.val(day)

            function AdjustDays(){
              var year = selectYear.val();
              var month = parseInt(selectMonth.val()) + 1;
              selectDay.empty();

              //get the last day, so the number of days in that month
              var days = new Date(year, month, 0).getDate();

              //lets create the days of that month
              for (var d = 1; d <= days; d++){
                var dayElem = document.createElement("option");
                dayElem.value = d;
                dayElem.textContent = d;
                selectDay.append(dayElem);
              }
            }
            $("#daydop").val($('#dopdayvalue').val());
          $("#monthdop").val($('#dopmonthvalue').val());
          $("#yeardop").val($('#dopyearvalue').val());
        });

        //do SOD date picker
        $(document).ready(function() {
          const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
          ];
          var qntYears = 74;
          var selectYear = $("#yeardosod");
          var selectMonth = $("#monthdosod");
          var selectDay = $("#daydosod");
          var currentYear = new Date().getFullYear();

          for (var y = 0; y < qntYears; y++){
            let date = new Date(currentYear);
            var yearElem = document.createElement("option");
            yearElem.value = currentYear
            yearElem.textContent = currentYear;
            selectYear.append(yearElem);
            currentYear--;
          }

          for (var m = 0; m < 12; m++){
              let monthNum = new Date(2018, m).getMonth()
              let month = monthNames[monthNum];
              var monthElem = document.createElement("option");
              monthElem.value = monthNum+1;
              monthElem.textContent = month;
              selectMonth.append(monthElem);

            }

            var d = new Date();
            var month = d.getMonth();
            var year = d.getFullYear();
            var day = d.getDate();

            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);

            AdjustDays();
            selectDay.val(day)

            function AdjustDays(){
              var year = selectYear.val();
              var month = parseInt(selectMonth.val()) + 1;
              selectDay.empty();

              //get the last day, so the number of days in that month
              var days = new Date(year, month, 0).getDate();

              //lets create the days of that month
              for (var d = 1; d <= days; d++){
                var dayElem = document.createElement("option");
                dayElem.value = d;
                dayElem.textContent = d;
                selectDay.append(dayElem);
              }
            }
            $("#daydosod").val($('#dosoddayvalue').val());
          $("#monthdosod").val($('#dosodmonthvalue').val());
          $("#yeardosod").val($('#dosodyearvalue').val());
        });

        //do SOS date picker
        $(document).ready(function() {
          const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
          ];
          var qntYears = 74;
          var selectYear = $("#yeardosos");
          var selectMonth = $("#monthdosos");
          var selectDay = $("#daydosos");
          var currentYear = new Date().getFullYear();

          for (var y = 0; y < qntYears; y++){
            let date = new Date(currentYear);
            var yearElem = document.createElement("option");
            yearElem.value = currentYear
            yearElem.textContent = currentYear;
            selectYear.append(yearElem);
            currentYear--;
          }

          for (var m = 0; m < 12; m++){
              let monthNum = new Date(2018, m).getMonth()
              let month = monthNames[monthNum];
              var monthElem = document.createElement("option");
              monthElem.value = monthNum+1;
              monthElem.textContent = month;
              selectMonth.append(monthElem);

            }

            var d = new Date();
            var month = d.getMonth();
            var year = d.getFullYear();
            var day = d.getDate();

            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);

            AdjustDays();
            selectDay.val(day)

            function AdjustDays(){
              var year = selectYear.val();
              var month = parseInt(selectMonth.val()) + 1;
              selectDay.empty();

              //get the last day, so the number of days in that month
              var days = new Date(year, month, 0).getDate();

              //lets create the days of that month
              for (var d = 1; d <= days; d++){
                var dayElem = document.createElement("option");
                dayElem.value = d;
                dayElem.textContent = d;
                selectDay.append(dayElem);
              }
            }
            $("#daydosos").val($('#dososdayvalue').val());
          $("#monthdosos").val($('#dososmonthvalue').val());
          $("#yeardosos").val($('#dososyearvalue').val());
        });

        //do SOS date picker
        $(document).ready(function() {
          const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
          ];
          var qntYears = 74;
          var selectYear = $("#yeardos");
          var selectMonth = $("#monthdos");
          var selectDay = $("#daydos");
          var currentYear = new Date().getFullYear();

          for (var y = 0; y < qntYears; y++){
            let date = new Date(currentYear);
            var yearElem = document.createElement("option");
            yearElem.value = currentYear
            yearElem.textContent = currentYear;
            selectYear.append(yearElem);
            currentYear--;
          }

          for (var m = 0; m < 12; m++){
              let monthNum = new Date(2018, m).getMonth()
              let month = monthNames[monthNum];
              var monthElem = document.createElement("option");
              monthElem.value = monthNum+1;
              monthElem.textContent = month;
              selectMonth.append(monthElem);

            }

            var d = new Date();
            var month = d.getMonth();
            var year = d.getFullYear();
            var day = d.getDate();

            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);

            AdjustDays();
            selectDay.val(day)

            function AdjustDays(){
              var year = selectYear.val();
              var month = parseInt(selectMonth.val()) + 1;
              selectDay.empty();

              //get the last day, so the number of days in that month
              var days = new Date(year, month, 0).getDate();

              //lets create the days of that month
              for (var d = 1; d <= days; d++){
                var dayElem = document.createElement("option");
                dayElem.value = d;
                dayElem.textContent = d;
                selectDay.append(dayElem);
              }
            }
            $("#daydos").val($('#dosdayvalue').val());
          $("#monthdos").val($('#dosmonthvalue').val());
          $("#yeardos").val($('#dosyearvalue').val());
        });

				// Progress Wizard
				$('#progressWizard').bootstrapWizard({
				'nextSelector': '.next',
				'previousSelector': '.previous',
				onNext: function(tab, navigation, index) {
				var $total = navigation.find('li').length;
				var $current = index+1;
				var $percent = ($current/$total) * 100;
				jQuery('#progressWizard').find('.progress-bar').css('width', $percent+'%');
				},
				onPrevious: function(tab, navigation, index) {
				var $total = navigation.find('li').length;
				var $current = index+1;
				var $percent = ($current/$total) * 100;
				jQuery('#progressWizard').find('.progress-bar').css('width', $percent+'%');
				},
				onTabShow: function(tab, navigation, index) {
				var $total = navigation.find('li').length;
				var $current = index+1;
				var $percent = ($current/$total) * 100;
				jQuery('#progressWizard').find('.progress-bar').css('width', $percent+'%');
				}
				});
				jQuery('.d_o_b,.d_o_e,.d_o_c,.d_o_p,.d_o_sos,.d_o_sod,.d_o_s').datepicker();
			</Script>

      <script>
        $(document).ready(function(){
          // window.location = "#ptab1";
          window.location.replace("#ptab1");
        });
      </script>

@endsection
