<?php
class OrderAction extends BaseAction {


	public function index(){
        $this->display();
    }


    public function getList(){
        $list = D("Order")->select();
        $count = count(M("Order")->select());
        $res=array("code"=>0,"msg"=>"","count"=>$count,"data"=>$list);
        return $this->ajaxReturn($res,'JSON');
    }  


    public function pay(){
        $user=$_SESSION['user'];
        $Form = D("Order");
        $_POST["paytime"] = time();
        $_POST["state"] = 0;
        $_POST["uid"] = $user["id"];
        $_POST["uname"] = $user["name"];
        if($Form->create()){
            $result = $Form->add();
            if($result){
                $this->success("保存成功");
            }else{
                $this->error("保存中....");
            }
        }else{
            $this->error($Form->getError());
        }
    }


	public function shiyong(){
        $id=$_GET['id'];
        if (M("Order")->where(["id"=>$id])->save(["state"=>1])) {
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
        }
    }


}