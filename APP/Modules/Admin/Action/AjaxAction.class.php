<?php
class AjaxAction extends Action{
	public function getRegion(){
		$school=M("school");
		$map['pid']=$_REQUEST["pid"];
		$map['type']=$_REQUEST["type"];
		$list=$school->where($map)->select();
		echo json_encode($list);
	}
	
	
}