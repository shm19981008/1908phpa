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
<center><h3>商品列表</h3></center>
<table class="table table-striped">
	
	<thead>
		<tr>
			<th>ID</th>
			<th>商品名称</th>
			<th>商品价格</th>
			<th>商品略缩图</th>
			<th>是否精品</th>
			<th>是否热卖</th>
			<th>商品库存</th>
			<th>商品相册</th>
			<th>所属品牌</th>
			<th>所属分类</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($goodsInfo as $k=>$v)
		<tr>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>@if($v->goods_img)<img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="50px" height="50px">@endif</td>
			<td>{{$v->is_best==1?'是':'否'}}</td>
			<td>{{$v->is_hot==1?'是':'否'}}</td>
			<td>{{$v->goods_num}}</td>
			
			<td>
				@foreach($v->goods_imgs as $val)
				@if($val)<img src="{{env('UPLOAD_URL')}}{{$val}}" width="50px" height="50px">@endif
				@endforeach
			</td>
			
			<td>{{$v->b_name}}</td>
			<td>{{$v->cate_name}}</td>
			<td>
				<a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-info">编辑</a>
				<a href="javascript:void(0)" onclick="del('{{$v->goods_id}}')" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
		
	</tbody>
</table>
{{$goodsInfo->links()}}
</body>
<script type="text/javascript">
	function del(id){
		if(!id){
			return;
		}
		if(confirm('是否要删除此条信息')){
			//ajax删除
			$.get('/goods/destroy/'+id,function(result){
				if(result.code=='00000'){
					location.reload();
				}
			},
			'json',
			)
		}
	}
</script>
</html>