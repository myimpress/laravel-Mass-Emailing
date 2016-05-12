@extends('app')

@section('content')

    <div class="col-md-4 ">
        <div style="margin-bottom:10px; padding-bottom:5px; border-bottom:1px solid #999;">
            <form method="post" id="addGroup" action="{{route('Api.group')}}">
            <input type="text" name="invest_group" class="group_name" placeholder="新分组名"><button type="button" class="btn btn-primary new_group" >添加新分组</button><em class="error name_err" ></em>
            </form>
            总分组： {{ count(\App\Groups::all()) }}
        </div>
        <div id="tabs" class="tabbable tabs-left rounded" style="background-color:white;padding:10px;">
            {{--<form method="post" id="update" action="{{route('Api.group.update')}}">--}}
                @foreach(\App\Groups::all() as $group)
                <div class="nav nav-tabs" >
                    <p href="#error-menu{{ $group->id }}" data-gid="{{$group->id}}" class="nav-header collapsed btn btn-primary" data-toggle="collapse" style="display:block"><i class="icon-exclamation-sign"></i>{{ $group->invest_group }}<i class="icon-chevron-up"></i></p>
                        <ul id="error-menu{{ $group->id }}" class="nav nav-list collapse">
                            @foreach(\App\Groups::find($group->id)->invest_x_groups()->get() as $invest)
                                <li ><a href="#" data="{{$group->id}}" data-id="{{ $invest->id }}">{{ $invest->name }}<span class="delete">×</span></a></li>
                            @endforeach
                        </ul>
                    <div class="but_but" style="display: none;">
                        <button type="button" class="btn btn-success add" >添加人员</button>
                        <input type="text" name="text" class="name" placeholder="请输入新分组名"><button type="button" class="btn btn-info amend" >保存分组名</button><em class="error u_name_err" ></em>
                    </div>
                </div>
                @endforeach
            {{--</form>--}}
        </div>
    </div>


    <div class="col-md-3 add_invest " style="display: none;">
        <div class="panel panel-default">
            <div class="panel-heading">投资人</div>
            <div class="panel-body role0" style="overflow:auto; height: 600px">
                @foreach(\App\Investor::where('role' , '!=' ,'1')->get() as $invest)
                    <label style="display:block">
                        <ul >
                            <li ><a href="#" data-id="{{ $invest->id }}">{{ $invest->name }} - {{$invest->email}}</a></li>
                        </ul>
                    </label>
                @endforeach
            </div>
        </div>
    </div>


    {{--user = 1--}}
    <div class="col-md-3 add_invest " style="display: none;">
        <div class="panel panel-default">
            <div class="panel-heading">投资人</div>
            <div class="panel-body role1" style="overflow:auto; height: 600px">
{{--                @if(\App\User::whereId(Auth::user()->id)->first()->email =='592560885@qq.com')--}}
                    @foreach(\App\Investor::whereRole('1')->get() as $in)
                        <label style="display:block">
                            <ul >
                                <li ><a href="#" data-id="{{ $in->id }}">{{ $in->name }}</a></li>
                            </ul>
                        </label>
                    @endforeach
                {{--@endif--}}
            </div>
        </div>
    </div>
    <div class="all">
        <input type="checkbox">全选
    </div>


    <script>
        var addGroup = "{{route('Api.group' , ['id'=>0])}}";
        var groupGroup = "{{route('Api.groupGroup',['id'=>0])}}";
        var delGroup = "{{route('Api.delGroup',['id'=>0])}}";
        var updateAllGroup = "{{ route('Api.updateAllGroup') }}";

        jQuery(function(){
            jQuery.ajaxSetup({
                case:false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            //按钮显示
            $(document).on("click", ".nav-header", function() {
                $(this).parent().find(".but_but").toggle();
            });

            //添加分组功能

            $(document).on('blur','.new_group',function(){
                $('.name_err').hide();
            });
            $(document).on('click' , '.new_group' , function(){
                if($(this).prev().val()===""){
                    $('.name_err').html("<p style ='color:#ff0e00'>新组名不能为空</p>");
                    $('.name_err').show();
                    return;
                }
                var url = addGroup;
                $.ajax({
                    type:"post",
                    url:url,
                    dataType:"json",
                    data:$('#addGroup').serialize(),
                    success:function(obj){
                        window.location.reload();
                        if(obj.level === "success"){
                            noty({text:obj.message,type:obj.level,timeout:1000});
                        }
                    },
                    error:function(obj){
                        var datajson = obj.responseJSON;
                        noty({text:datajson.message,type:datajson.level,timeout:1000});
                    }
                });
            });

            //更改组名
            $(document).on('blur','.amend',function(){
                $(this).next('.u_name_err').hide();
            });


            $(document).on('click','.amend',function(){
                var tmp = $(this);
                var val = $(this)  .prev('.name').val();
                var url = addGroup;
                var id = $(this).parent().parent().find("p").attr("data-gid");
                if(val !==""){
                    tmp.parent().parent().find("p").text(val);
                    $(this).next('.u_name_err').hide();
                }
                else{
                    $(this).next('.u_name_err').html("<li style ='color:#ff0e00'>新组名不能为空</li>");
                    $(this).next('.u_name_err').show();
                    return;
                }

                $.ajax({
                    type:"post",
                    url:url,
                    dataType:"json",
                    data:{
                        id:id,
                        invest_group:val
                    },
                    success:function(obj){
//                        window.location.reload();
                        if(obj.level === "success"){
                            noty({text:obj.message,type:obj.level,timeout:200});
                        }
                    },
                    error:function(obj){
                        var datajson = obj.responseJSON;
                        noty({text:datajson.data.invest_group[0],type:datajson.level,timeout:1000});
                    }
                });
            });



            var node = null;
            var str="";
            var id ="";
            var gid="";
            var uid="";
            //添加人员
            $(document).on("click",".add",function(){
                var btn = $(".add");
                //button变色
                var tmp = $(".add_invest");
                $.each(btn, function(i) {
                    btn.eq(i).css("background", "#5cb85c");
                });

                $(this).css("background-color","red");
                tmp.show();
                node = $(this).parent().parent();
                gid = $(this).parent().parent().find("p").attr("data-gid");
            });

            var allId = '';
            $(document).on('click','.all',function(){
                var allId = '';
                var role = $('.role1');
//                console.log(role.children().find('a').append("<span class='delete'>x</span>"));
                var juzi = role.children().find('a');
                $.each(juzi,function(){
//                    console.log($(this).attr("data-id"));
                    node.find("ul").append("<li><a href='#' data-id="+id+">"+$(this).text()+"<span class='delete'>x</span></a></li>")
                    allId += $(this).attr("data-id")+";";

                });
//                console.log(allId);
                $.ajax({
                    type:"post",
                    url:updateAllGroup,
                    dataType:"json",
                    data:{
                        'id':allId.slice(0,-1),
                        'group_id':gid
                    },
                    success:function(obj){
                        if(obj.level === "success"){
                            noty({text:obj.message,type:obj.level,timeout:200});
                        }
                    },
                    error:function(obj){
                        var datajson = obj.responseJSON;
                        noty({text:datajson.message,type:datajson.level,timeout:1000});
                    }
                });

            });

            $(document).on("click",".panel-body a",function(event){

                event.preventDefault();
                str = $(this).text();
                id = $(this).attr("data-id");
                node.find("ul").append("<li><a href='#' data-id="+id+">"+str+"<span class='delete'>x</span></a></li>");
                $.ajax({
                    type:"post",
                    url:groupGroup,
                    dataType:"json",
                    data:{
                        id:id,
                        group_id:gid
                    },
                    success:function(obj){
                        if(obj.level === "success"){
                            noty({text:obj.message,type:obj.level,timeout:200});
                        }
                    },
                    error:function(obj){
                        var datajson = obj.responseJSON;
                        noty({text:datajson.message,type:datajson.level,timeout:1000});
                    }
                });
            });


            //删除投资人
            $(document).on("click", "a .delete", function(event) {
                event.preventDefault();
                var del_gid;
                uid = $(this).parent().attr("data-id");
                del_gid =$(this).parent('a').attr("data");
                $(this).parent().remove();

                $.ajax({
                    type:"post",
                    url:delGroup,
                    dataType:"json",
                    data:{
                        id:uid,
                        group_id:del_gid
                    },
                    success:function(obj){
                        if(obj.level === "success"){
                            noty({text:obj.message,type:obj.level,timeout:200});
                        }
                    },
                    error:function(obj){
                        var datajson = obj.responseJSON;
                        noty({text:datajson.message,type:datajson.level,timeout:1000});
                    }
                });
            });


        });
    </script>

@endsection

