<?php namespace App\Http\Controllers\Api;
use App\Exceptions\UploadExcelException;
use App\Groups;
use App\Http\Requests\InvestorRequest;
use App\Http\Requests\GroupRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\TypeRequest;
use App\Http\Requests\PhoneRequest;
use App\Http\Controllers\Api\ApiController;

use App\Files;
use App\User;
use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\File;
use App\Services\FileManager;

use App\Investor;
use App\Messages;
use App\Types;
use App\Phones;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Relations;
use Symfony\Component\HttpKernel\Tests\DependencyInjection\MergeExtensionConfigurationPassTest;
use App\Http\Requests\SendEmailRequest;
use App\Services\SendSms;
use App\Exceptions\InvestorException;
use App\Exceptions\SendException;
use Mail;

class UserController extends ApiController {


	/*投资人录入验证*/
	public function investor(InvestorRequest $request,Guard $guard,$id = 0)
	{

		/*判断姓名是否为空*/
		if($request->get('name') == null){
			throw new InvestorException(InvestorException::InvestorNameNUll);
		}

		/*判断邮件是否为空*/
		if($request->get('email')== null){
			throw new InvestorException(InvestorException::InvestorEmailNull);
		}



		if (!is_null($request->get('c_id'))) $id = $request->get('c_id');

		if ($id != 0 && Investor::whereId($id)->exists()) {
			$investors = Investor::find($id);
		} else if(!Investor::whereId($id)->exists()){
			$investors = new Investor();
			/*判断邮件是否已经存在*/
			if(InvestorRequest::InvestorEmailExists($request->get('email'))){
				throw new InvestorException(InvestorException::InvestorEmailExists);
			}
		}


		if (!is_null($request->get('name'))) $investors->name = $request->get('name');
		if (!is_null($request->get('company'))) $investors->company = $request->get('company');
		if (!is_null($request->get('title'))) $investors->title = $request->get('title');
		if (!is_null($request->get('email'))) $investors->email = $request->get('email');
		if (!is_null($request->get('mobile'))) $investors->mobile = $request->get('mobile');
		if (!is_null($request->get('addr'))) $investors->addr = $request->get('addr');
		if (!is_null($request->get('referrer'))) $investors->referrer = $request->get('referrer');
		if (!is_null($request->get('field'))) $investors->field = $request->get('field');
		if (!is_null($request->get('flag'))) $investors->flag = $request->get('flag');
		if (!is_null($request->get('telephone'))) $investors->telephone = $request->get('telephone');
		if (!is_null($request->get('past_case'))) $investors->past_case = $request->get('past_case');
		if (!is_null($request->get('status'))) $investors->status = $request->get('status');
		if (!is_null($request->get('wechat'))) $investors->wechat = $request->get('wechat');
		if (!is_null($request->get('invest_min'))) $investors->invest_min = $request->get('invest_min');
		if (!is_null($request->get('invest_max'))) $investors->invest_max = $request->get('invest_max');
		if (!is_null($request->get('kpi'))) $investors->kpi = $request->get('kpi');
		$investors->role = $guard->user()->id;

		$investors->save();

        /*加入分组*/
        $groupId = $request->get('group_id');
        if(!is_null($groupId)){
            $investors->invest_x_groups()->attach($groupId);
        }
		/*投资类型*/
		$typeId = $request->get('type');
		if(!is_null($typeId)){
			$investors->invest_x_types()->attach($typeId);
		}
//		$roles = $investors->invest_x_types()-get();
//		foreach($roles as $role){
//			if(!in_array($role->id,$roles)){
//				$investors->invest_x_types->detach($role->id);
//			}
//		}




		return $this->buildResponse(trans('编辑成功'));
	}


	/*新增或修改分组*/
	public function group(GroupRequest $request)
	{
		$id = $request->get('id');
		if($id!=0 && Groups::whereId($id)->exists()){
			$groups = Groups::find($id);
		}else if(!Groups::whereId($id)->exists()){
			$groups = new Groups();
		}
		/*接受数据*/
		$investGroup = $request->get('invest_group');
		if(!is_null($investGroup)) $groups->invest_group = $investGroup ;
		$groups->save();
		return $this->buildResponse(trans('操作成功'),$groups);
	}

	/*修改投资人分组*/
	public function updateGroup(Request $request,$id=0){
		$id = $request->get('id');
		$groupId = $request->get('group_id');
		$investors = null;
		if ($id != 0 && Investor::whereId($id)->exists()) {
			$investors = Investor::find($id);
		}
		if(!is_null($groupId)){
			$investors->invest_x_groups()->attach($groupId);
		}
		return $this->buildResponse(trans('操作成功'));
	}

	/*全选*/
	public function updateAllGroup(Request $request){
		$allId = $request->get('id');
		$groupId = $request->get('group_id');
		$id = explode(";",$allId);
		foreach($id as $aid){
//			file_put_contents("E:/log",$aid);
			Investor::find($aid)->invest_x_groups()->attach($groupId);
		}
		return $this->buildResponse(trans('操作成功'));

	}
	/*删除投资人*/
	public function delGroup(Request $request,$id=0){
		$id = $request->get('id');
		$groupId = $request->get('group_id');
		$groups = Groups::find($groupId);
		if(Groups::whereId($groupId)->exists()){
			$groups->invest_x_groups()->detach($id);
		}
		return $this->buildResponse(trans('操作成功'));
	}

	/*message保存*/
	public function message(Request $request,$arr)
	{

		$email = Investor::whereId($arr)->pluck('email');
		$name = Investor::whereId($arr)->pluck('name');
		$theme1 = Input::get('theme');
		$theme2 = str_replace("{姓名}",$name,$theme1);
		$data = [
			'text' => Input::get('text'),
			'theme' => $theme2,
		];

		$message = new Messages();

		/*接收信息*/
		$theme 				= $theme2;
		$fileId 			= $request->get('file_id');
		$investorGroupId 	= $request->get('group_id');
		$text 				= $request->get('text');
		$userId 			= $request->get('user_id');
		$investorId 		= $arr;
		$state 				= $request->get('state');

		/*对数据进行判断*/
		if(!is_null($theme)) $message->theme=$theme ;
		if(!is_null($fileId)) $message->file_id=$fileId ;
		if(!is_null($investorGroupId)) $message->investor_group_id=$investorGroupId ;
		if(!is_null($text)) $message->text=$text ;
		if(!is_null($userId)) $message->user_id=$userId ;
		if(!is_null($investorId)) $message->investor_id=$investorId ;
		if(!is_null($state)) $message->state=$state ;

		$message->save();
		return ['data'=>$data,'email'=>$email];
	}

	/*添加投资人类型*/
	public function type(TypeRequest $request,$id=0)
	{
		if ($id != 0 && Types::whereId($id)->exists()) {
			$types = Types::find($id);
		} else if (!Types::whereId($id)->exists()) {
			$types = new Types();
		}
		$typeName = $request->get('type_name');
		if(!is_null($typeName))$types->type_name=$typeName;
		$types->save();
		return $this->buildResponse(trans('api.type.success'),$types);
	}

	/*获取投资人发送邮件*/
	public function sendEmail(Request $request)
	{
//		if($arr == null && $groupId == null){
//			throw new SendException(SendException::InvestorNotNull);
//		}

		/*获取投资者ID*/

		$arr = $request->get('investor_id');
		$groupId = $request->get('group_id');

		if (!empty($groupId)) {

			$gId = $this->sendGroupEmail($groupId);
			if(!empty($arr)){
				if (strpos($arr, ";") == true) {
					$investId = explode(';', $arr);
					$investId = array_unique(array_merge($gId,$investId));
				} else {
					$gId[] = $arr;
					$investId = array_unique($gId);
				}
			}else{
				$investId = $gId;
			}

			foreach ($investId as $id) {
				/*保存信息*/
				$data=$this->message($request,$id);

				$this->fileNull($data['data'],$data['email']);

			}
			return view("admin.success");
		} else {
			$gId = null;
			if(!empty($arr)){

				$bo = strpos($arr, ";");
				if ($bo == true) {
					$investorId = explode(';', $arr);
					foreach ($investorId as $id) {
						/*保存信息*/
						$data=$this->message($request,$id);

						$this->fileNull($data['data'],$data['email']);

					}
				} else {
					$data= $this->message($request,$arr);
					$this->fileNull($data['data'],$data['email']);

				}
				return view("admin.success");
			}
		}
	}

	/*判断文件是否存在然后发送邮件*/
	public function fileNull($data,$email)
	{
			Mail::queue('admin.emailDoc', $data, function (Message $message) use ($email) {
				$message->from(env('MAIL_USERNAME'), ' laravel学院最新资讯推荐
');
				$message->to($email)->subject(' laravel学院最新资讯推荐
');
			});
		return;
	}


	/*获取组发送邮件*/
	public function sendGroupEmail($groupId){
		if($groupId !== null){
			$bo = strpos($groupId, ";");
			if($bo == true){
				$groupIds = explode(';', $groupId);
				foreach($groupIds as $gid) {
					$invest[] = Groups::find($gid)->invest_x_groups()->get();
				}
				foreach($invest as $arrs) {
					foreach ($arrs as $arr) {
						$investorId[] =(string)($arr->id);
					}
				}

			}else{
				$investor = Groups::find($groupId)->invest_x_groups()->get();
				foreach($investor as $arr ){
					$in_id[] =(string)($arr->id);
				}

			}
			return $in_id;
		}
//		return $this->buildResponse(trans('api.sandEmail.success'));
	}


		/*发送电话信息*/
	public function sendPhone(){

		$arr = Input::get('investor_id');
		if($arr == null){
			throw new SendException(SendException::NoPhoneArr);
		}
			$bo = strpos($arr, ";");
			if ($bo == true) {
				$investorId = explode(';', $arr);
				$investorId = array_unique($investorId);
				foreach ($investorId as $id) {
					$phone = Investor::whereId($id)->pluck('mobile');
					$name = Investor::whereId($id)->pluck('name');

					if (!is_null($phone)) {
						$codePhone = new Phones();
						$codePhone->investor_id = $id;
						$codePhone->phone = $phone;


						$text = Input::get('text');//("%04d", rand(0, 9999));
						$codePhone->text = str_replace("{姓名}" , $name , $text );
						$codePhone->save();
						(new SendSms())->SendSms($phone, $codePhone->text);
					}
				}
			} else {
				$phone = Investor::whereId($arr)->pluck('mobile');
				$name = Investor::whereId($arr)->pluck('name');
				if (!is_null($phone)) {
					$codePhone = new Phones();
					$codePhone->investor_id = $arr;
					$codePhone->phone = $phone;


					$text = Input::get('text');
					$codePhone->text = str_replace("{姓名}" , $name , $text );
					$codePhone->save();
					(new SendSms())->SendSms($phone, $codePhone->text);
				}
			}
		return $this->buildResponse(trans('发送成功'));

	}


	/*上传附件判断*/
	public function uploadFile(Request $request){

		$uploadFile = $request->file('file');
		$fileName = $uploadFile->getClientOriginalName();
		$fileModel = FileManager::UploadFile($uploadFile,$fileName);

		Session::put('FileId',$fileModel->id);
		if($fileModel)
			return $this->buildResponse(trans('api.bp_upload.success'),$fileModel);
	}

	public function getFileAsDownloadById($id = 0){

		/** @var Files $files */
		$files = Files::find($id);
		return \Response::download($files->getLocalPath(),urldecode($files->file_name),[],'inline');
	}

	public $tmpId = 0;

	/*上传Excel入数据库*/
	public function uploadExcel(Guard $guard , Request $request)
	{
		$this->tmpId = $guard->user()->id;
		/*判断上传文件是否为空*/
		if(empty($_FILES['report']['name'])){
			throw new UploadExcelException(UploadExcelException::FileNull);
		}
		$tmp_file = $_FILES['report']['name'];
		$file_types = explode(".",$_FILES['report']['name']);
		$file_type = $file_types[count($file_types)-1];

		/*判断是不是.xls文件,判别是不是excel文件*/
		if(strtolower($file_type)!="xls"){
			throw new UploadExcelException(UploadExcelException::FileNotXls);
		}
		Excel::load(Input::file('report'), function($reader) {



			//获取excel的第几张表
		$reader = $reader->getSheet(0);
		//获取表中的数据
		$results = $reader->toArray();

			foreach($results as $k=>$v){
				if($k ===0){
					if($v[1] !== "name"){
						throw new UploadExcelException(UploadExcelException::FileContent);
					};
				}
			}
			foreach($results as $k=>$v){
				if($k ===0) continue;
				$investors = new Investor();
				$investors->name = $v[1];
				$investors->company = $v[2];
				$investors->title =$v[3];
				$investors->telephone = $v[4];
				$investors->mobile = $v[5];
				$investors->past_case = $v[6];
				$investors->status = $v[7];
				$investors->flag= $v[8];
				$investors->wechat= $v[9];
				$investors->addr = $v[10];
				$investors->referrer = $v[11];
				$investors->email = $v[12];
				$investors->field = $v[13];
				$investors->role = $this->tmpId;
				$investors->save();

			}
		});

		return view("admin.success");
	}

	/*编辑用户*/
	public function editInvestor(Request $request)
	{

		$investor = $request->get("id");
		$investor = Investor::find($investor);
		return $investor;
	}

	/*上传TXT格式到数据库*/
	public function uploadTxt(Request $request)
	{
		$t1 = microtime(true);
		$file = $request->file('txt');//10W条记录的TXT源文件
		$lines = file_get_contents($file);
		ini_set('memory_limit', '-1');//不要限制Mem大小，否则会报错
		$line=explode("\r\n",$lines,-1);
		$i=0;
		foreach ($line as $k=>$i ) {
			$invest = new Investor();
			$invest->email = $i;
			$invest->save();
		}
		$t2 = microtime(true);
		echo '耗时'.round($t2-$t1,3).'秒';

		return view("admin.success");
	}

/*读取文件中所有行数*/
	public function count_line($file)
	{
		$fp=fopen($file, "r");
		$i=0;
		while(!feof($fp)) {
			//每次读取2M
			if($data=fread($fp,1024*1024*2)){
				//计算读取到的行数
				$num=substr_count($data,"\n");
				$i+=$num;
			}
		}
		fclose($fp);
		return $i;
	}
}
