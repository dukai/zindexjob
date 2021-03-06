<?
include "../includes/common.php";
$db = getDb();
if(!empty($_POST)){
	
	$now = date("Y-m-d H:i:s");
	$db->query("insert into job_categories (name, description) values ('{$_POST['name']}', '{$_POST['description']}')");
}else{
}
?>

<?include "header.php";?>

<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span10">
			<h1 class="page-header">新增工作分类</h1>
			
			<section>
				<form method="post" class="form-horizontal">
					<legend>工作分类信息</legend>
					
					<div class="control-group">
						<label class="control-label" for="username">名称</label>
						<div class="controls">
							<input type="text" name="name" id="name" placeholder="名称" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="username">描述</label>
						<div class="controls">
							<textarea name="description" id="description" placeholder="描述" class="span6"></textarea>
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