<?
include "../includes/common.php";
require_once '../includes/pager.php';
$db = getDb();
if(isset($_GET['page'])){
	$page = intval($_GET['page']);
}else{
	$page = 1;
}

if($page == 0){
	$page = 1;
}
$take = 30;

$start = $take * ($page - 1);
$total = $db->fetchOne("select count(*) from jobs");
$companies = $db->fetchAll("select j.*, c.name as company_name, jc.name as jc_name from jobs as j left join companies as c on j.company_id=c.company_id left join job_categories as jc on jc.jc_id=j.jc_id limit {$start},{$take}");
$pager = pager($page, $take, $total, 'job-manage.php?page={page}');
?>

<?include "header.php";?>

<div>
<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span10">
			<h1 class="page-header">工作管理管理</h1>
			
			<section>
				<div class="navbar btn-toolbar">
					<div class="navbar-inner">
						<a href="job-create.php" class="btn btn-success">新增工作</a>
						
						<div class="btn-group" >
							<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
								批量操作
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a>删除</a></li>
							</ul>
						</div>
						
					</div>
				</div>
				
				<table class="table table-striped">
					<tr><th width="30"><input type="checkbox" /></th><th width="60">#</th><th>名称</th><th>分类</th><th>公司</th><th width="150">创建时间</th><th width="150">操作</th></tr>
					<?foreach($companies as $key=>$value){?>
					<tr><td><input type="checkbox" /></td><td><?=$value['job_id']?></td><td><?=$value['title']?></td><td><?=$value['jc_name']?></td><td><?=$value['company_name']?></td><td><?=$value['created_time']?></td><td><div class="btn-group"><a href="job-edit.php?job_id=<?=$value['job_id']?>" class="btn btn-primary btn-small">修改</a><a href="job-delete.php?job_id=<?=$value['job_id']?>" class="btn btn-danger btn-small">删除</a></div></td></tr>
					<?}?>
				</table>
				
				<div class="pagination">
					<?=$pager?>
				</div>
			</section>
		</div>
	</div>
</div>

<?include "footer.php";?>