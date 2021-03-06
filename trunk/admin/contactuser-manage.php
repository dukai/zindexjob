<?
include "../includes/common.php";
$db = getDb();
$users = $db->fetchAll("select cu.*, c.name as company_name from contact_users as cu left join company_contactuser_rel as r on cu.uid=r.uid left join companies as c on r.company_id=c.company_id");
?>

<?include "header.php";?>

<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span10">
			<h1 class="page-header">联系人管理</h1>
			
			<section>
				<div class="navbar btn-toolbar">
					<div class="navbar-inner">
						<a href="company-create.php" class="btn btn-success">创建新联系人</a>
						
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
					<tr><th width="30"><input type="checkbox" /></th><th width="60">#</th><th>联系人</th><th>公司</th><th width="150">创建时间</th><th width="150">操作</th></tr>
					<?foreach($users as $key=>$value){?>
					<tr><td><input type="checkbox" /></td><td><?=$value['uid']?></td><td><?=$value['username']?></td><td><?=$value['company_name']?></td><td><?=$value['created_time']?></td><td><div class="btn-group"><a href="#" class="btn btn-primary btn-small">修改</a><a href="#" class="btn btn-danger btn-small">删除</a></div></td></tr>
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