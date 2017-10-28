<?php
/*
 * ´´½¨ÓÚ£º 2015-2-13
 * ´´½¨ÈË£º guosheng
 * Ä£°åÎ»ÖÃ£º´°¿Ú->Ê×Ñ¡Ïî->PHPeclipse->PHP->Code Templates
 */

class Dbbp {
    //可以读取初始化时传递过来的数据库配置信息
    public $host;  //='127.0.0.1';    
    public $user;  //='root';    
    public $pwd;   //='';     
    public $database; //='xsgl';   
    public $charset;  //='utf8';   
    

    public function conn() {
        
        $con = mysql_connect($this->host,$this->user,$this->pwd);
        
        if (!$con){
            die('Could not connect');
        }

        $db_selected = mysql_select_db($this->database, $con);
        if (!$db_selected) {
            die('Can\'t use select db');
        }

        mysql_set_charset($this->charset);    
        
        return $con;
    }


    /**
     * ±¸·Ý ...
     * @param $tablename Òª±¸·ÝµÄ±íÃû£¨Êý×é£©£¬ $filename ±¸·ÝµÄÎÄ¼þÃû
     */
   public  function beifen($tablename,$filename) {
        //$this->conn();    //Á¬½ÓÊý¾Ý¿â
		
		//±¸·ÝÎÄ¼þ´æ·ÅµÄÄ¿Â¼¶¨Òå
		$dir="./DBback";
		if(!is_dir($dir)){ //Èç¹û±¸·ÝÓÃµÄÎÄ¼þ¼Ð²»´æÔÚÔò´´½¨
			mkdir($dir);
		}
	    $filename = "./$dir/$filename.sql"; 
		$filename = iconv('UTF-8','GB2312',$filename);
		//echo "±¸·Ý×ªÂëºó£º".$filename;
        $sql=$this->sqlcreate($tablename);
        $sql2=$this->sqlinsert($tablename);
        $data=$sql.$sql2;

        return file_put_contents($filename,$data); // ±£´æµÄÎÄ¼þÃûºº×ÖÕý³£ÏÔÊ¾
    }

    /**
     * »¹Ô­ ...
     * @param $filename »Ö¸´µÄÎÄ¼þÃû
	 * »Ö¸´Ô­Àí£º//1¡¢»ñÈ¡Ö¸¶¨»Ö¸´ÎÄ¼þÖÐµÄ±íÃû£¬2¡¢È»ºó¶ÔÕÕ»Ö¸´ÎÄ¼þÖÐµÄ±íÃû½øÐÐÔ­±í£¬3¡¢°´Ö¸¶¨»Ö¸´ÎÄ¼þ½øÐÐ»Ö¸´£¨±í½á¹¹ºÍÊý¾Ý£©
     */
   public function huanyuan($filename) {
        //$this->conn();    //Á¬½ÓÊý¾Ý¿â

		//Ñ¡ÔñµÄ»Ö¸´ÎÄ¼þ´æ·ÅµÄÄ¿Â¼¶¨Òå
		$dir="./DBback";
		if(!is_dir($dir)){ //Èç¹û±¸·ÝÓÃµÄÎÄ¼þ¼Ð²»´æÔÚÔò´´½¨
			mkdir($dir);
		}
	    $filename = "./$dir/$filename";  //ÎÄ¼þÃûÖÐÒÑº¬.sql
		$filename = iconv('UTF-8','GB2312',$filename);
		//echo "»¹Ô­×ªÂëºó£º".$filename;
       //1ºÍ2¡¢»ñÈ¡±¸·ÝÎÄ¼þÖÐµÄ±íÃû£¬±£´æµ½Êý×é$tblname,²¢É¾³ýÔ­Êý¾Ý¿âÏàÓ¦±í
	    $str=file_get_contents($filename);
		$reg ='/CREATE TABLE `[\w]+`/';
		preg_match_all($reg, $str, $tblarr);
		$tblarr=$tblarr[0];
		$tblname=array();//±£´æ±íÃû
		
		$index1=0;  //ÓÃÓÚ¼ÇÂ¼³É¹¦É¾³ý±íµÄ´ÎÊý
		
		//°´ÕÕÎÄ¼þÖÐµÄ±íÃû³ÆÉ¾³ýÔ­±í
		for($i=0;$i<count($tblarr);$i++){
			$tblname[$i] = substr($tblarr[$i],13); //±íÃû³ÆÑùÊ½Îª£º`hd_wish`
			//$tblname[$i] = substr($tblname[$i],0,-1);	
			if(mysql_query("DROP TABLE $tblname[$i]")){
				$index1++;
			}
		}
		//print_r($tblname);  ±¸·ÝÎÄ¼þÖÐ±íÃû
		
		//3¡¢°´Ö¸¶¨ÎÄ¼þ½øÐÐ»Ö¸´£¨½á¹¹ºÍÊý¾Ý£©
		
		$arr=explode('-- <xjx> --', $str);
		//echo count($arr); //×îºóÒ»¸öÔªËØÖµÎª¿Õ
		$index2=0;
		for($j=0;$j<count($arr)-1;$j++){
			if(mysql_query($arr[$j])){
				$index2++;
			}
		}
		
		$rs = $index1==$i && $index2==$j ;
		
		return $rs;  
    }

    /**
     * Á¬½ÓÊý¾Ý¿â ...
     */
    

    /**
     * ËùÓÐ±íÃû³Æ
     */
   public function tblist() {
		
        $list=array();
        $rs=mysql_query("SHOW TABLES FROM $this->database");
        while ($temp=mysql_fetch_row($rs)) {
            $list[]=$temp[0];
        }

        return $list;
    }
    
    /**
    *ËùÓÐ±íµÄÊôÐÔ¼¯ºÏ
    */
   public function tbdesc(){
        $list="";
        $index=0;
        $rs=mysql_query("SHOW TABLE STATUS FROM $this->database");
        while ($temp=mysql_fetch_row($rs)) {
            $list[$index][0]=$temp[0];  //±íÃû
            $list[$index][1]=$temp[1];  //±íÒýÇæ
            $list[$index][2]=$temp[4];  //¼ÇÂ¼Êý
            $list[$index][3]=$temp[6];  //±í´óÐ¡
            $list[$index][4]=$temp[11]; //´´½¨Ê±¼ä
            $list[$index][5]=$temp[12]; //×îºóÒ»´Î¸üÐÂÊ±¼ä
            $list[$index][6]=$temp[14]; //±í±àÂë
            $list[$index][7]=$temp[17]; //±íÃèÊö
            $index++;
        }

        return $list;
    }
	
	/**
      * Ö¸¶¨±íÊý×é$tb£¨±íÃû³Æ£©µÄ½á¹¹´´½¨Óï¾ä
    */
   public function sqlcreate($tb) {
        $sql='';
        foreach ($tb as $v) {
            $rs=mysql_query("SHOW CREATE TABLE $v");
            $temp=mysql_fetch_row($rs);
            $sql.="-- ±íµÄ½á¹¹£º{$temp[0]} --\r\n";
            $sql.="{$temp[1]}";
            $sql.=";-- <xjx> --\r\n\r\n";
        }
        return $sql;
    }
	
	/**
      * Ö¸¶¨±íÊý×é$tb£¨±íÃû³Æ£©µÄÊý¾Ý²åÈëÓï¾ä
     */
    public function sqlinsert($tb) {
        $sql='';   
        foreach ($tb as $v) {
            $rs=mysql_query("SELECT * FROM $v");
            if (!mysql_num_rows($rs)) {//ÎÞÊý¾Ý·µ»Ø
                continue;
            }
            $sql.="-- ±íµÄÊý¾Ý£º$v --\r\n";
            $sql.="INSERT INTO `$v` VALUES\r\n";
            while ($temp=mysql_fetch_row($rs)) {
                $sql.='(';
                foreach ($temp as $v2) {
                    if ($v2===null) {
                        $sql.="NULL,";
                    }
                    else {
                        $v2=mysql_real_escape_string($v2);
                        $sql.="'$v2',";
                    }
                }
                $sql=mb_substr($sql, 0, -1);
                $sql.="),\r\n";
            }
            $sql=mb_substr($sql, 0, -3);
            $sql.=";-- <xjx> --\r\n\r\n";
        }
        return $sql;
    }	
	
    /**
     * ËùÓÐ±íµÄ½á¹¹´´½¨Óï¾ä
     */
    public function sqlcreateall() {
        $sql='';

        $tb=$this->tblist();
        foreach ($tb as $v) {
            $rs=mysql_query("SHOW CREATE TABLE $v");
            $temp=mysql_fetch_row($rs);
            $sql.="-- ±íµÄ½á¹¹£º{$temp[0]} --\r\n";
            $sql.="{$temp[1]}";
            $sql.=";-- <xjx> --\r\n\r\n";
        }
        return $sql;
    }

    /**
     * ËùÓÐ±íµÄÊý¾Ý²åÈëÓï¾ä
     */
   public function sqlinsertall() {
        $sql='';

        $tb=$this->tblist();
        foreach ($tb as $v) {
            $rs=mysql_query("SELECT * FROM $v");
            if (!mysql_num_rows($rs)) {//ÎÞÊý¾Ý·µ»Ø
                continue;
            }
            $sql.="-- ±íµÄÊý¾Ý£º$v --\r\n";
            $sql.="INSERT INTO `$v` VALUES\r\n";
            while ($temp=mysql_fetch_row($rs)) {
                $sql.='(';
                foreach ($temp as $v2) {
                    if ($v2===null) {
                        $sql.="NULL,";
                    }
                    else {
                        $v2=mysql_real_escape_string($v2);
                        $sql.="'$v2',";
                    }
                }
                $sql=mb_substr($sql, 0, -1);
                $sql.="),\r\n";
            }
            $sql=mb_substr($sql, 0, -3);
            $sql.=";-- <xjx> --\r\n\r\n";
        }

        return $sql;
    }
}

/*
$dir="dbback";
if(!is_dir($dir)){
	mkdir($dir);
}
$dir="./dbback/";
$dir.= str_replace("-","",date("Y-m-d"));
$dir.= str_replace(":","",date("H:i:s",time()+28800));
//@mkdir($dir);
//±¸·Ý
$x=new dbBackup();
$x->database='tpcp';
$rs=$x->beifen("$dir.sql");
var_dump($rs);
//»¹Ô­
$x=new dbBackup();
$x->database='testwork';
$rs=$x->huanyuan("./dbback/20150213162526.sql");
var_dump($rs);

*/

?>
