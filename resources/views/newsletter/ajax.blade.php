@foreach($models as $model)
					@php $counter++; @endphp
					<tr>
						<td>{{ $counter }}.</td>
						<td>{{ $model->title }}</td>
                        <td> {{ $model->subject }} </td>

                        <?php $expiryddate =  date('d-M-Y',strtotime($model->expiry_date)) ?>
                        <td>{{!empty($model->expiry_date) ? $expiryddate : "-"}}</td>
                        <td>
                            <a href="{{ route('Newsletter.show', $model->id) }}" title="Show" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            <?php if($usertype != 'user'){
                                ?>
                            <a href="{!! url('/Newsletter/destroy'.'/'. $model->id); !!}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                            <?php } ?>
						</td>
					</tr>
                @endforeach
                <tr style="align-content: center">
                    <td colspan="12">
                        {{ $models->links() }}
                    </td>
                  </tr>
