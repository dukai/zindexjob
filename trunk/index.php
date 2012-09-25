<?
require_once "./includes/common.php";

$db = getDb();
$companies = $db->fetchAll("select * from companies order by company_id desc limit 10");

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>青岛web达人联盟招聘汇总</title>
<style type="text/css">
body,td,th {
	font-family: "微软雅黑", Geneva, sans-serif;
	font-size: 12px;
	line-height:18px;
	color: #5d6871;
	background-color: #f4f6f8;
	margin: 0px;
	text-align:center;
}
.content {width:960px; height:auto; margin:0 auto; text-align:left;}
.head {width:960px; height:88px; line-height:88px; padding-left:20px; font-size:36px; font-weight:bold; color:#8a3c90; border-bottom:1px solid #e5e5e5;}
.words {width:960px; height:60px; padding:16px 0 0 16px;   border-top:1px solid #f9f9f9; border-bottom:1px solid #e5e5e5;}
.jobs {width:960px; height: auto; padding:16px 0 0 16px;   border-top:1px solid #f9f9f9; border-bottom:1px solid #e5e5e5; background:#fff; margin-bottom:8px;}
.h6 {font-size:14px; font-weight:bold; line-height:18px; color:#fd6637;}
.h1 {font-size:18px; font-weight:bold; line-height:18px; color:#0bafc8;}
.h2 {font-size:14px; font-weight:bold; line-height:18px; color:#0bafc8;}
.h3 {font-size:14px; font-weight:bold; line-height:18px; color:#8a3c90;}
</style>

</head>

<body>
<header>青岛Web达人联盟招聘汇总</header>
<section class="content">
<?foreach($companies as $company){?>
<article class="jobs">
	<div class="h1"><?=$company['name']?></div>
	<div>
		<div>公司简介</div>
		<div><?=$company['description']?></div>
		<div>公司地址</div>
		<div><?=$company['address']?></div>
	</div>
	
</article>
<?}?>
</section>
</body>
</html>
