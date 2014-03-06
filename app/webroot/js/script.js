var $signupForm,$dispErr;
function checkVaildate(){
	if($signupForm.validate().checkForm()) {
		$('.submitBtn').removeAttr('disabled').removeClass('disabled');
	} else {
		$('.submitBtn').attr('disabled','true').addClass('disabled');
	}
}
jQuery.validator.addMethod("viewname", function(value, element) {
	return this.optional(element) || /^([^\x01-\x7E]|[a-zA-Z0-9-_])+$/.test(value);
	}, "名前は全角、又は半角英数字(記号は _ と - が使えます)で入力してください。"
);
jQuery.validator.addMethod("alphaNumeric", function(value, element) {
	return this.optional(element) || /^([a-zA-Z0-9]+)$/.test(value);
	}, "半角英数字で入力してください。"
);
$(function(){
	$signupForm = $('#signup').find('form');
	$dispErr = $('.dispErr');
	$signupForm.validate({
		onsubmit: false,
		rules : {
			"data[User][viewname]": {
				required: true,
				rangelength: [4, 20],
				viewname: true,
			},
			"data[User][username]": {
				required: true,
				rangelength: [4, 20],
				alphaNumeric: true,
				remote: {
					type: "post",
					url: webroot+'index/uservalidate/',
					dataType: 'json', //無くても動作するけど環境による？
					data:{
						username: function()
						{
							return $('#username').val();
						}
					},
					complete :function(){
						checkVaildate();
					}
				}
			},
			"data[User][password]": {
				required: true,
				alphaNumeric: true,
				rangelength: [4, 8]
			},
			"data[User][password_cf]": {
				required: true,
				equalTo: "#passwd"
			},
			"data[User][mail]": {
				required: true,
				email: true,
				maxlength: 100
			},
		},
		 messages: {
			"data[User][viewname]": {
				required: "名前を入力してください。<br>",
				rangelength: "名前は4文字以上,20文字以下で入力してください。<br>"
			},
			"data[User][username]": {
				required: "ユーザー名を入力してください。<br>",
				rangelength: "ユーザー名は4文字以上,20文字以下で入力してください。<br>",
				alphaNumeric: "ユーザー名は半角英数字で入力してください。<br>",
				remote: "そのユーザー名はすでに登録されています。<br>"
			},
			"data[User][password]": {
				required: "パスワードを入力してください。<br>",
				alphaNumeric: "パスワードは半角英数字で入力してください。<br>",
				rangelength: "パスワード4文字以上,8文字以下で入力してください。<br>"
			},
			"data[User][password_cf]": {
				required: "",
				equalTo: "パスワードが一致しません。<br>"
			},
			"data[User][mail]": {
				required: "メールアドレスを入力してください。<br>",
				email: "入力したメールアドレスに間違いがあります。<br>",
				maxlength: "メールアドレスは100文字以下で入力してください。<br>"
			},
		},
		errorPlacement: function(error, element) {
			$this = $(".dispErr label[for='"+error.attr('for')+"']");
			if(0==$this.size()){
				$dispErr.append(error);
			}else if(error[0].innerHTML!=$this[0].innerHTML){
				$(".dispErr label[for='"+error.attr('for')+"']").remove();
				$dispErr.append(error);
			}
		},
		success: function (error) {
			$(".dispErr label[for='"+error.attr('for')+"']").remove();
		}
	});
	$signupForm.on('change keyup', function() {
		checkVaildate();
	});
	if($signupForm.validate().checkForm()) {
		$('.submitBtn').removeAttr('disabled').removeClass('disabled');
	} else {
		$('.submitBtn').attr('disabled','true').addClass('disabled');
	}
});