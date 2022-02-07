<?php
class PiaoAction extends BaseAction {
	

	public function index(){
		$this->display();
	}


	public function search(){
		$list = array();
        $startname = $_GET["startname"];
        $endname = $_GET["endname"];
        //起始站所有线路
        $startlist = M("Station")->where(["name"=>$startname])->select();
        if (!empty($startlist)) {
        	//单线算法
        	foreach ($startlist as $key => $start) {
        		$end = M("Station")->where(["name"=>$endname,"mid"=>$start["mid"]])->find();
        		if (!empty($end)) {
        			$data = array();
        			$num = $this->max_min($start["sort"],$end["sort"]);
        			$data["mname"] = $end["mname"];
        			$data["startname"] = $startname;
        			$data["endname"] = $endname;
        			$data["num"] = $num;
        			$data["money"] = $this->jisuan($num);
        			$data["date"] = $num*5;
        			$list[] = $data;
        			return $this->ajaxReturn(array("code"=>0,"msg"=>"","count"=>count($list),"data"=>$list),'JSON');
        		}
        	}
        	//一次换线算法  所有不同线路的起始点
        	foreach ($startlist as $key => $start) {
        		//查询同一线路所有站点
        		$mlist = M("Station")->where(["mid"=>$start["mid"]])->select();
        		foreach ($mlist as $skey => $station) {
        			//查询 所有不同线路的转站起点
        			$stationlist1 = M("Station")->where(["name"=>$station["name"]])->select();
        			
        			foreach ($stationlist1 as $skey2 => $station2) {
        				$end = M("Station")->where(["mid"=>$station2["mid"],"name"=>$endname])->find();
        				if (!empty($end)) {
		        			$data = array();
        					$num = $this->max_min($start["sort"],$station["sort"]);
		        			$num += $this->max_min($station2["sort"],$end["sort"]);
		        			$data["mname"] = $start["mname"].$start["name"]."->".$station["name"]."转".$end["mname"]."->".$end["name"];
		        			$data["startname"] = $startname;
		        			$data["endname"] = $endname;
		        			$data["num"] = $num;
		        			$data["money"] = $this->jisuan($num);
		        			$data["date"] = $num*5;
		        			$list[] = $data;
		        			return $this->ajaxReturn(array("code"=>0,"msg"=>"","count"=>count($list),"data"=>$list),'JSON');
		        		}
        			}
        		}
        	}
        }
        return $this->ajaxReturn(array("code"=>0,"msg"=>"","count"=>count($list),"data"=>$list),'JSON');
    }

    public function max_min($max,$min){
    	if ($max>$min) {
    		return $max-$min;
    	}
    	return $min-$max;
    }

    public function jisuan($num){
    	$m1 = intval(($num/3)*1);
        $m2 = ($num%3)*0.5;
    	return $m1+$m2;
    }

}