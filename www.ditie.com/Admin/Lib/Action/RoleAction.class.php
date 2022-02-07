<?php
class RoleAction extends BaseAction {
	
	public function getList(){
        header('Content-Type:application/json; charset=utf-8');
        $list = M("Role")->order("id")->limit($_GET['limit']*$_GET['page']-$_GET['limit'].','.$_GET['limit'])->select();
        $count = count(M("Role")->select());
        $res=array("code"=>0,"msg"=>"","count"=>$count,"data"=>$list);
        return $this->ajaxReturn($res,'JSON');
    }

    public function getMenuList(){
        $list = D("Menu")->order("sort asc")->select();
        if ($_GET["hidden"]=="edit") {
        	foreach ($list as $key => $value) {
        		$res = D("role_menu")->where(["rid"=>$_GET["id"],"mid"=>$value["id"]])->find();
        		if ($res) {
        			$list[$key]["checked"] = true;
        		}else{
        			$list[$key]["checked"] = false;
        		}
        	}
        }
        return $this->ajaxReturn($list,'JSON');
    }  

	public function index(){
		$this->display();
	}

	public function add(){
		if (IS_POST) {
			$role_menu = [];
			if (!empty($_POST["role_menu"])) {
				$role_menu = split(",", $_POST["role_menu"]);
			}
	        M()->startTrans();
			$Form = M("Role");
			$Role_menu = M("role_menu");
			$_POST["createtime"] = time();
			$_POST["updatetime"] = time();
			if($Form->create()){
				$id = $Form->add();
				$bool = true;
				foreach ($role_menu as $key => $value) {
					$res = $Role_menu->add(["rid"=>$id,"mid"=>$value]);
					if (!$res) {
						$bool = false;
					}
				}
				if($id&&$bool){
	                M()->commit();
					$this->success("保存成功");
				}else{
	                M()->rollback();
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
			$role_menu = [];
			if (!empty($_POST["role_menu"])) {
				$role_menu = split(",", $_POST["role_menu"]);
			}
			M()->startTrans();
			$Form = M("Role");
			$Role_menu = M("Role_menu");

			$data = [];
			$data["id"] = $_POST["id"];
			$data["type"] = $_POST["type"];
			$data["name"] = $_POST["name"];
			$data["content"] = $_POST["content"];
			$data["updatetime"] = time();
			$result = $Form->where(["id"=>$_POST["id"]])->save($data);

	        $Role_menu->where(["rid"=>$_POST["id"]])->delete();
			$bool = true;
			foreach ($role_menu as $key => $value) {
				$res = $Role_menu->add(["rid"=>$_POST["id"],"mid"=>$value]);
				if (!$res) {
					$bool = false;
				}
			}
			if ($bool) {
				if($result||$bool){
		            M()->commit();
					$this->success("保存成功");
				}else{
		            M()->rollback();
					$this->error("保存中....");
				}
			}else{
		        M()->rollback();
				$this->error("保存失败");
			}
		}else{
			$data = D("Role")->where(["id"=>$_GET["id"]])->find();
	        $this->data=$data;
			$this->display();
		}
	}


	public function del(){
        $id=$_GET['id'];
        if (M('Role')->where(["id"=>$id])->delete()) {
        	M("role_menu")->where(["rid"=>$id])->delete();
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
	
	
}