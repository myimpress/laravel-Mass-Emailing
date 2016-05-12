@extends('common')

@section('content')
    <div class="col-md-6 ">
        <div class="panel panel-default">
            <div class="panel-heading">投资人信息编辑</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="form-investor" action="{{ route('Api.investor',['id=>0']) }}" method="POST">
                    {{--<input type="hidden" name="_token"   value="{{ csrf_token() }}">--}}

                    <div class="form-group" style="display: none">
                        <label for="c_id" class="col-sm-2 control-label">id</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control c_id"  name="c_id" placeholder="请输入公司名称" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="companyName" class="col-sm-2 control-label">公司</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control company" id="" name="company" placeholder="请输入公司名称" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label" >姓名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control name" id="" name="name" placeholder="请输入投资人姓名" ><em class="error name_err" ></em>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label" >职位</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control title" id="" name="title" placeholder="请输入投资人职位" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control email" id="" name="email" placeholder="请输入投资人邮箱" ><em class="error email_err" ></em>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">手机</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mobile" id="" name="mobile" placeholder="请输入投资人手机" ><em class="error phone_err" ></em>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telephone" class="col-sm-2 control-label">座机</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control telephone" name="telephone" placeholder="请输入投资人座机" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="past_case" class="col-sm-2 control-label">投资项目</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control past_case" name="past_case" placeholder="请输入投资项目" >
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">是否领头人</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control status" name="status" placeholder="是否领头人" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="flag" class="col-sm-2 control-label">是否认证</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control flag" name="flag" placeholder="是否认证" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="wechat" class="col-sm-2 control-label">微信</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control wechat" name="wechat" placeholder="请输入微信" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="addr" class="col-sm-2 control-label">地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control addr" name="addr" placeholder="请输入地址" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="referrer" class="col-sm-2 control-label">推荐人</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control referrer" name="referrer" placeholder="请输入推荐人" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field" class="col-sm-2 control-label">投资领域</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control field" name="field" placeholder="请输入投资领域" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type" class="col-sm-2 control-label">投资行业</label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                                @foreach(\App\Types::all() as $type)
                                    <label for="{{$type->id}}">
                                        <em style="margin-right:30px;font-style: normal;"><input type="checkbox" name="type[]" value="{{$type->id}}" id="{{$type->id}}" style="position:static; " >{{$type->type_name}}</em>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kpi" class="col-sm-2 control-label">KPI</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control kpi" name="kpi" placeholder="请输入kpi" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-10">
                            <button type="button" class="btn btn-primary btn-send">录入</button><em class="error btn_err" ></em>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--表单验证--}}

    <script>
        jQuery(function(){
            var doc = $(document);
            //验证名字不为空
            doc.on("blur",".name",function(){
                if($(this).val() === ""){
                    $(".name_err").html("<p style ='color:#ff0e00'>投资人姓名不能为空</p>");
                    $(".name_err").show();
                }
            });
            doc.on("focus",".name",function(){
                $(".name_err").hide();
            });


            var account = {
                email:false
            };


            //验证邮箱
            function checkEmail(elm, err) {
                var reg = /([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})/;
                if (elm.val() === "") {
                    err.html("<p style ='color:#ff0e00'>投资人邮箱不能为空</p>");
                    err.show();
                    account.email = false;
                    return;
                }

                if (!reg.test(elm.val())) {
                    err.html("<p style ='color:#ff0e00'>请输入正确的邮箱</p>");
                    err.show();
                    account.email = false;
                    return;
                }
                account.email = true;
            }

            //验证邮箱不为空
            doc.on("blur",".email",function(){
                checkEmail($(this), $(".email_err"));
            });
            doc.on("focus",".email",function(){
                $(".email_err").hide();
            });

            //验证电话不为空
            doc.on("blur",".mobile",function(){
                if($(this).val() === ""){
                    $(".phone_err").html("<p style ='color:#ff0e00'>投资人电话名不能为空</p>");
                    $(".phone_err").show();
                }
            });
            doc.on("focus",".mobile",function(){
                $(".phone_err").hide();
            });



        });
    </script>

    <script>
        /*提交表单*/
        var inputInvestor = "{{route('Api.investor',['id'=>0])}}";
        $(function(){
            /** 初始化ajax */
            jQuery.ajaxSetup({
                case:false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).on("blur",".btn-send",function(){
                $(".btn_err").hide();
            });
            $(document).on('click' , '.btn-send' , function(){
                var name = $('.name').val();
                var email = $('.email').val();
                var mobile = $('.mobile').val();
                if(name=="" || email=="" || mobile==""){
                    $(".btn_err").html("<p style ='color:#ff0e00'>姓名,邮箱,手机都不能为空</p>");
                    $(".btn_err").show();
                    return;
                }


                var url = inputInvestor;
                $.ajax({
                    type:"post",
                    url:url,
                    dataType:"json",
                    data:$('#form-investor').serialize(),
                    success:function(obj){
                        if(obj.level === "success"){
                            noty({text:obj.message,type:obj.level,timeout:200});
                        }else{
                            noty({text:obj.message,type:obj.level,timeout:200});
                        }
                    },
                    error:function(obj){
                        var datajson = obj.responseJSON;
                        noty({text:datajson.message,type:datajson.level,timeout:1000});
                    }
                });
            });
        })

    </script>

    <script>
        /*提取投资人信息编辑*/
        jQuery(function() {
            var id = '';
            $(document).on('click', 'a', function () {
                id = $(this).attr("data-id");
            var investorId = "{{route('Api.editInvestor')}}";
            $.ajax({
                type: "get",
                url: investorId,
                dataType: "json",
                data: {
                    "id": id
                },
                success: function (tt) {
                    $('.c_id').val(tt.id);
                    $('.company').val(tt.company);
                    $('.name').val(tt.name);
                    $('.title').val(tt.title);
                    $('.email').val(tt.email);
                    $('.mobile').val(tt.mobile);
                    $('.telephone').val(tt.telephone);
                    $('.past_cast').val(tt.past_cast);
                    $('.status').val(tt.status);
                    $('.flag').val(tt.flag);
                    $('.wechat').val(tt.wechat);
                    $('.addr').val(tt.addr);
                    $('.referrer').val(tt.referrer);
                    $('.field').val(tt.field);
                    $('.kpi').val(tt.kpi);

//                    console.log(tt.name);
                }
            });
        });
    });
    </script>

@endsection
