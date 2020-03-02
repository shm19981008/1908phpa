<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<center><h3>商品添加</h3></center>

<form class="form-horizontal" role="form" action="{{url('/goods/store')}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="goods_name"
				   placeholder="请输入商品名称">
				   <!-- 显示单个错误信息 -->
			<b style="color:red"></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" name="goods_price"
				   placeholder="请输入价格">
				   <!-- 显示单个错误信息 -->
			<b style="color:red"></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品略缩图</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="lastname" name="goods_img">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" name="goods_num" placeholder="请输入库存">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="radio">
		    <label>
		        <input type="radio" name="is_best" id="optionsRadios1" value="1" checked> 是
		    </label>
		    <label>
		        <input type="radio" name="is_best" id="optionsRadios2" value="2">否
		     </label>  
		</div>    
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否热销</label>
		<div class="radio">
		    <label>
		        <input type="radio" name="is_hot" value="1" checked> 是
		    </label>
		    <label>
		        <input type="radio" name="is_hot" value="2">否
		     </label>  
		</div>    
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
			<textarea name="goods_desc"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="lastname" name="goods_imgs[]" multiple>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌</label>
		<div class="col-sm-10">
			<select name="b_id">
					<option value="">--请选择--</option>
					@foreach($brandInfo as $v)
					<option value="{{$v->b_id}}">{{$v->b_name}}</option>
					@endforeach
				</select>	
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">所属分类</label>
		<div class="col-sm-10">
			<select name="cate_id">
					<option value="">--请选择--</option>
					@foreach($info as $v)
					<option value="{{$v->cate_id}}">{{str_repeat('----|',$v->level)}}{{$v->cate_name}}</option>
					@endforeach
				</select>	
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" id="but" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
<script type="text/javascript">
	//ajax表单令牌
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	//阻止表单提交
	$('#but').click(function(){
		var flag=true;
		$('#firstname').next().html('');
		// alert(123);
		// 商品名称
		var goods_name=$('#firstname').val();
		var reg=/^[\u4e00-\u9fa50-9a-zA-Z_]+$/;
		if(!reg.test(goods_name)){
			$('#firstname').next().html('商品名称由中文、字母、数字、下滑线组成且不能为空');
			return;
		}
		//验证唯一性
		$.ajax({
			type:'post',
			url:"/goods/checkOnly",
			data:{goods_name:goods_name},
			async:false,
			dataType:'json',
			success:function(result){
				// console.log(result);
				if(result.count>0){
					$("#firstname").next().html('商品名称已存在');
					flag=false;
				}
			}
		});
		// alert(atitleflag);
		if(!flag){
			return;
		}
		//验证价格
		var goods_price=$('input[name="goods_price"]').val();
		var reg=/^[0-9]+$/;
		// alert(reg.test(author));
		if(!reg.test(goods_price)){
			$('input[name="goods_price"]').next().html('商品价格必须是数字，且不能为空');
			return;
		}
		// alert('ok');
		//form提交
		$('form').submit();
	});
	//验证价格
	$('input[name="goods_price"]').blur(function(){
		$(this).next().html('');
		var goods_price=$(this).val();
		// console.log(author);
		var reg=/^[0-9]+$/;
		// alert(reg.test(author));
		if(!reg.test(goods_price)){
			$(this).next().html('商品价格必须是数字，且不能为空');
			return;
		}
	});
	//验证商品名称
	$("#firstname").blur(function(){
		//清空错误信息
		$(this).next().html('');
		var goods_name=$(this).val();
		// console.log(atitle);
		var reg=/^[\u4e00-\u9fa50-9a-zA-Z_]+$/;
		// alert(reg.test(atitle));
		if(!reg.test(goods_name)){
			$(this).next().html('商品名称由中文、字母、数字、下滑线组成且不能为空');
			return;
		}
		
		//验证唯一性
		$.ajax({
			type:'post',
			url:"/goods/checkOnly",
			data:{goods_name:goods_name},
			dataType:'json',
			success:function(result){
				// console.log(result);
				if(result.count>0){
					$("#firstname").next().html('商品名称已存在');
				}
			}
		});
	})

</script>
</html>