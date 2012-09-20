<?include "header.php";?>

<div>
<div class="container-fluid">
	<div class="row-fluid">
		<?include "sidebar.php";?>

		<div class="span8">
			<h1 class="page-header">创建公司</h1>
			
			<section>
				<form>
					<legend>公司基础信息</legend>
					
					<label>公司名</label>
					<input type="text" name="name" id="name" />
					
					<label>公司描述</label>
					<textarea name="description" id="description" ></textarea>
					
					<label>公司地址</label>
					<input type="text" name="name" id="name" />
					
					<label>地图链接</label>
					<input type="text" name="name" id="name" />
				</form>
			</section>
		</div>
	</div>
</div>

<?include "footer.php";?>