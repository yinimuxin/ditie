<?php
class UserOrderAction extends BaseAction {


	public function index(){
        $this->display();
    }


    public function getList(){
        $user=$_SESSION['user'];
        $list = D("Order")->where(["uid"=>$user["id"]])->select();
        $count = count(M("Order")->where(["uid"=>$user["id"]])->select());
        $res=array("code"=>0,"msg"=>"","count"=>$count,"data"=>$list);
        return $this->ajaxReturn($res,'JSON');
    }  


}