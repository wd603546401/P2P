function init_dealform()
{
	//绑定副标题20个字数的限制
	$("input[name='sub_name']").bind("keyup change",function(){
		if($(this).val().length>20)
		{
			$(this).val($(this).val().substr(0,20));
		}		
	});
}

jQuery(function(){
	$('#colorpickerField').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
			if(hex!=""){
				$(el).css({"background":"#"+hex});
			}
			else{
				$(el).css({"background":"#FFFFFF"});
				$(el).val("");
			}
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
			if(this.value!=""){
				$(this).css({"background":"#"+this.value});
			}
			else{
				$(this).css({"background":"#FFFFFF"});
				$(this).val("");
			}
		}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
		if(this.value!=""){
			$(this).css({"background":"#"+this.value});
		}
		else{
			$(this).css({"background":"#FFFFFF"});
			$(this).val("");
		}
	});
	
	$('#colorpickerField').blur(function(){
		
		if($(this).val()!=""){
			$(this).css({"background":"#"+this.value});
		}
		else{
			$(this).css({"background":"#FFFFFF"});
		}
	});
	
	//绑定会员ID检测
	$("input[name='user_id']").bind("blur",function(){
		if(isNaN($(this).val())){
			alert("必须为数字");
			return false;
		}
		if($(this).val().length>0)
		{
			$.ajax({
				url:ROOT+"?"+VAR_MODULE+"="+MODULE_NAME+"&"+VAR_ACTION+"=load_user&id="+$(this).val(), 
				dataType:"json",
				success:function(result){
					if(result.status ==1)
					{
						if(result.user.services_fee)
							$("input[name='services_fee']").val(parseFloat(result.user.services_fee));
						else
							$("input[name='services_fee']").val("5");
						
						var img_html ="";
						$.each(result.user.old_imgdata_str,function(i,v){
							img_html +='<p style="float:left">';
							img_html +='<input style=" margin-top: 12px;"  type="checkbox" name="key[]" value="'+i+'">';
							img_html +='<a href="'+v.img+'" target="_blank" title="'+v.name+'"><img width="35" height="35" style="float:left; border:#ccc solid 1px; margin-left:5px;" id="'+v.name+'" src="'+v.img+'"></a>';
							img_html +="</p>";
						});

						$("#view_user_img_box").html(img_html);
					}
					else{
						alert("会员不存在");
					}
				}
			});
		
			
		}		
	});
	
	$("input[name='deal_status']").live("click",function(){
		$("input[name='is_delete']").attr("checked",false);
		$("#delele_msg_box").hide();
		deal_status_click(this);
	});
	
	$("select[name='agency_id']").change(function(){
		if($(this).val()==0){
			$("select[name='warrant']").val(0);
			$("#guarantor_margin_amt_box").hide();
			$("#guarantor_amt_box").hide();
			$("#guarantor_pro_fit_amt_box").hide();
		}
	});
	
	$("select[name='warrant']").change(function(){
		if($(this).val()!=0){
			$("#guarantor_margin_amt_box").show();
			$("#guarantor_amt_box").show();
			$("#guarantor_pro_fit_amt_box").show();
		}
		else{
			$("#guarantor_margin_amt_box").hide();
			$("#guarantor_amt_box").hide();
			$("#guarantor_pro_fit_amt_box").hide();
		}
	});
	
	$("input[name='is_delete']").click(function(){
		if ($(this).val() == "3") {
			$("input[name='deal_status']").attr("checked",false);
			$("#delele_msg_box").show();
		}
		deal_status_click();
		return true;
	});
	
	$("#citys_box .item .bcity input").click(function(){
		var obj = $(this);
		if(obj.attr("checked") == true ||　obj.attr("checked") == "checked"){
			obj.parent().parent().find(".scity input").attr("checked","checked");
		}
		else{
			obj.parent().parent().find(".scity input").attr("checked","");
		}
	});
});


function deal_status_click(obj){
	$("#start_time_box #start_time").removeClass("require");
	switch($(obj).val()){
		case "1":
			$("#start_time_box").show();
			$("#start_time_box #start_time").addClass("require");
			break;
		default :
			$("#start_time_box").hide();
			break;
	}	
};
