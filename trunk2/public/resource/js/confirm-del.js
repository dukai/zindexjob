$(function(){
	$('a.delete').click(function(e){
		if(confirm('确定删除？')){
			return true;
		}
		
		return false;
	});
});