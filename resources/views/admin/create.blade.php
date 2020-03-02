<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('/admin/store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<table>
			<tr>
				<td>用户名</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>手机号</td>
				<td><input type="tel" name="tel"></td>
			</tr>
			<tr>
				<td>邮箱</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td>头像</td>
				<td><input type="file" name="img"></td>
			</tr>
			<tr>
				<td><input type="submit" value="添加"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>