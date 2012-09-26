<?
include "../includes/common.php";
$db = getDb();
$jobId = $_GET['job_id'];
if(empty($jobId)){
	echo "unknow job id";
}else{
	$jcId = intval($jobId);
	$db->query("delete from jobs where job_id={$jobId}");
	header('Content-Type: text/html; charset=utf-8');
	header('refresh:3;url=job-category-manage.php');
	echo "Delete Successful";
}
