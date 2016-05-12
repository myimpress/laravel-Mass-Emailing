@extends('common')

@section('content')

            <div class="col-md-6 ">
                <div class="panel panel-default">
                    <div class="panel-heading">发送手机</div>

                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal" role="form"  id="form_phone" method="POST" >
                            {{--<input type="hidden" name="_token"   value="{{ csrf_token() }}">--}}


                            <div class="form-group" style="display: none;">
                                <label for="companyName" class="col-sm-2 control-label">收件人</label>
                                <div class="col-sm-10">
                                    <textarea name="investor_id" class="form-control p_id" id=""  placeholder="请点击收件人"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="companyName" class="col-sm-2 control-label">收件人</label>
                                <div class="col-sm-10">
                                    <textarea  class="form-control p_user" id="e_user"  placeholder="请点击收件人"></textarea><em class="error name_err" ></em>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">正文</label>
                                <div class="col-sm-10">
                                    <textarea  class="form-control" name="text" id="" rows="8" placeholder="请输入收件人邮箱">尊敬的投资人{姓名}，好项目【项目名称】详情：https://github.com/myimpress
</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-default btn-send">发送</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



    <script>
        var doc = $(document);
        //获取 投资人email
        var p_str = "";
        var p_id = "";
        doc.on("click", ".panel-body a", function() {
            p_str += $(this).text() + ";";
            p_id += $(this).attr("data-id") +";";
            $(".p_id").val(p_id.slice(0,-1));
            $(".p_user").val(p_str);
        });
    </script>

    <script>
        var SendPhone = "{{route('Api.sendPhone')}}";
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
                if($('#e_user').val()===""){
                    $('.name_err').html("<p style='color: red'>收件人不能为空</p>");
                    $('.name_err').show();
                    return;
                }


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

            //验证数据不能为空
            function checkUserNull(elm,err){
                if(elm.val() === ""){
                    err.html("<p style='color: red'>收件人不能为空</p>");
                    err.show();
                }
            }

            //验证收件人不能为空
            $(document).on("blur","#e_user",function(){
                checkUserNull($(this),$('.name_err'));
            });
            $(document).on("click","a",function(){
                $('.name_err').hide();
            });
        });
    </script>
    {{--<script src="{{url('js/checkNull.js')}}"></script>--}}
@endsection

