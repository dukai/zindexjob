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
$total = $db->fetchOne("select count(*) from company_scales");
$companies = $db->fetchAll("select * from company_scales limit {$start},{$take}");
$pager = pager($page, $take, $total, 'company-scale-manage.php?page={page}');
?>

<?include "header.php";?>

<div>
<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span10">
			<h1 class="page-header">公司规模管理</h1>
			
			<section>
				<div class="navbar btn-toolbar">
					<div class="navbar-inner">
						<a href="#myModal" class="btn btn-success" data-toggle="modal">创建规模类型</a>
						
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
					<tr><td><input type="checkbox" /></td><td><?=$value['id']?></td><td><?=$value['name']?></td><td><div class="btn-group"><a href="#" class="btn btn-primary btn-small">修改</a><a href="#" class="btn btn-danger btn-small">删除</a></div></td></tr>
					<?}?>
				</table>
				
				<div class="pagination">
					<?=$pager?>
				</div>
			</section>
		</div>
	</div>
</div>
<div class="modal hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">创建公司规模</h3>
  </div>
  <div class="modal-body">
    <div class="control-group">
		<label class="control-label" for="name">名称</label>
		<div class="controls">
			<input type="text" name="name" id="name" placeholder="名称" />
		</div>
	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    <button class="btn btn-primary" data-loading-text="保存中...">保存</button>
  </div>
</div>
<script>
	
</script>
<?include "footer.php";?>