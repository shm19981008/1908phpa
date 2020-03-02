@foreach($data as $k=>$v)
			<tr @if($k%2==0) class="active" @else class="success" @endif>
				<td>{{$v->bid}}</td>
				<td>{{$v->bname}}</td>
				<td>@if($v->bimg)<img src="{{env('UPLOAD_URL')}}{{$v->bimg}}" height="80px">@endif</td>
				<td>{{$v->burl}}</td>
				<td>{{$v->bcontent}}</td>
				<td>
					<a href="{{url('brand/edit/'.$v->bid)}}" class="btn btn-info">编辑</a>
					 | 
					<a href="{{url('brand/destroy/'.$v->bid)}}" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach

			<tr>
				<td colspan="5">{{$data->appends(['bname'=>$bname])->links()}}</td>
			</tr>