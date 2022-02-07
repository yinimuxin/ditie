<?php
class MetroAction extends BaseAction {
	

	public function index(){
		$this->display();
	}


	public function getList(){
        $list = D("Metro")->select();
        $count = count(M("Metro")->select());
        $res=array("code"=>0,"msg"=>"","count"=>$count,"data"=>$list);
        return $this->ajaxReturn($res,'JSON');
    }  


	public function add(){
		if (IS_POST) {
			$Form = D("Metro");
			$_POST["createtime"] = time();
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
		}else{
			$this->display();
		}
	}


	public function edit(){
		if (IS_POST) {
			$Form = D("Metro");
			$_POST["updatetime"] = time();
			if($Form->create()){
				$result = $Form->save();
				if($result){
					$this->success("保存成功");
				}else{
					$this->error("保存中....");
				}
			}else{
				$this->error($Form->getError());
			}
		}else{
			$data = D("Metro")->where(["id"=>$_GET["id"]])->find();
	        $this->data=$data;
			$this->display();
		}
	}


	public function del(){
        $id=$_GET['id'];
        if (M('Metro')->where(["id"=>$id])->delete()) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }


}