<?
include "../includes/common.php";
$db = getDb();
if(!empty($_POST)){
	
	$now = date("Y-m-d H:i:s");
	$db->query("insert into companies (name, description, address, map_url, created_time) values ('{$_POST['name']}', '{$_POST['description']}', '{$_POST['address']}', '{$_POST['map_url']}', '{$now}')");
}else{
	$companies = $db->fetchAll("select * from companies");
}
?>

<?include "header.php";?>

<div>
<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span10">
			<h1 class="page-header">创建联系人</h1>
			
			<section>
				<form method="post" class="form-horizontal">
					<legend>联系人信息</legend>
					
					<div class="control-group">
						<label class="control-label" for="username">公司</label>
						<div class="controls">
							<select>
								<?foreach($companies as $key=>$value){?>
								<option value="<?=$value['company_id']?>"><?=$value['name']?></option>
								<?}?>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="username">用户名</label>
						<div class="controls">
							<input type="text" name="username" id="username" placeholder="用户名" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="email">电子邮件</label>
						<div class="controls">
							<textarea name="email" id="email" placeholder="电子邮件" class="span4"></textarea>
						</div>
					</div>
					
					
					
					<div class="control-group">
						<label class="control-label" for="address">地址</label>
						<div class="controls">
							<input type="text" name="address" id="address" placeholder="地址" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="cellphone">移动电话</label>
						<div class="controls">
							<input type="text" name="cellphone" id="cellphone" placeholder="移动电话" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="phone">固定电话</label>
						<div class="controls">
							<input type="text" name="phone" id="phone" placeholder="固定电话" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="qq">QQ</label>
						<div class="controls">
							<input type="text" name="qq" id="qq" placeholder="QQ" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="gtalk">gtalk</label>
						<div class="controls">
							<input type="text" name="gtalk" id="gtalk" placeholder="gtalk" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="msn">MSN</label>
						<div class="controls">
							<input type="text" name="msn" id="msn" placeholder="MSN" />
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