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
$total = $db->fetchOne("select count(*) from job_categories");
$companies = $db->fetchAll("select * from job_categories limit {$start},{$take}");
$pager = pager($page, $take, $total, 'job-category-manage.php?page={page}');
?>

<?include "header.php";?>

<div>
<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span10">
			<h1 class="page-header">工作分类管理</h1>
			
			<section>
				<div class="navbar btn-toolbar">
					<div class="navbar-inner">
						<a href="job-category-create.php" class="btn btn-success">新增工作分类</a>
						
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
					<tr><th width="30"><input type="checkbox" /></th><th width="60">#</th><th>名称</th><th width="150">操作</th></tr>
					<?foreach($companies as $key=>$value){?>
					<tr><td><input type="checkbox" /></td><td><?=$value['jc_id']?></td><td><?=$value['name']?></td><td><div class="btn-group"><a href="#" class="btn btn-primary btn-small">修改</a><a href="#" class="btn btn-danger btn-small">删除</a></div></td></tr>
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