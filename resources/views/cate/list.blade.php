
<table border=1>
	<tr>
		<td>id</td>
		<td>分类名称</td>
		
		<td>分类描述</td>
		<td>操作</td>
	</tr>
	@foreach($res as $k=>$v)
	<tr>
		<td>{{$v->cate_id}}</td>
		
		<td>{{str_repeat('---',$v->level)}}{{$v->cate_name}}</td>
		
		<td>{{$v->cate_desc}}</td>
		<td><a href="{{url('/cate/del/'.$v->cate_id)}}">删除</a>
			<a href="{{url('/cate/edit/'.$v->cate_id)}}">修改</a>
		</td>
	</tr>
	@endforeach
</table>
{{$res->links()}}
