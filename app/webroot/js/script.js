var $tweetBox,$tweetBtn,$strNum;
$(function(){
	$tweetBox=$('#tweetBox');
	$tweetBtn=$('#tweetBtn');
	$strNum=$('#strNum');
	$tweetBox.keydown(function(){
		var strNum = strlen($(this).val());
		$strNum.text(140-strNum);
		if(strNum<=140){
			$tweetBtn.removeAttr('disabled');
			$strNum.removeClass('red');
		}else{
			$tweetBtn.attr('disabled',true);
			$strNum.addClass('red');
		}
	})
});
/*
	以下コピペ
*/
function strlen(str) {
	var ret = 0;
	for (var i = 0; i < str.length; i++,ret++) {
		var upper = str.charCodeAt(i);
		var lower = str.length > (i + 1) ? str.charCodeAt(i + 1) : 0;
		if (isSurrogatePear(upper, lower)) {
			i++;
		}
	}
	return ret;
}
function isSurrogatePear(upper, lower) {
	return 0xD800 <= upper && upper <= 0xDBFF && 0xDC00 <= lower && lower <= 0xDFFF;
}