
@extends('admin.master')
@section('content')
@include('block._search')

<br>
<div class="panel panel-dark">
  <div class="panel-heading">
     @if(Auth::user()->user_type != 3) 
    <a href="{{ route('Block.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create Block</a>
    @endif
    <h4 class="panel-title">Block</h4>
  </div>
  <div class="panel-body">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <th><b>#</b></th>
          <th><b>Name</b></th>
          <th><b>Description</b></th>
          <th><b>Status</b></th>
          <th><b>Action</b></th>
        </thead>
        @if(!empty($models))
          <tbody class='ajax_content'>
            <?php $counter = 1; ?>
            @foreach($models as $model)
              <tr>
                <?php
                  $created_by = DB::table('users')->where('id', $model->created_by)->first();
                ?>
                <td>{{$counter++}}.</td>
                <td>{{$model->name??'--'}}</td>
                <td>{{$model->description??'--'}}</td>
                <td>
                  @if($model->status==1)
                    <span class='label label-success'><i class='fa fa-check'></i> Active</span>
                  @else
                    <span class='label label-danger'><i class='fa fa-times'></i> In-Active</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('Block.edit', $model->id) }}" data-toggle="tooltip"  title="Edit" class="btn btn-primary btn-sm"> 
                    <i class='fa fa-edit'></i>
                  </a>
                  <button class='btn btn-danger btn-sm delete' data-block-id='{{ $model->id }}' type='button'><i class='fa fa-trash-o'></i></button>
                </td> 
              </tr>
            @endforeach
            <tr style="align-content: center">
              <td colspan="12">
                {{ $models->links() }}
              </td>
            </tr>
          </tbody>
        @endif
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  $(document).on('click', '.delete', function(){
    var block_id = $(this).attr('data-block-id');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "GET",
          url: "{{ url('block_delete') }}/"+block_id,
          cache: false,
          success: function(response) {
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          },
          failure: function (response) {
            swal(
              "Internal Error",
              "Oops, couldn't delete.", // had a missing comma
              "error"
            )
          }
        })

        $(this).closest("tr").remove();
      }
    })
  });
</script>
@endsection