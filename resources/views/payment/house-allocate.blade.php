@extends('admin.master')
@section('content')
  @include('flash_msgs')

  <div class="panel panel-dark">
    <div class="panel-heading">
      <h4 class="panel-title">Allocate House</h4>
    </div>
    <div class="panel-body">
      <form action="{{ url('allocated_house') }}" method='POST'>
        {{ csrf_field() }}
        <input type="hidden" name='p_no' id='p-no' value='{{ $p_no }}'>
        <!-- <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-3">
                  <label class='control-label' for='allot-house'>Allot House</label>
                </div>
                <input name="profit" class='profit' data-houses='{{ $houses }}' id='allot-house' checked type="radio" value="Allot House">
              </div>

              <div class="row">
                <div class="col-sm-3">
                  <label class='control-label' for='get-profit'>Get Profit</label>
                </div>
                <input name="profit" class='profit' id='get-profit' type="radio" value="Get Profit">
              </div>
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group houses">
              {!! Form::label("allocated_house", "Houses:", ["class" => "control-label house-id"]) !!}

              <select name="allocated_house" id="allocated_house" class='form-control'>
                <option value="">Select house</option>
                @foreach($houses as $house)
                  <option value="{{ $house->id }}">{{ $house->plot_no }}</option>
                @endforeach
              </select>
              <span style='color:red' id='house-error'></span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group account-of">
              {!! Form::label("account_of", "Account of:", ["class" => "control-label"]) !!}
              <select name='allocated_account_of' class='form-control allocated-account-of'>
                <option selected disabled>Select House Allocate account of</option>
                <option value='House Percent'>House Percent</option>
                <option value='Shaheed'>Shaheed</option>
                <option value='Medical'>Medical</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="house-details"></div>
        </div>
        <div class="row">
          <div class="col-sm-6 dues-install"></div>
        </div>
        <br />
        <div class='row'>
          <div class="col-sm-6">
            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    $('#allocated_house').on('change', function(){
      $('#house-error').html('');
    });
    $(document).on('change', '.profit', function(){
      var profit_val = $(this).val();
      if(profit_val=='Allot House'){
        $('.house-details').html('');
        var houses = $(this).data('houses');
        var html = '';
        html = '<label class="control-label">Houses:</label>'+
                '<select class="form-control" id="allocated_house" name="allocated_house">'+
                  '<option value="" selected>Select house</option>';
                    $.each(houses, function( index, value ) {
                      html += '<option value="'+value.id+'">'+value.plot_no+'</option>';
                    });
        html+= '</select>'+
                '<span style="color:red" id="house-error"></span>';
        $('.houses').html(html);

        html = "<label class='control-label'>Account of:</label>"+
                "<select name='allocated_account_of' class='form-control allocated-account-of'>"+
                  "<option selected disabled>Select House Allocate account of</option>"+
                  "<option value='House Percent'>House Percent</option>"+
                  "<option value='Shaheed'>Shaheed</option>"+
                  "<option value='Medical'>Medical</option>"+
                "</select>";
        $('.account-of').html(html);
      }else{
        $('.houses').html('');
        $('.account-of').html('');
        $('.house-dues-install').html('');
        $('.dues-install').html('');
        $('.house-details').html('');

        var p_no = $('#p-no').val();

        $.ajax({
          type: "POST",
          url: "{{ url('get_profit') }}",
          data: {_token: "{{ csrf_token() }}", p_no:p_no },
          success: function( response ) {
            var profit_amount = response.paid_amount*response.profit.rate/100;
            var total_amount = Number(profit_amount)+Number(response.paid_amount);
            var html = '';
            html += '<table class="table">'+
                      '<tr>'+
                        '<th>'+
                          'Profit Rate (%)'+
                        '</th>'+
                        '<th>'+
                          'Member Paid Amount (PKR)'+
                        '</th>'+
                        '<th>'+
                          'Profit Amount (PKR)'+
                        '</th>'+
                        '<th>'+
                          'Total Amount (PKR)'+
                        '</th>'+
                      '</tr>'+
                      '<tr>'+
                        '<th>' + response.profit.rate + '%</th>'+
                        '<th>' + addCommas(response.paid_amount) + '</th>'+
                        '<th>' + addCommas(profit_amount) + '</th>'+
                        '<th>' + addCommas(total_amount) + '</th>'+
                      '</tr>'+
                    '</table>';
            $('.house-details').html(html);
          }
        });
      }
    });

    $(document).on('change', '.allocated-account-of', function(){
      var allocated_account_of = $(this).val();
      var house_id = $('#allocated_house').val();
      var p_no = $('#p-no').val();
      if(house_id==''){
        $('#house-error').html('Select House first');
        return false;
      }else{
        $('#house-error').html('');
      }
      $.ajax({
        type: "POST",
        url: "{{ url('get_house_details') }}",
        data: {_token: "{{ csrf_token() }}", house_id:house_id, allocate:allocated_account_of, p_no:p_no },
        success: function( response ) {
          var html = '';
          if(response.allocated_on_acc_of=='House Percent'){
            var dues_amount = response.house_amount-response.paid_amount;
            html += '<table class="table">'+
                      '<tr>'+
                        '<th>'+
                          'House Price (PKR)'+
                        '</th>'+
                        '<th>'+
                          'Member Paid Amount (PKR)'+
                        '</th>'+
                        '<th>'+
                          'Dues (PKR)'+
                        '</th>'+
                      '</tr>'+
                      '<tr>'+
                        '<th>' + addCommas(response.house_amount) + '</th>'+
                        '<th>' + addCommas(response.paid_amount) + '</th>'+
                        '<th>' + addCommas(dues_amount) + '</th>'+
                      '</tr>'+
                    '</table>';
            $('.house-details').html(html);

            html =  '<div class="form-group">'+
                      '<label class="control-label">House Dues Instalment</label>'+
                      '<input type="number" name="house_dues_instalment" class="form-control" min="0" placeholder="Enter House Dues Instalment">'+
                    '</div>';
            $('.dues-install').html(html);
          }
          else if(response.allocated_on_acc_of=='Shaheed' || response.allocated_on_acc_of=='Medical'){
            html += '<table class="table">'+
                      '<tr>'+
                        '<th> Member Paid Amount: ' + addCommas(response.paid_amount) + '</th>'+
                      '</tr>'+
                    '</table>';
            $('.house-details').html(html);
            $('.house-dues-install').html('');
            $('.dues-install').html('');
          }
        }
      });
    });

    function addCommas(nStr){
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }
  </script>

@endsection