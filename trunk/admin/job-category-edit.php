<?
include "../includes/common.php";
$db = getDb();
$jcId = $_GET['jc_id'];
if(empty($jcId)){
	echo "unknow job category id";
}else{
	$jcId = intval($jcId);
}
if(!empty($_POST)){
	$db->query("update job_categories set name='{$_POST['name']}', description='{$_POST['description']}' where jc_id={$jcId}");
	header('Content-Type: text/html; charset=utf-8');
	header('refresh:3;url=job-category-manage.php');
	echo "Edit Successful";
	exit;
}else{
	$jc = $db->fetchRow("select * from job_categories where jc_id={$jcId}");

}
?>

<?include "header.php";?>

<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span10">
			<h1 class="page-header">编辑工作分类</h1>
			
			<section>
				<form method="post" class="form-horizontal">
					<legend>工作分类信息</legend>
					
					<div class="control-group">
						<label class="control-label" for="username">名称</label>
						<div class="controls">
							<input type="text" name="name" id="name" placeholder="名称" value="<?=$jc['name']?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="username">描述</label>
						<div class="controls">
							<textarea name="description" id="description" placeholder="描述" class="span6"><?=$jc['description']?></textarea>
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