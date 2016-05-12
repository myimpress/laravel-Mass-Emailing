jQuery(function($) {
	
	//工具函数
	var utils = {
		type: function(value) {
			return $.type(value);
		},
		isNull: function(value) {
			return  (value !== null && value !== "");
		}
	}
	
	$(".userBasic .list").eq(0).on("click", "li", function(event) {
		event.preventDefault();
		var elements = $(".wrapMain").children();
		var list = $(".userBasic .list li");
		
		$.each(list, function(i, item) {
			elements.eq(i).hide();
			item.className = "";
		});
		list[$(this).index()].className = "selected";
		elements.eq($(this).index()).show();
	});
	
		//添加身份证和名片
	$(document).on("click", ".addID", function() {	
		var elms = $(".list_7 ul").children(),
			sections = $(".iv_box_ > section");

		$.each(elms, function(i, item) {
			elms[i].className = "select";
			sections[i].style.cssText = "display: none;";
		});
		elms[3].className = "selected";
		sections[3].style.cssText = "display: block;";
		//console.log(sections);
	});

	/***表单处理***/
	
	//处理错误信息
	function message(element, text) {
		element.html(text);
	}
	
		//个人个息
	$(document).on("click", ".io_btn", function(event) {
		var school = $(".school").eq(0).val();
		var weixin = $(".io_weixin").eq(0).val();
		var weibo = $(".io_weibo").eq(0).val();
		var maimai = $(".io_maimai").eq(0).val();
		
		//提交个人信息
		if ( utils.isNull(school) ||
			utils.isNull(weixin) ||
			utils.isNull(weibo)  ||
			utils.isNull(maimai) ) {
				
			$.ajax({
				type: "post",
				url: "../../control/doaction.php",
				dataType: "text",
				data: {
					action:"user",
					job:"mod_invoter",
					edu_school: school,	//毕业学校
					weibo: weixin,	//微博
					weixin: weibo,	//微信
					maimai: maimai	//脉脉
				},
				timeout: 1000,
				success: function(data) {
					var obj = eval( "(" + data + ")" ).ret;
					console.log(typeof obj);
					switch(obj) {
						case 0:console.log("修改成功");
							message($(".info .error"), "修改成功");
							break;
						case -1:console.log("简介数据非法，修改失败");
							message($(".info .error"), "简介数据非法，修改失败");
							break;
						case -100: console.log("-10000");
							message($(".info .error"), "-100");
							break;
					}
				}
			});
		}	
	});
	//个人个息-end

/////////////////////////////////////////////////////////////////////////////////////////
    function checkbox(obj,obj2){
    /*选中"至今"是否隐藏显示*/
        $(obj+" input[type='checkbox'][name='ToNow']").on("click", function () {
            if($(this).is(":checked")==true){
                $(obj2).css("display","none");
            }else{
                $(obj2).css("display","block");
            }
        });
    }
    checkbox(".experi",".ex_time2");
    checkbox(".exper_info",".c_time2");
    checkbox(".worker",".d_time2");

    /*"新增投资经历"的显示和隐藏*/
    $(".expen .create_ex img").on("click",function(){
        if($(this).attr("class")!="hid"){
            $(this).parents(".expen").find(".tab").css("display","table");
            $(this).parents(".expen").find(".tab_btn").css("display","table");
            $(this).addClass("hid");
        }else{
            $(this).parents(".expen").children(".tab").css("display","none");
            $(this).parents(".expen").children(".tab_btn").css("display","none");
            $(this).removeClass("hid");
        }
    });

////////////////////////////////////////////////////////////////////////////////////////////////////
    /*头像选择框
    function visit(obj){
        var focus_bol=true;
        $(obj+" .in_name").on("click",function(){
            if(focus_bol){
                $(obj+" .name_content").removeClass("name_block");
                focus_bol=false;
            }else{
                var test=$(obj+" .in_name").val();
                if(test==""){
                    $(obj+" .name_content").addClass("name_block");
                    focus_bol=true;
                }
            }
        });
        $(obj+" .name_content li").on("click",function(){
            var li_name=$(this).find("em").html();
            $(obj+" .in_name").val(li_name);
            $(obj+" .name_content").addClass("name_block");
            focus_bol=true;
        });
    }


    function fnOffset(obj){
        var t = obj.offsetTop;
        var l = obj.offsetLeft;
        var oParent = obj.offsetParent;

        while( oParent ){
            t += oParent.offsetTop;
            l += oParent.offsetLeft;
            oParent = oParent.offsetParent;
        }
        return {'left':l,'top':t};
    }

    function pos(obj,ele){
        $(obj).on("click",function(){
            if($(obj).val()==""){
                var left=fnOffset($(this).get(0)).left-100;
                var top=fnOffset($(this).get(0)).top-50;
                $(ele).find(".in_name").val("");
                $(ele).css({
                    display:"block",
                    left:left,
                    top:top
                });
            }
        });

        $(ele+" .finish").on("click",function(){
            var get_test=$(this).parents(".box_search").find(".in_name").val();
            $(obj).val(get_test);
            $(ele).css("display","none");
        });

        clearInterval(obj.timer);
        obj.timer=setInterval(function(){
            if($(obj).val()!=""){
                $(ele).css("display","none");
                clearInterval(obj.timer);
            }
        },100);
    }

    visit("#chooseBox");
    pos(".ex_co_name","#chooseBox");

    visit("#chooseBox2");
    pos(".co_name","#chooseBox2");

    visit("#chooseBox3");
    pos(".wco_name","#chooseBox3");*/

////////////////////////////////////////////////////////////////////////////////////

	
	
	var count = {
		num: 0,
		num1: 0,
		num2: 0,
		num3: 0
	};
	
	//隐藏表单
	function toggle(btn, element) {
		btn.on("click", function() {
			
			element.toggle();
		});
	}
	
	toggle($(".expri_f #ex_btn_img"), $(".expri_f .tab_clo"));
	toggle($(".exper_info .create_ex p"), $(".exper_info .tab_clo"));
	toggle($(".worked .create_ex p"), $(".worked .tab_clo"));
	
	//投资经历 
	$(document).on("click", ".expri_f .edit_f", function() {	
		var pos = $(this).position();
		$(".expri_f .tab_clo").toggle();
		$(".expri_f .tab_clo").css({
			top: pos.top + 64 + "px",
			position: "absolute",
			zIndex: 1,
		});
		
		if($(".expri_f .tab_clo").attr("id")=="show_")
		{
			log_id=$(this).attr("data-li-f");
			$("#hid_inv_log_id").val(log_id);
			getInvInfo(log_id);
		}
		
	});
	
	$(document).on("click", ".ex_btn", function() {
		$(".expri_f .tab_clo").css({
			position: "static",
		});
		//cleanInvInfo();
	});
	
	$("#ex_btn_img").click(function (){
		$("#ex_hid_job").val("add_invote_log");	
		$("#ex_log_id").val(0);
		
	});
	
	$(document).on("click", ".expri_f .ex_btn", function() {
		$(".expri_f .tab_clo").attr("id", "hide_");
	});
	
	function getInvInfo(log_id)
	{
		$.ajax({
			type: "POST",
		  url: "../control/daemon.php",
			dataType: "text",
			data: { 
				job:'getInvInfo',
				log_id:log_id
			},
			timeout: 1000,
			complete: function(){},
			success: function(data)
			{	
				var obj = eval("("+data+")");
				$("#hid_inv_log_id").val(log_id);				
				$("#ex_co_name").val(obj.co_name); 		//公司名称	
				$("#ex_inv_type").val(obj.inv_type);		//投资类型
				$("#ex_money").val(obj.money);  			//投资金额
				$("#ex_money_type").val(obj.money_type);  //货币类型
				$("#ex_inv_org").val(obj.invorg);			//机构名称
				$("#ex_year").val(obj.b_year);     		//投资时间
				$("#ex_month").val(obj.b_month);
			}
		});		
	}
	
	function cleanInvInfo()
	{
		$("#ex_co_name").val(""); 	//公司名称	
		$("#ex_money").val("");  			//投资金额
		$("#ex_inv_org").val("");			//机构名称
		$("#hid_inv_log_id").val(0);
	}
	
	$(document).on("click", ".ex_close", function() {
		log_id = $(this).attr("data-li-f");
		if(confirm("确认要删除这个投资经历吗?"))
		{
			$.ajax({
				type: "POST",
			  url: "../control/doaction.php",
				dataType: "text",
				data: { 
					action:"user",
					job:"del_invote_log",
					log_id:log_id					
				},
				timeout: 1000,
				complete: function(){},
				success: function(data)
				{	//alert(data);
					$(".inv_log_li_"+log_id).remove();
				}
			});
		}		
	});

$(".ex_btn").click(function(){	
	co_name 	= $("#ex_co_name").val(); 	//公司名称	
	inv_type	= $("#ex_inv_type").val();			//投资类型
	money 		= $("#ex_money").val();  			//投资金额
	money_type=$("#ex_money_type").val();   //货币类型
	inv_class = $("input[name='ex_inv_class'][type='radio']:checked").val();  		//投资主题类型 0个人 1机构
	inv_org 	= $("#ex_inv_org").val();			//机构名称
	inv_date 	= $("#ex_year").val()+"-"+$("#ex_month").val()+"-00";     //投资时间
	log_id = $("#hid_inv_log_id").val();
	
	if(co_name==""){alert("项目名称不能为空"); $("#ex_co_name").focus(); return false;}
	if(money=="" || isNaN(money)){alert("投资金额必须是数字"); $("#ex_money").focus(); return false;}
	
	$.ajax({
				type: "POST",
			  url: "../control/doaction.php",
				dataType: "text",
				data: { 
					action:"user",
					job:"add_invote_log",
					log_id : log_id,
					co_name 	 : co_name, 	  
					inv_type	 : inv_type,	  
					money 		 : money, 		  
					money_type : money_type, 
					inv_class  : inv_class,  
					inv_org 	 : inv_org, 	  
					inv_date 	 : inv_date					
				},
				timeout: 1000,
				complete: function(){},
				success: function(data)
				{	//alert(data);
					var obj = eval( "(" + data + ")" );
					if(obj.ret>0)
						flushInvLog(obj.ret, parseInt(log_id));
					cleanInvInfo();
				}
	});			
});

function flushInvLog(log_id, is_old)
{
	co_name 	= $("#ex_co_name").val(); 	//公司名称	
	inv_type	= $("#ex_inv_type option:selected").text();			//投资类型
	money 		= $("#ex_money").val();  			//投资金额
	money_type= $("#ex_money_type option:selected").text();   //货币类型
	inv_org 	= $("#ex_inv_org").val();			//机构名称
	inv_date 	= $("#ex_year").val()+"-"+$("#ex_month").val();//投资时间
	
	str = "";
	if(!is_old)
		str = "<li class='inv_log_li_"+log_id+"'>";
	str +=  "<p><button class='ex_close' data-li-f="+log_id+"></button><button class='list-f edit_f' data-li-f="+log_id+"></button></p>";
	str +=  "<dl>";
	str +=  "<dt>" + "<em>"+co_name+"</em>" + "</dt>";
	str +=  "<dd>";
	str += 	"<time>"+inv_date+"</time><em>"+inv_type+"</em><em>"+inv_org+"</em><em>"+money+" 万</em><em>"+money_type+"</em>";
	str +=  "</dd>";
	str +=  "</dl>";
	str +=  "<span class='i_table'>";							   
	str +=  "</span>";
	
	if(!is_old)
	{
		str += "</li>";
		$(".expri_f .creat_experi ul").append(str);		
	}
	else
		$(".inv_log_li_"+log_id).html(str);
}

	//投资信息
	$(document).on("click", ".inve_info .ex_io_btn", function() {
		$(".inve_info table").hide();
	});
	
	$(document).on("click", ".inve_info .create_s button", function(){
		$(".inve_info table").show();
	});
	
	//创业经历
	
	$(document).on("click", ".exper_info .list-f", function() {
		
		var btn = $(this);
		var table = $(".exper_info .tab_clo");
		var pos = btn.position();
		
		table.toggle();	
		table.css({
			position: "absolute",
			top: pos.top + 64 + "px",
			zIndex: 1
		});
		
		if(table.css("display") == "block")
		{
			log_id = $(this).attr("data-li-f");
				getCreateInfo(log_id);
		}
		else
			cleanCreateInfo();	
	});
	
	function getCreateInfo(log_id)
	{
		$.ajax({
			type: "POST",
		  url: "../control/daemon.php",
			dataType: "text",
			data: { 
				job:'getCreateInfo',
				log_id:log_id
			},
			timeout: 1000,
			complete: function(){},
			success: function(data)
			{	
				var obj = eval("("+data+")");
				$("#hid_create_log_id").val(log_id);
				$(".create_co_name").val(obj.co_name);
				$(".create_job_pos").val(obj.job_pos);
				$(".create_job_title").val(obj.job_title);
				$(".c_year").val(obj.b_year);
				$(".c_month").val(obj.b_month);
			}
		});	
	}
	
	function cleanCreateInfo()
	{
		$("#hid_create_log_id").val(0);
		$(".create_co_name").val("");
		$(".create_job_pos").val("");
		$(".create_job_title").val("");
		$(".c_year").val("");
		$(".c_month").val("");
	}
	
	$(document).on("click", ".exper_info .ex_io_btn", function() {
		var table = $(".exper_info .tab_clo");
		table.css({
			position: "static"
		});
		$(".exper_info .tab_clo").attr("id", "hide_");
	});
	
	
	$(document).on("click", ".ex_create_close", function() {
		log_id = $(this).attr("data-li-f");
		if(confirm("确认要删除这个创业经历吗?"))
		{
			$.ajax({
				type: "POST",
			  url: "../control/doaction.php",
				dataType: "text",
				data: { 
					action:"user",
					job:"del_create_log",
					log_id:log_id					
				},
				timeout: 1000,
				complete: function(){},
				success: function(data)
				{	//alert(data);
					$(".create_log_li_"+log_id).remove();
				}
			});
		}		
	});

//提交创业经历	
$(".btn_create").click(function(){
	log_id = $("#hid_create_log_id").val(); 
	co_name = $(".create_co_name").val();
	job_pos = $(".create_job_pos").val();
	job_title = $(".create_job_title").val();
	b_year = $(".c_year").val();
	b_month = $(".c_month").val()
	e_year = $(".c_year2").val();
	e_month = $(".c_month2").val();
	
		$.ajax({
				type: "POST",
			  url: "../control/doaction.php",
				dataType: "text",
				data: { 
					action:"user",
					job:"add_create_log",
					log_id:log_id,
					co_name:co_name,
					job_pos:job_pos,
					job_title:job_title,
					b_year:b_year,
					b_month:b_month,
					e_year:e_year,
					e_month:e_month
				},
				timeout: 1000,
				complete: function(){},
				success: function(data)
				{	//alert(data);
					var obj = eval( "(" + data + ")" );
					if(obj.ret>0) flushCreateLog(obj.ret, parseInt(log_id));
					cleanCreateInfo();
				}
	});
});

function flushCreateLog(log_id, is_old)
{
	co_name = $(".create_co_name").val(); $(".create_co_name").val("");
	job_pos = $(".create_job_pos option:selected").text();
	job_title = $(".create_job_title").val(); $(".create_job_title").val("");
	b_date = $(".c_year").val()+"-"+$(".c_month").val();
	
	str ="";
	if(!is_old)
		str = "<li class=\"create_log_li_"+log_id+"\">";
	str += "   <p>";
	str += "   		<button class='ex_create_close' data-li-f='"+log_id+"'></button>";
	str += "   		<button class='list-f edit_f' data-li-f='"+log_id+"'></button>";
	str += "   	</p>";
	str += "   <dl>";
	str += "		<dt><em>"+co_name+"</em></dt>";
	str += "		<dd>";
	str += "			<em>"+job_pos+"</em><em>"+job_title+"</em><em>时间</em><time>"+b_date+"</time>";
	str += "		</dd>";
	str += "   </dl>";
	
	if(!is_old)
	{
		str += "</li>";
		$(".creat_log ul").append(str);
	}
	else
		$(".create_log_li_"+log_id).html(str);
}
	
	$(document).on("click", ".worked .check_now_", function() {
		
		if (!$(this).prop("checked") === true) {
			//console.log($(".worked .d_time2"));
			$(".worked .d_time2").show();
		} else {
			$(".worked .d_time2").hide();
		}
	});
	
	$(document).on("click", ".exper_info .co_name", function() {
		var elm = $(".search_list");
		if (elm.hasClass("ex_hide")) {
			elm.removeClass("ex_hide");
			elm.addClass("ex_show");
		} else {
			elm.removeClass("ex_show");
			elm.addClass("ex_hide");
		}
		$(".search_list")
	});
	
	$(document).on("click", ".inve_info p", function() {
		var elm = $(".iv_box");
	});
	
	//工作经历
	$(document).on("click", ".worked .list-f", function() {
		var _this = $(this);
		var pos = _this.position();
				
		$(".worked .tab_clo").css({
			position: "absolute",
			top: pos.top + 64 + "px",
			zIndex: 1
		});
		
		$(".worked .tab_clo").attr("id", "show_");
		
		if($(".worked .tab_clo").attr("id")=="show_")
		{
			log_id = $(this).attr("data-li-f");
			getWorkInfo(log_id);
		}
		else
			cleanWorkInfo();
	});
	
	function getWorkInfo(log_id)
	{
		$.ajax({
			type: "POST",
		  url: "../control/daemon.php",
			dataType: "text",
			data: { 
				job:'getWorkInfo',
				log_id:log_id
			},
			timeout: 1000,
			complete: function(){},
			success: function(data)
			{	//alert(data);
				var obj = eval("("+data+")");
				
				$(".work_co_name").val(obj.co_name);
				$(".work_profession").val(obj.profession);
				$(".work_job_title").val(obj.job_title);
				$(".d_year").val(obj.b_year);                                     
				$(".d_month").val(obj.b_month);                        
				//$(".d_year2").val(obj.e_year);                          
				//$(".d_month2").val(obj.e_month);
				$("#hid_work_log_id").val(log_id);
			}
		});	
	}
	
	function cleanWorkInfo()
	{
		$(".work_co_name").val("");
		$(".work_job_title").val("");
		$("#hid_work_log_id").val(0);
	}
	
	$(document).on("click", ".worked .finish_work", function() {
		$(".worked .tab_clo").css({
			position: "static"
		});
		$(".worked .tab_clo").attr("id", "hide_");
	});
	
	$(document).on("click", ".ex_work_close", function() {
		log_id = $(this).attr("data-li-f");
		if(confirm("确认要删除这个工作经历吗?"))
		{
			$.ajax({
				type: "POST",
			  url: "../control/doaction.php",
				dataType: "text",
				data: { 
					action:"user",
					job:"del_work_log",
					log_id:log_id					
				},
				timeout: 1000,
				complete: function(){},
				success: function(data)
				{	//alert(data);
					$(".work_log_li_"+log_id).remove();
				}
			});
		}		
	});
	
//提交工作经历
$(".finish_work").click(function(){ 
	log_id = $("#hid_work_log_id").val();
	co_name = $(".work_co_name").val();
	profession = $(".work_profession").val(); 
	job_title = $(".work_job_title").val();
	begin_date = $(".c_year").val()+"-"+$(".c_month").val()+"-00";
	end_date = "0000-00-00";
	
	$.ajax({
				type: "POST",
			  url: "../control/doaction.php",
				dataType: "text",
				data: { 
					action:"user",
					job:"add_work",
					log_id:log_id,
					co_name		:co_name,
					profession:profession,
					job_title	:job_title,
					begin_date: begin_date,
					end_date 	: end_date
				},
				timeout: 1000,
				complete: function(){},
				success: function(data)
				{	
					var obj = eval( "(" + data + ")" );
					if(obj.ret>0) flushWorkLog(obj.ret, parseInt(log_id));
					cleanWorkInfo();
				}
	});
});

function flushWorkLog(log_id, is_old)
{
	co_name = $(".work_co_name").val(); $(".work_co_name").val("");
	profession = $(".work_profession option:selected").text(); 
	job_title = $(".work_job_title").val(); $(".work_job_title").val("");
	begin_date = $(".c_year").val()+"-"+$(".c_month").val();
	
	str = "";
	if(!is_old)
		str = "<li class=\"work_log_li_"+log_id+"\">";
	str += "   <p>";
	str += "   	<button class=\"ex_work_close\" data-li-f='"+log_id+"'></button>";
	str += "   	<button class='list-f edit_f' data-li-f='"+log_id+"'></button>";
	str += "   </p>";
	str += "   <dl>";
	str += "		<dt><em>"+co_name+"</em></dt>";
	str += "		<dd>";
	str += "			<em>"+job_title+"</em><em>"+profession+"</em><em>时间</em><time>"+begin_date+"</time>";
	str += "		</dd>";
	str += "   </dl>";
	str += "   <span class='i_table'>";						   
	str += "   </span>";
	
	if(!is_old)
	{
		str += "</li>";	
		$(".work_experi ul").append(str);
	}
	else
		$(".work_log_li_"+log_id).html(str);
}
	
	//完善投资信息
	$(document).on("click", ".mirr a", function(event) {
		event.preventDefault();
		
		var sections = $(".iv_box_ section");
		var list = $(".list_7 ul li");
		
		$.each(sections, function(i, item) {
			item.style.display = "none";
		});
		console.log(list);
		$.each(list, function(i, item) {
			item.className = "select";
		});
		
		list[3].className = "selected";
		sections.eq(3).show();
		//console.log(list.length);
	});
	
});