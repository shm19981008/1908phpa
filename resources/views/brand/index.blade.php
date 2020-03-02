
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
	<center><h2>品牌列表页面</h2></center><hr/>
	<div class="table-responsive">
		<form action="">
			<input type="text" name="b_name" placeholder="请输入品牌名称" value="{{$b_name}}">
			<input type="submit" value="搜索">
		</form>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>品牌名称</th>
				<th>图片</th>
				<th>网址</th>
				<th>内容</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $k=>$v)
			<tr @if($k%2==0) class="active" @else class="success" @endif>
				<td>{{$v->b_id}}</td>
				<td>{{$v->b_name}}</td>
				<td>@if($v->b_log)<img src="{{env('UPLOAD_URL')}}{{$v->b_log}}" height="80px">@endif</td>
				<td>{{$v->b_url}}</td>
				<td>{{$v->b_desc}}</td>
				<td>
					<a href="{{url('brand/edit/'.$v->b_id)}}" class="btn btn-info">编辑</a>
					 | 
					<a href="{{url('brand/destroy/'.$v->b_id)}}" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach

			<tr>
				<td colspan="5">{{$data->appends(['b_name'=>$b_name])->links()}}</td>
			</tr>
		</tbody>
</table>
<!-- <script>
	$(document).on('click','.pagination a',function(){
		var url=$(this).attr('href');
		if(!url){
			return;
		}
		$.get(url,function(result){
			$('tbody').html(result);
		})

		return false;
	})
</script> -->
</div>  	

</body>
</html>