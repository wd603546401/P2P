function account(user_id)
{
	$.weeboxs.open(ROOT+'?m=User&a=account&id='+user_id, {contentType:'ajax',showButton:false,title:LANG['USER_ACCOUNT'],width:600,height:260});
}
function account_detail(user_id)
{
	location.href = ROOT + '?m=User&a=account_detail&id='+user_id;
}
function user_work(user_id)
{
	$.weeboxs.open(ROOT+'?m=User&a=work&id='+user_id, {contentType:'ajax',showButton:false,title:LANG['USER_WORK'],width:600,height:400});
}
function user_passed(user_id)
{
	window.location.href = ROOT+'?m=User&a=passed&id='+user_id;
	/*$.weeboxs.open(ROOT+'?m=User&a=passed&id='+user_id, {contentType:'ajax',showButton:false,title:LANG['USER_PASSED'],width:600,height:400});*/
}
function eidt_lock_money(user_id){
	$.weeboxs.open(ROOT+'?m=User&a=lock_money&id='+user_id, {contentType:'ajax',showButton:false,title:LANG['USER_LOCK_MONEY'],width:600,height:400});
}

function info_down(user_id){
	$.weeboxs.open(ROOT+'?m=User&a=info_down&id='+user_id, {contentType:'ajax',showButton:false,title:"资料",width:600,height:400});
}

function view_info(user_id){
	$.weeboxs.open(ROOT+'?m=User&a=view_info&id='+user_id, {contentType:'ajax',showButton:false,title:"证件预览",width:1000,height:500});
}


function bank_manage(user_id){
	window.location.href=ROOT+'?m=User&a=bank_manage&id='+user_id;
}

function load_manage(user_id){
	window.location.href=ROOT+'?m=Index&a=loads&user_id='+user_id;
}
