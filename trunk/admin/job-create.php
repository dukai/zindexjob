<?
include "../includes/common.php";
$db = getDb();
if(!empty($_POST)){
	
	$now = date("Y-m-d H:i:s");
	$db->query("insert into jobs (title, pay, address, treatment, duty, requirement, person_number, created_time) values ('{$_POST['title']}', '{$_POST['pay']}', '{$_POST['address']}', '{$_POST['treatment']}', '{$_POST['duty']}', '{$_POST['requirement']}', '{$_POST['requirement']}', '{$now}')");
	$jobId = $db->lastId();
	$db->query("insert into job_category_rel (job_id, jc_id) values ({$jobId}, {$_POST['jc_id']})");
	
	$db->query("insert into company_job_rel (company_id, job_id) values ({$_POST['company_id']}, {$jobId})");
}else{
	$companies = $db->fetchAll("select * from companies");
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
						<label class="control-label" for="username">所属公司</label>
						<div class="controls">
							<select id="company_id" name="company_id">
								<?foreach($companies as $key=>$value){?>
								<option value="<?=$value['company_id']?>"><?=$value['name']?></option>
								<?}?>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="username">工作分类</label>
						<div class="controls">
							<select id="jc_id" name="jc_id">
								<?foreach($cates as $key=>$value){?>
								<option value="<?=$value['jc_id']?>"><?=$value['name']?></option>
								<?}?>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="title">工作名称</label>
						<div class="controls">
							<input type="text" name="title" id="title" placeholder="工作名称" />
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