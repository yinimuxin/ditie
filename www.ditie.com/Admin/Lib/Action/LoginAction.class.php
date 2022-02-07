<?php
import('ORG.Util.Jm');// 导入加密类

// 本类由系统自动生成，仅供测试用途
class LoginAction extends Action {
	
    protected function _initialize()
    {
        if (empty($_SESSION['system'])) {
            $_SESSION['system'] = M("system")->find();
        }
    }
    
    public function index(){
        $this->display();
    }

    public function manager(){
        $jm = new Jm();
        $map['username'] = $_POST['username'];

        $data = D("User")->where($map)->find();

        if(!empty($data)){
            if ($_POST['password']==$jm->decrypt($data['password'],$jm->key)) {
                $data["roleinfo"] = D("Role")->where(["id"=>$data["rid"]])->find();
                if (!empty($data["roleinfo"])&&$data["roleinfo"]["type"]==2) {
                    $data["roleinfo"]["shopinfo"] = D("Shop")->where(["id"=>$data["sid"]])->find();
                }
                $_SESSION['user'] = $data;
                $this->success("登录成功","/admin.php/Index/index");
            }else{
                $this->error("用户名或密码错误");
            }
        }else{
            $this->error("用户名或密码错误");
        }
    }

    public function logout(){
        $_SESSION['user']=null;
        $this->success("安全退出","/admin.php");
    }


    //session验证是否存在
    public function checkSession(){
        $user = $_SESSION['user'];
        if(!empty($user)){
            return $this->ajaxReturn($user,"JSON");
        }else{
            return $this->ajaxReturn(false,"JSON");
        }
    }

    // public function test(){
    //     $jm = new Jm();
    //     echo $jm->encrypt("123456",$jm->key);
    // }

}