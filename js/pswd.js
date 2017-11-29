function prov(){
	var pswd=document.getElementById('User_password');
	var cpswd=document.getElementById('current_password');
	if(pswd.value==cpswd.value && pswd.value!=''){
		return true;
	}else {
		alert('Пароли не совпадают!');
		return false;
	}
}

function telephone(){
	var tel=document.getElementById('tel').value;
	if(!tel.match(/^\+[\d]{1}\([\d]{3}\)[\d]{3}\-[\d]{2}\-[\d]{2}$/)){
		alert('Введите номер телефона в правильном формате!');
		return false;
	}
	//alert('Номер успешно сохранен');
	return true;
}
