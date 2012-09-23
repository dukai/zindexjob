<?
include "../includes/common.php";
if(!empty($_POST)){
	$db = getDb();
	$now = date("Y-m-d H:i:s");
	$db->query("insert into companies (name, description, address, map_url, created_time, phone, fax, zipcode) values ('{$_POST['name']}', '{$_POST['description']}', '{$_POST['address']}', '{$_POST['map_url']}', '{$now}', '{$_POST['phone']}', '{$_POST['fax']}', '{$_POST['zipcode']}')");
}
?>

<?include "header.php";?>

<div>
<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span10">
			<h1 class="page-header">创建公司</h1>
			
			<section>
				<form method="post" class="form-horizontal">
					<legend>公司基础信息</legend>
					<div class="control-group">
						<label class="control-label" for="name">公司名</label>
						<div class="controls">
							<input type="text" name="name" id="name" placeholder="公司名" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="description">公司描述</label>
						<div class="controls">
							<textarea name="description" id="description" placeholder="公司描述" class="span4"></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="address">公司地址</label>
						<div class="controls">
							<input type="text" name="address" id="address" placeholder="公司地址" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="phone">联系电话</label>
						<div class="controls">
							<input type="text" name="phone" id="phone" placeholder="联系电话" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="fax">传真</label>
						<div class="controls">
							<input type="text" name="fax" id="fax" placeholder="传真" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="zipcode">邮政编码</label>
						<div class="controls">
							<input type="text" name="zipcode" id="zipcode" placeholder="邮政编码" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="map_url">地图链接</label>
						<div class="controls">
							<input type="text" name="map_url" id="map_url" placeholder="地图链接" />
						</div>
					</div>
					
					<div class="control-group">
						<div class="controls">
							<input type="submit" name="submit" value="提交" class="btn btn-primary" />
						</div>
					</div>
				</form>
			</section>
		</div>
	</div>
</div>

<?include "footer.php";?>