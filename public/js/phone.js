/**
 * Created by Administrator on 2015/9/30.
 */


$(function(){
    /** 初始化ajax */
    jQuery.ajaxSetup({
        case:false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click' , '.btn-send' , function(){
        var url = SendPhone;
        $.ajax({
            type:"post",
            url:url,
            dataType:"json",
            data:$('#form_phone').serialize(),
            success:function(obj){
                if(obj.level === "success"){
                    noty({text:obj.message,type:obj.level,timeout:1000});
                }else{
                    noty({text:obj.message,type:obj.level,timeout:1000});
                }
            },
            error:function(obj){
                var datajson = obj.responseJSON;
                noty({text:datajson.message,type:datajson.level,timeout:1000});
            }
        });
    });

})

