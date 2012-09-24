<?
include "../includes/common.php";
$db = getDb();
$jcId = $_GET['jc_id'];
if(empty($jcId)){
	echo "unknow job category id";
}else{
	$jcId = intval($jcId);
	$db->query("delete from job_categories where jc_id={$jcId}");
	header('Content-Type: text/html; charset=utf-8');
	header('refresh:3;url=job-category-manage.php');
	echo "Delete Successful";
}
