@extends('common')

@section('content')

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">发送邮件</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" id="form_email" action="{{ route('Api.sendEmail') }}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token"   value="{{ csrf_token() }}">

						<div class="form-group" style="display: none;">
							<label for="companyName" class="col-sm-2 control-label">用户</label>
							<div class="col-sm-10">
								<input type="text"  name="user_id" placeholder="" value="{{ Auth::user()->id }}">
							</div>
						</div>

						<div class="form-group" style="display: none;">
							<label for="companyName" class="col-sm-2 control-label">收件人ID</label>
							<div class="col-sm-10">
								<textarea  name="investor_id" class="form-control id" id=""  placeholder="收件人ID"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="companyName" class="col-sm-2 control-label">收件人</label>
							<div class="col-sm-10">
								<textarea  class="form-control user" id=""  placeholder="收件人或收件组必选一项"></textarea><em class="error user_err" ></em>
							</div>
						</div>

						<div class="form-group" style="display: none;">
							<label for="" class="col-sm-2 control-label">收件组ID</label>
							<div class="col-sm-10">
								<textarea  name="" class="form-control add_groupId" id=""  placeholder="收件组ID"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">收件组</label>
							<div class="col-sm-10">
								<textarea  name="" class="form-control add_groupName" id=""  placeholder="收件人或收件组必选一项"></textarea><em class="error group_err" ></em>
							</div>
						</div>

{{--						@if(\App\User::whereId(Auth::user()->id)->first()->email =='592560885@qq.com')--}}
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">投资人分组</label>
							<div class="col-sm-10">
								<div class="checkbox">

									@foreach(\App\Groups::all() as $Group)
										<label class="get_groupId" >
											<em style="margin-right:30px;font-style: normal;"><input   type="checkbox" name="group_id" value="{{$Group->id}}" style="position:static" />{{$Group->invest_group}}</em>
										</label>
									@endforeach
								</div>
							</div>
						</div>
						{{--@endif--}}

						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">主题</label>
							<div class="col-sm-10">
								<input type="text" name="theme" class="form-control" id="" placeholder="请输入主题" value="尊敬的{姓名}:">
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">正文</label>
							<div class="col-sm-10">
								<textarea  name="text" rows="4" id="container" placeholder="请输入正文" ></textarea>

								<script type="text/javascript">
									var ue = UE.getEditor('container');
								</script>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default btn-sendEmail">发送</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>


		<script>
			/*获取投资人分组id*/
			jQuery(function(){
				var doc = $(document);
				var groupId ="";
				var groupName ="";
				doc.on("click",".get_groupId input",function(){
					$('.add_groupId').val("");
					$('.add_groupName').text("");
					groupName = "";
					groupId = "";
					$("input[name='group_id']:checked").each(function () {
						groupId += $(this).val()+";";
						groupName += $(this).parent().text()+";";
						$(".add_groupId").val(groupId.slice(0,-1));
						$(".add_groupName").text(groupName.slice(0,-1));
					});
				});


//				doc.on("click",".btn-sendEmail",function(event){
//					var obj =$('.user').val();
//					var obj_group =$('.add_groupName').val();
//					event.preventDefault();
//
//					if(obj === "" && obj_group === ""){
//						$('.user_err').html("<p style='color: red'>收件人或收件组不能为空</p>");
//						$('.group_err').html("<p style='color: red'>收件人或收件组不能为空</p>");
//						$('.user_err').show();
//					}
//
//					if (obj !== "") {
//						$('#form_email').submit();
//					}
//				});

			});


		</script>
@endsection

