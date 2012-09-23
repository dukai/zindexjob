<?
include "../includes/common.php";
$db = getDb();
$companies = $db->fetchAll("select * from companies");
?>

<?include "header.php";?>

<div>
<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span10">
			<h1 class="page-header">公司管理</h1>
			
			<section>
				<div class="navbar btn-toolbar">
					<div class="navbar-inner">
						<a href="company-create.php" class="btn btn-success">创建新公司</a>
						
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
					<tr><th width="30"><input type="checkbox" /></th><th width="100">#</th><th>公司名称</th><th width="150">创建时间</th><th width="150">操作</th></tr>
					<?foreach($companies as $key=>$value){?>
					<tr><td><input type="checkbox" /></td><td><?=$value['company_id']?></td><td><?=$value['name']?></td><td><?=$value['created_time']?></td><td><div class="btn-group"><a href="#" class="btn btn-primary btn-small">修改</a><a href="#" class="btn btn-danger btn-small">删除</a></div></td></tr>
					<?}?>
				</table>
				
				<div class="pagination">
					<ul>
						<li class="disabled"><a href="#"><i class="icon-step-backward"></i></a></li>
						<li class="disabled"><a href="#"><i class="icon-chevron-left"></i></a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#"><i class="icon-chevron-right"></i></a></li>
						<li><a href="#"><i class="icon-step-forward"></i></a></li>
					</ul>
				</div>
			</section>
		</div>
	</div>
</div>

<?include "footer.php";?>