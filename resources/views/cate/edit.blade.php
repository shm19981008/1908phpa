<form action="{{url('/cate/update/'.$res->cate_id)}}" method="post">
	@csrf
	<h3>分类修改页面</h3>
	分类名称:<input type="text" name="cate_name" value="{{$res->cate_name}}"><br>
	父级分类:<select name="pid">
		<option value="">请选择</option>
		@foreach($info as $v)
		<option value="{{$v->cate_id}}" @if($v->cate_id==$res->pid) selected="selected" @endif >{{str_repeat('----',$v['level']*2)}}{{$v->cate_name}}</option>
		@endforeach
	</select><br>
	分类描述:<textarea name="cate_desc">{{$res->desc}}</textarea><br>
	<input type="submit" value="修改">
</form>