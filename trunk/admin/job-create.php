<?
include "../includes/common.php";
$db = getDb();
if(!empty($_POST)){
	
	$now = date("Y-m-d H:i:s");
	$db->query("insert into jobs (title, pay, address, treatment, duty, requirement, person_number, created_time, company_id, jc_id) values ('{$_POST['title']}', '{$_POST['pay']}', '{$_POST['address']}', '{$_POST['treatment']}', '{$_POST['duty']}', '{$_POST['requirement']}', '{$_POST['person_number']}', '{$now}', '{$_POST['company_id']}', '{$_POST['jc_id']}')");
}else{
	$cates = $db->fetchAll("select * from job_categories");
}
?>

<?include "header.php";?>

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
							<input type="text" name="title" id="title" placeholder="工作名称" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="username">所属公司</label>
						<div class="controls">
							<?=Helper::companySelector()?>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="username">工作分类</label>
						<div class="controls">
							<?=Helper::jobCategorySelector()?>
						</div>
					</div>
					
					
					<div class="control-group">
						<label class="control-label" for="address">工作地址</label>
						<div class="controls">
							<input type="text" name="address" id="address" placeholder="工作地址" />
						</div>
					</div>
					
					
					
					<div class="control-group">
						<label class="control-label" for="pay">薪资</label>
						<div class="controls">
							<input type="text" name="pay" id="pay" placeholder="薪资" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="treatment">待遇</label>
						<div class="controls">
							<textarea name="treatment" id="treatment" placeholder="待遇" class="span6" ></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="duty">职责</label>
						<div class="controls">
							<textarea name="duty" id="duty" placeholder="职责" class="span6" ></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="requirement">要求</label>
						<div class="controls">
							<textarea name="requirement" id="requirement" placeholder="要求" class="span6" ></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="person_number">需要人数</label>
						<div class="controls">
							<input type="text" name="person_number" id="person_number" placeholder="需要人数" />
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