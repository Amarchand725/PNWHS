@php $counter = 0; @endphp

@foreach($models as $model)
    @php $counter++; @endphp
    <tr>
        <td>{{ $counter }}.</td>
        <td>{{ $model->title }}</td>
        <td> {{ $model->description }} </td>
        <td>{{!empty($model->created_at) ? $model->created_at : "-"}}</td>


    </tr>
@endforeach
<tr style="align-content: center">
  <td colspan="12">
      {{ $models->links() }}
  </td>
</tr>
