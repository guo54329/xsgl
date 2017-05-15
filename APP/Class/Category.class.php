<?php

Class Category{

    //组合一维数组：无限极分类
	Static Public function unlimitedForLevel($cate,$html='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$pid=0,$level=0){

		$arr=array();
		foreach ($cate as $v) {
			if($v['pid']==$pid){

				$v['level']=$level+1;
				$v['html']=str_repeat($html, $level);
				$arr[]=$v;
				$arr = array_merge($arr,self::unlimitedForLevel($cate,$html,$v['id'],$level+1));
			}
		}
		return $arr;

	}

	//组合多维数组：所有组栏目存档到父栏目中，生成一个多维数组
	Static public function  unlimitedForLayer($cate,$name='child',$pid=0){

		$arr=array();
		foreach ($cate as $v) {
			if($v['pid']==$pid){

				$v[$name]=self::unlimitedForLayer($cate,$name,$v['id']);
				$arr[]=$v;
				//$arr = array_merge($arr,self::unlimitedForLevel($cate,$html,$v['id'],$level+1));
			}
		}
		return $arr;

	}
 
 	//传入一个子分类id，返回所有的父级分类(从顶级栏目到指定子栏目这样的顺序。)
 	//PHP>>数组
	Static Public function getParents($cate,$id){
		$arr=array();
		foreach ($cate as $v) {
			if($v['id']==$id){
				$arr[]=$v;
				$arr = array_merge(self::getParents($cate,$v['pid']),$arr);

			}
		}
		return $arr;
	}
    //传入一个子分类id，返回所有的父级id
	/*Static Public function getParentsId($cate,$id){
		$arr=array();
		foreach ($cate as $v) {
			if($v['id']==$id){
				$arr[]=$v['pid'];
				$arr = array_merge(self::getParents($cate,$v['pid']),$arr);

			}
		}
		return $arr;
	}*/

	//传入一个父分类id,返回所有的子分类id。
	//服装                      家用电器（父类）
	//男装         女装                  （子分类）
	//Txue 西装    衬衫   裙子            （子子分类...）
	Static Public function getChildsId($cate,$pid){
		$arr=array();
		foreach ($cate as $v) {
			if($v['pid']==$pid){
				$arr[]=$v['id'];
				$arr = array_merge($arr,self::getChildsId($cate,$v['id']));

			}
		}
		return $arr;
	}
	//返回所有子分类的所有字段值
	Static Public function getChilds($cate,$pid){
		$arr=array();
		foreach ($cate as $v) {
			if($v['pid']==$pid){
				$arr[]=$v;
				$arr = array_merge($arr,self::getChilds($cate,$v['id']));

			}
		}
		return $arr;
	}

}

?>