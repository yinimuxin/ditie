 <?php
import("ORG.Net.UploadFile");

class UpyunAction extends Action {
	
	// 文件上传
	public function Upload() {
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  'Uploads/'.date("ymd",time())."/";// 设置附件上传目录
		
		//设置需要生成缩略图，仅对图像文件有效
		$upload->thumb = true;
		//设置需要生成缩略图的文件后缀
		$upload->thumbPrefix = 'm_,s_';  //生产2张缩略图
		//设置缩略图最大宽度
		$upload->thumbMaxWidth = '200,50';
		//设置缩略图最大高度
		$upload->thumbMaxHeight = '200,50';
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功
			$data = $upload->getUploadFileInfo();
			
			
			import("@.ORG.Image");
			//给m_缩略图添加水印, Image::water('原文件名','水印图片地址')
			Image::water($data[0]['savepath'] .  $data[0]['savename'], APP_PATH.'Tpl/Public/Images/logo.png');
			$_POST['image'] = $data[0]['savename'];
			
			$this->data = $data[0];
			$this->success($data[0]['savepath'].$data[0]['savename']);
		}
	}


	// 文件上传
	public function ajaxupload() {
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  'Uploads/'.date("ymd",time())."/";// 设置附件上传目录
	
		//设置需要生成缩略图，仅对图像文件有效
		$upload->thumb = true;
		//设置需要生成缩略图的文件后缀
		$upload->thumbPrefix = 'm_,s_';  //生产2张缩略图
		//设置缩略图最大宽度
		$upload->thumbMaxWidth = '200,50';
		//设置缩略图最大高度
		$upload->thumbMaxHeight = '200,50';
		if(!$upload->upload()) {// 上传错误提示错误信息
				$data['status']="0";
				$this->ajaxReturn($data,"Json");
		}else{// 上传成功
			$data = $upload->getUploadFileInfo();
				
				
			import("@.ORG.Image");
			//给m_缩略图添加水印, Image::water('原文件名','水印图片地址')
			Image::water($data[0]['savepath'] .  $data[0]['savename'], APP_PATH.'Tpl/Public/Images/logo.png');
			$_POST['image'] = $data[0]['savename'];

			$data['status']="1";
			$newumg = $data[0]['savepath'] ."m_".$data[0]['savename'];
			//$this->ajaxReturn($data,"JSON");
			
			echo "<script>parent.stopSend('$newumg')</script>";
			//$this->success('上传成功！');
		}
	}
	
	public function simple(){
		$upload = new UploadFile();
		$upload->maxSize  = 10485760 ;
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
		$upload->savePath =  'Uploads/'.date("ymd",time())."/";// 设置附件上传目录
	
		//设置需要生成缩略图，仅对图像文件有效
		//$upload->thumb = true;
		
		if(!$upload->upload()) {
			echo $upload->getErrorMsg();
			$msg="上传时发生错误";
		}else{
			$msg="上传成功！";
			$info =  $upload->getUploadFileInfo();
			//session('savename',$info[0]['savename']);
		}
		//Array ( [name] => 13 (4).jpg [type] => application/octet-stream [size] => 126060 [key] => Filedata [extension] => jpg [savepath] => Uploads/130422/ [savename] => 517534ff1fad0.jpg [hash] => fc1820cb935b32cc673be7f3793524ec )
		//echo json_encode($info[0]);
		$this->msg=$msg;
		$this->result=1;
		$this->info=$info[0];
		
		$this->display('add');
		
	}
	

	public function Excelupload(){
		$excelpath = "Public/Admin/Excel/";

		$upload = new UploadFile();// 实例化上传类
        $upload->maxSize=2097152 ;// 设置附件上传大小
        $upload->exts=array('xls','xlsx'); // 设置附件上传类型
        $upload->savePath=$excelpath; // 设置附件上传目录
        $saveName = time().rand(0000,9999);
        $upload->saveName = $saveName;
            
        // 上传文件 
        if($upload->upload()){
            $info = $upload->getUploadFileInfo();
            $extension = $info[0]['extension'];
            $savename = $info[0]['savename'];
            $savepath = $info[0]['savepath'];
            $filename = $savepath.$savename;
			$this->success(["houzhui"=>$extension,'savename'=>$savename,"url"=>$filename]);
        }else{
			$this->error($upload->getError());
        }
	}
	
}