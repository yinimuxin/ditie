<?php
import('ORG.Util.Jm');// 导入加密类

class IndexAction extends BaseAction {
	

    public function index(){
        $this->display();
    }


	public function getmenu(){
        header('Content-Type:application/json; charset=utf-8');
        $where = [];
        $list = null;
        $user = $_SESSION['user'];

        $role_menu = D("role_menu")->where(["rid"=>$user["rid"]])->select();
        if (!empty($role_menu)) {
            $where["id"] = array();
            foreach ($role_menu as $key => $value) {
                array_push($where["id"], array("eq",$value["mid"]));
            }
            array_push($where["id"], "or");
            $list = D("menu")->where($where)->order("sort asc")->select();
        }
    	return $this->ajaxReturn($list,"JSON");
    }


    public function pwd(){
        $this->display();
    }    


    public function updatePwd(){
        $jm = new Jm();
        $password=$_POST['password'];
        if($password==$jm->decrypt($_SESSION['user']['password'],$jm->key)){
            if($_POST['passwordl']==$_POST['passwordld']){
                M('User')->where(array('id'=>$_SESSION['user']['id']))->save(array('password'=>$jm->encrypt($_POST['passwordl'],$jm->key)));
                $user = M('User')->where(array('id'=>$_SESSION['user']['id']))->find();
                $_SESSION['user']=$user;
                $this->success("修改成功！重启生效");
            }else{
                $this->error("两次密码输入不一致");
            }
        }else{
            $this->error("旧密码输入有误");
        }
    }


    public function main(){
        $this->display();
    }

    
}