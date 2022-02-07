<?php
class MenuAction extends BaseAction {
	

	public function index(){
		$this->display();
	}


	public function getList(){
        $list = D("Menu")->order("sort asc")->select();
        return $this->ajaxReturn($list,'JSON');
    }  


	public function add(){
		if (IS_POST) {
			$Form = D("Menu");
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
			$list = D("Menu")->where(["pid"=>0])->order("sort asc")->select();
	        $this->list=$list;
			$this->display();
		}
	}


	public function edit(){
		if (IS_POST) {
			$Form = D("Menu");
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
			$list = D("Menu")->where(["pid"=>0,"id"=>array("neq",$_GET["id"])])->order("sort asc")->select();
			$data = D("Menu")->where(["id"=>$_GET["id"]])->find();
	        $this->list=$list;
	        $this->data=$data;
			$this->display();
		}
	}


	public function del(){
        $id=$_GET['id'];
        if (M('Menu')->where(["id"=>$id])->delete()) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }


}