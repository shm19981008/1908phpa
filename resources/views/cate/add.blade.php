<form action="{{url('/cate/do_add')}}" method="post">
	@csrf
	<h3>分类添加页面</h3>
	分类名称:<input type="text" name="cate_name"><br>
	父级分类:<select name="pid">
		<option value="">请选择</option>
		@foreach($info as $v)
		<option value="{{$v->cate_id}}">{{str_repeat('---',$v['level']*2)}}{{$v->cate_name}}</option>
		@endforeach
	</select><br>
	分类描述:<textarea name="cate_desc"></textarea><br>
	<input type="submit" value="添加">
</form>