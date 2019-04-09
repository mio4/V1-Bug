function sign_in(){
	var data = toJSON();
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST","usr/sign_in",false);
	xmlhttp.send(data);
}
function toJSON(){
	x=$("form").serializeArray();
	return x;
}