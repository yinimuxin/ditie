<?php
import('ORG.Util.Jm');// 导入加密类

class UserAction extends BaseAction {
	

	public function getList(){
        header('Content-Type:application/json; charset=utf-8');
		$rid = $_GET["rid"];
        $list = M("User")->limit($_GET['limit']*$_GET['page']-$_GET['limit'].','.$_GET['limit'])->select();
        foreach ($list as $key => $value) {
        	$list[$key]["roleinfo"] = M("Role")->where(["id"=>$value["rid"]])->find();
        }
        $count = count(M("User")->where(["rid"=>$rid])->select());
        $res=array("code"=>0,"msg"=>"","count"=>$count,"data"=>$list);
        return $this->ajaxReturn($res,'JSON');
    }


	public function index(){
		$this->display();
	}


	public function add(){
        $jm = new Jm();
		if (IS_POST) {
			$Form = M("User");
			$_POST["password"] = $jm->encrypt($_POST['password'],$jm->key);
			$_POST["createtime"] = time();
			if($Form->create()){
				$res = $Form->add();
				if($res){
					$this->success("保存成功");
				}else{
					$this->error("保存中....");
				}
			}else{
				$this->error($Form->getError());
			}
		}else{
			$rolelist = D("Role")->select();
	        $this->rolelist=$rolelist;
			$this->display();
		}
	}


	public function edit(){
        $jm = new Jm();
		if (IS_POST) {
			$Form = M("User");
			$_POST["password"] = $jm->encrypt($_POST['password'],$jm->key);
			$_POST["updatetime"] = time();
			if($Form->create()){
				$res = $Form->save();
				if($res){
					$this->success("保存成功");
				}else{
					$this->error("保存中....");
				}
			}else{
				$this->error($Form->getError());
			}
		}else{
			$data = D("User")->where(["id"=>$_GET["id"]])->find();
			$data["password"] = $jm->decrypt($data['password'],$jm->key);
	        $this->data=$data;
			$rolelist = D("Role")->select();
	        $this->rolelist=$rolelist;
			$this->display();
		}
	}


	public function del(){
        $id=$_GET['id'];
        if (M('User')->where(["id"=>$id])->delete()) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
	
	
}