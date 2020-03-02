<table border="1">
	<tr>
		<td>管理员ID</td>
		<td>管理员姓名</td>
		<td>手机号</td>
		<td>邮箱</td>
		<td>头像</td>
		<td>操作</td>
	</tr>
	@foreach ($data as $v)
	<tr>
		<td>{{$v->admin_id}}</td>
		<td>{{$v->username}}</td>
		<td>{{$v->tel}}</td>
		<td>{{$v->email}}</td>
		<td><img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50" height="50"></td>
		<td>
			<a href="{{url('admin/edit/'.$v->admin_id)}}" class="btn btn-info">修改</a>
			<a href="{{url('admin/destroy/'.$v->admin_id)}}" class="btn btn-danger">删除</a>
		</td>
	</tr>
	@endforeach
</table>