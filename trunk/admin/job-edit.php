<?
include "../includes/common.php";
$db = getDb();
$jobId = $_GET['job_id'];
if(empty($jobId)){
	echo "unknow job id";
	exit;
}else{
	$jobId = intval($jobId);
	$job = $db->fetchRow("select * from jobs where job_id={$jobId}");
}

if(!empty($_POST)){
	
	$db->query("update jobs set title='{$_POST['title']}', pay='{$_POST['pay']}', address='{$_POST['address']}', treatment='{$_POST['treatment']}', duty='{$_POST['duty']}', requirement='{$_POST['requirement']}', person_number='{$_POST['person_number']}', company_id='{$_POST['company_id']}', jc_id='{$_POST['jc_id']}' where job_id={$jobId}");
}else{
	$cates = $db->fetchAll("select * from job_categories");
}
?>

<?include "header.php";?>

<div>
<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span10">
			<h1 class="page-header">新增工作职位</h1>
			
			<section>
				<form method="post" class="form-horizontal">
					<legend>工作职位信息</legend>
					<div class="control-group">
						<label class="control-label" for="title">工作名称</label>
						<div class="controls">
							<input type="text" name="title" id="title" placeholder="工作名称" value="<?=$job['title']?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="username">所属公司</label>
						<div class="controls">
							<?=Helper::companySelector($job['company_id'])?>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="username">工作分类</label>
						<div class="controls">
							<?=Helper::jobCategorySelector($job['jc_id'])?>
						</div>
					</div>
					
					
					<div class="control-group">
						<label class="control-label" for="address">工作地址</label>
						<div class="controls">
							<input type="text" name="address" id="address" placeholder="工作地址"  value="<?=$job['address']?>" />
						</div>
					</div>
					
					
					
					<div class="control-group">
						<label class="control-label" for="pay">薪资</label>
						<div class="controls">
							<input type="text" name="pay" id="pay" placeholder="薪资" value="<?=$job['pay']?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="treatment">待遇</label>
						<div class="controls">
							<textarea name="treatment" id="treatment" placeholder="待遇" class="span6" ><?=$job['treatment']?></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="duty">职责</label>
						<div class="controls">
							<textarea name="duty" id="duty" placeholder="职责" class="span6" ><?=$job['duty']?></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="requirement">要求</label>
						<div class="controls">
							<textarea name="requirement" id="requirement" placeholder="要求" class="span6" ><?=$job['requirement']?></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="person_number">需要人数</label>
						<div class="controls">
							<input type="text" name="person_number" id="person_number" placeholder="需要人数" value="<?=$job['person_number']?>" />
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