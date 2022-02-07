<?php
class StationAction extends BaseAction {
	

	public function index(){
	    $this->mid=$_GET["id"];
		$this->display();
	}


	public function getList(){
        $list = D("Station")->where(["mid"=>$_GET["mid"]])->select();
        $count = count(M("Station")->where(["mid"=>$_GET["mid"]])->select());
        $res=array("code"=>0,"msg"=>"","count"=>$count,"data"=>$list);
        return $this->ajaxReturn($res,'JSON');
    }  


	public function add(){
		if (IS_POST) {
			$Form = D("Station");

			$Metro = M("Metro")->where(["id"=>$_POST["mid"]])->find();

			$_POST["mname"] = $Metro["name"];
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
	    	$this->mid=$_GET["mid"];
			$this->display();
		}
	}


	public function edit(){
		if (IS_POST) {
			$Form = D("Station");
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
			$data = D("Station")->where(["id"=>$_GET["id"]])->find();
	        $this->data=$data;
			$this->display();
		}
	}


	public function del(){
        $id=$_GET['id'];
        if (M('Station')->where(["id"=>$id])->delete()) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }


}