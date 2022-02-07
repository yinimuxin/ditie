<?php

class BaseAction extends Action
{
    protected function _initialize()
    {
  		$user=$_SESSION['user'];
        if (empty($_SESSION['system'])) {
            $_SESSION['system'] = M("system")->find();
        }
  		if(empty($user)){
			$this->redirect("admin.php/Login/index");
		}else{
			$where = [];
			$controller = MODULE_NAME;
			$main=ACTION_NAME;
			$href = "/admin.php/".$controller."/".$main;
			$where["href"] = $href;
			$res = D("menu")->where($where)->find();
			if (!empty($res)) {
				$reslut = D("role_menu")->where(["rid"=>$user["rid"],"mid"=>$res["id"]])->find();
		    	if (empty($reslut)) {
		    		echo "权限不足，请联系管理员";
					exit;
		    	}
			}
			
		}
    }

    
    protected function download($path,$pathname) {
        $file_name=iconv("utf-8","gb2312",$pathname);
        $path=$_SERVER['DOCUMENT_ROOT'].$path;
        $file_path=$path.$file_name;

        $fp=fopen($file_path,"r"); 
        $file_size=filesize($file_path);
        //下载文件需要用到的头 
        Header("Content-type: application/octet-stream"); 
        Header("Accept-Ranges: bytes"); 
        Header("Accept-Length:".$file_size); 
        Header("Content-Disposition: attachment; filename='".$file_name."'"); 
        $buffer=1024; 
        $file_count=0; 
        while(!feof($fp) && $file_count<$file_size){ 
            $file_con=fread($fp,$buffer); 
            $file_count+=$buffer; 
            echo $file_con; 
        } 
        fclose($fp);    
        exit();
	}

	
	
}
?>