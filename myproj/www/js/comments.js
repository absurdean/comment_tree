$(document).ready(function(){
	//�������� �� ������������� ���� � �����
	$('#CommentForm .captcha button').click(function(){
		if (document.getElementById("commentUser").value=="" || document.getElementById("commentUser").value=="���"){alert("��������� ���� ���");}
		else if (document.getElementById("commentEmail").value=="" || document.getElementById("commentEmail").value=="E-mail"){alert("��������� ���� E-mail");}
		else if (!validateEmail(document.getElementById("commentEmail").value)){alert("����������� ������ E-mail");}
		else if (document.getElementById("commentMessage").value==""){alert("��������� ���� ���������");}
		else if (document.getElementById("commentCaptcha").value==""){alert("������� ���");}
		else{document.forms.CommentFormSend.submit();}
	});
	
	//��� ����� �� ����������� �������� ����, �������� �����.
	$('#CommentForm .header  div  a').click(function(){
		document.getElementById("CommentForm").style.display="none";
	});
});


//���������� ����� � ������ ����� � ������ �������� ���� CommentParent  ID ������������� �����������
function CommentView_FormView(parent){
	document.getElementById('CommentView_Form'+parent).appendChild(document.getElementById('CommentForm'));
	document.getElementById("CommentForm").style.display="block";
	document.getElementById("CommentParent").value=parent;
}

//������� �������� �������� ���� � ������������� � ������������
function CommentView_TeleportChild(parent,id){
	document.getElementById('CommentView_Child'+parent).appendChild(document.getElementById('CommentView_Parent'+id));
}

//�������� �� ������������ ����� ��������� ������
function validateEmail(email) {
	//�������� ��������� email
	var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	if (!email.match(reg)) {
		return (false);
	}
	return(true);
}
