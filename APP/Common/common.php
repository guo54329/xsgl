<?php
    //数据格式转换:主要用于上传和下载时数据格式的转换
	function convertUTF8($str){
	   if(empty($str)) return '';
	   return  iconv('gb2312', 'utf-8', $str);
	}
    //打印：主要用于测试获取的数据是否正常
    function p($arr){
  	   echo '<pre>' .print_r($arr,true).'</pre>';
    }
    
	//附件下载公共函数
	 function downAttach($filepath,$filename){
	    $file= $filepath.$filename;
	    //First, see if the file exists
	    if (!is_file($file)) { die("<b>文件没找到!</b>"); }
	 
	    //Gather relevent info about file
	    $len = filesize($file);
	    $filename = basename($file);
	    $file_extension = strtolower(substr(strrchr($filename,"."),1));
	    
	    //适配各种类型文件
	    switch( $file_extension ) {
	        case 'ai': $ctype='application/postscript'; break;
			case 'aif': $ctype='audio/x-aiff'; break;
			case 'aifc': $ctype='audio/x-aiff'; break;
			case 'aiff': $ctype='audio/x-aiff'; break;
			case 'asc': $ctype='application/pgp'; break;
			case 'asf': $ctype='video/x-ms-asf'; break;
			case 'asx': $ctype='video/x-ms-asf'; break;
			case 'au': $ctype='audio/basic'; break;
			case 'avi': $ctype='video/x-msvideo'; break;
			case 'bcpio': $ctype='application/x-bcpio'; break;
			case 'bin': $ctype='application/octet-stream'; break;
			case 'bmp': $ctype='image/bmp'; break;
			case 'c': $ctype='text/plain'; break;
			case 'cc': $ctype='text/plain'; break;
			case 'cs': $ctype='text/plain'; break;
			case 'cpp': $ctype='text/x-c++src'; break;
			case 'cxx': $ctype='text/x-c++src'; break;
			case 'cdf': $ctype='application/x-netcdf'; break;
			case 'class': $ctype='application/octet-stream'; break;
			case 'com': $ctype='application/octet-stream'; break;
			case 'cpio': $ctype='application/x-cpio'; break;
			case 'cpt': $ctype='application/mac-compactpro'; break;
			case 'csh': $ctype='application/x-csh'; break;
			case 'css': $ctype='text/css'; break;
			case 'csv': $ctype='text/comma-separated-values'; break;
			case 'dcr': $ctype='application/x-director'; break;
			case 'diff': $ctype='text/diff'; break;
			case 'dir': $ctype='application/x-director'; break;
			case 'dll': $ctype='application/octet-stream'; break;
			case 'dms': $ctype='application/octet-stream'; break;
			case 'doc': $ctype='application/msword'; break;
			case 'dot': $ctype='application/msword'; break;
			case 'dotx': $ctype='application/vnd.openxmlformats-officedocument.wordprocessingml.template'; break;
			case 'docx': $ctype='application/vnd.openxmlformats-officedocument.wordprocessingml.document'; break;
			case 'dvi': $ctype='application/x-dvi'; break;
			case 'dxr': $ctype='application/x-director'; break;
			case 'eps': $ctype='application/postscript'; break;
			case 'etx': $ctype='text/x-setext'; break;
			case 'exe': $ctype='application/octet-stream'; break;
			case 'ez': $ctype='application/andrew-inset'; break;
			case 'gif': $ctype='image/gif'; break;
			case 'gtar': $ctype='application/x-gtar'; break;
			case 'gz': $ctype='application/x-gzip'; break;
			case 'h': $ctype='text/plain'; break;
			case 'h++': $ctype='text/plain'; break;
			case 'hh': $ctype='text/plain'; break;
			case 'hpp': $ctype='text/plain'; break;
			case 'hxx': $ctype='text/plain'; break;
			case 'hdf': $ctype='application/x-hdf'; break;
			case 'hqx': $ctype='application/mac-binhex40'; break;
			case 'htm': $ctype='text/html'; break;
			case 'html': $ctype='text/html'; break;
			case 'ice': $ctype='x-conference/x-cooltalk'; break;
			case 'ics': $ctype='text/calendar'; break;
			case 'ief': $ctype='image/ief'; break;
			case 'ifb': $ctype='text/calendar'; break;
			case 'iges': $ctype='model/iges'; break;
			case 'igs': $ctype='model/iges'; break;
			case 'jar': $ctype='application/x-jar'; break;
			case 'java': $ctype='text/x-java-source'; break;
			case 'jpe': $ctype='image/jpeg'; break;
			case 'jpeg': $ctype='image/jpeg'; break;
			case 'jpg': $ctype='image/jpeg'; break;
			case 'js': $ctype='application/x-javascript'; break;
			case 'kar': $ctype='audio/midi'; break;
			case 'latex': $ctype='application/x-latex'; break;
			case 'lha': $ctype='application/octet-stream'; break;
			case 'log': $ctype='text/plain'; break;
			case 'lzh': $ctype='application/octet-stream'; break;
			case 'm3u': $ctype='audio/x-mpegurl'; break;
			case 'man': $ctype='application/x-troff-man'; break;
			case 'me': $ctype='application/x-troff-me'; break;
			case 'mesh': $ctype='model/mesh'; break;
			case 'mid': $ctype='audio/midi'; break;
			case 'midi': $ctype='audio/midi'; break;
			case 'mif': $ctype='application/vnd.mif'; break;
			case 'mov': $ctype='video/quicktime'; break;
			case 'movie': $ctype='video/x-sgi-movie'; break;
			case 'mp2': $ctype='audio/mpeg'; break;
			case 'mp3': $ctype='audio/mpeg'; break;
			case 'mpe': $ctype='video/mpeg'; break;
			case 'mpeg': $ctype='video/mpeg'; break;
			case 'mpg': $ctype='video/mpeg'; break;
			case 'mpga': $ctype='audio/mpeg'; break;
			case 'ms': $ctype='application/x-troff-ms'; break;
			case 'msh': $ctype='model/mesh'; break;
			case 'mxu': $ctype='video/vnd.mpegurl'; break;
			case 'nc': $ctype='application/x-netcdf'; break;
			case 'oda': $ctype='application/oda'; break;
			case 'patch': $ctype='text/diff'; break;
			case 'pbm': $ctype='image/x-portable-bitmap'; break;
			case 'pdb': $ctype='chemical/x-pdb'; break;
			case 'pdf': $ctype='application/pdf'; break;
			case 'pgm': $ctype='image/x-portable-graymap'; break;
			case 'pgn': $ctype='application/x-chess-pgn'; break;
			case 'pgp': $ctype='application/pgp'; break;
			case 'php': $ctype='application/x-httpd-php'; break;
			case 'php3': $ctype='application/x-httpd-php3'; break;
			case 'pl': $ctype='application/x-perl'; break;
			case 'pm': $ctype='application/x-perl'; break;
			case 'png': $ctype='image/png'; break;
			case 'pnm': $ctype='image/x-portable-anymap'; break;
			case 'po': $ctype='text/plain'; break;
			case 'ppm': $ctype='image/x-portable-pixmap'; break;
			case 'ppt': $ctype='application/vnd.ms-powerpoint'; break;
			case 'pptx': $ctype='application/vnd.openxmlformats-officedocument.presentationml.presentation'; break;
			case 'ps': $ctype='application/postscript'; break;
			case 'qt': $ctype='video/quicktime'; break;
			case 'ra': $ctype='audio/x-realaudio'; break;
			case 'rar': $ctype='application/octet-stream'; break;
			case 'ram': $ctype='audio/x-pn-realaudio'; break;
			case 'ras': $ctype='image/x-cmu-raster'; break;
			case 'rgb': $ctype='image/x-rgb'; break;
			case 'rm': $ctype='audio/x-pn-realaudio'; break;
			case 'roff': $ctype='application/x-troff'; break;
			case 'rpm': $ctype='audio/x-pn-realaudio-plugin'; break;
			case 'rtf': $ctype='text/rtf'; break;
			case 'rtx': $ctype='text/richtext'; break;
			case 'sgm': $ctype='text/sgml'; break;
			case 'sgml': $ctype='text/sgml'; break;
			case 'sh': $ctype='application/x-sh'; break;
			case 'shar': $ctype='application/x-shar'; break;
			case 'shtml': $ctype='text/html'; break;
			case 'silo': $ctype='model/mesh'; break;
			case 'sit': $ctype='application/x-stuffit'; break;
			case 'skd': $ctype='application/x-koan'; break;
			case 'skm': $ctype='application/x-koan'; break;
			case 'skp': $ctype='application/x-koan'; break;
			case 'skt': $ctype='application/x-koan'; break;
			case 'smi': $ctype='application/smil'; break;
			case 'smil': $ctype='application/smil'; break;
			case 'snd': $ctype='audio/basic'; break;
			case 'so': $ctype='application/octet-stream'; break;
			case 'spl': $ctype='application/x-futuresplash'; break;
			case 'src': $ctype='application/x-wais-source'; break;
			case 'stc': $ctype='application/vnd.sun.xml.calc.template'; break;
			case 'std': $ctype='application/vnd.sun.xml.draw.template'; break;
			case 'sti': $ctype='application/vnd.sun.xml.impress.template'; break;
			case 'stw': $ctype='application/vnd.sun.xml.writer.template'; break;
			case 'sv4cpio': $ctype='application/x-sv4cpio'; break;
			case 'sv4crc': $ctype='application/x-sv4crc'; break;
			case 'swf': $ctype='application/x-shockwave-flash'; break;
			case 'sxc': $ctype='application/vnd.sun.xml.calc'; break;
			case 'sxd': $ctype='application/vnd.sun.xml.draw'; break;
			case 'sxg': $ctype='application/vnd.sun.xml.writer.global'; break;
			case 'sxi': $ctype='application/vnd.sun.xml.impress'; break;
			case 'sxm': $ctype='application/vnd.sun.xml.math'; break;
			case 'sxw': $ctype='application/vnd.sun.xml.writer'; break;
			case 't': $ctype='application/x-troff'; break;
			case 'tar': $ctype='application/x-tar'; break;
			case 'tcl': $ctype='application/x-tcl'; break;
			case 'tex': $ctype='application/x-tex'; break;
			case 'texi': $ctype='application/x-texinfo'; break;
			case 'texinfo': $ctype='application/x-texinfo'; break;
			case 'tgz': $ctype='application/x-gtar'; break;
			case 'tif': $ctype='image/tiff'; break;
			case 'tiff': $ctype='image/tiff'; break;
			case 'tr': $ctype='application/x-troff'; break;
			case 'tsv': $ctype='text/tab-separated-values'; break;
			case 'txt': $ctype='text/plain'; break;
			case 'ustar': $ctype='application/x-ustar'; break;
			case 'vbs': $ctype='text/plain'; break;
			case 'vcd': $ctype='application/x-cdlink'; break;
			case 'vcf': $ctype='text/x-vcard'; break;
			case 'vcs': $ctype='text/calendar'; break;
			case 'vfb': $ctype='text/calendar'; break;
			case 'vrml': $ctype='model/vrml'; break;
			case 'vsd': $ctype='application/vnd.visio'; break;
			case 'wav': $ctype='audio/x-wav'; break;
			case 'wax': $ctype='audio/x-ms-wax'; break;
			case 'wbmp': $ctype='image/vnd.wap.wbmp'; break;
			case 'wbxml': $ctype='application/vnd.wap.wbxml'; break;
			case 'wm': $ctype='video/x-ms-wm'; break;
			case 'wma': $ctype='audio/x-ms-wma'; break;
			case 'wmd': $ctype='application/x-ms-wmd'; break;
			case 'wml': $ctype='text/vnd.wap.wml'; break;
			case 'wmlc': $ctype='application/vnd.wap.wmlc'; break;
			case 'wmls': $ctype='text/vnd.wap.wmlscript'; break;
			case 'wmlsc': $ctype='application/vnd.wap.wmlscriptc'; break;
			case 'wmv': $ctype='video/x-ms-wmv'; break;
			case 'wmx': $ctype='video/x-ms-wmx'; break;
			case 'wmz': $ctype='application/x-ms-wmz'; break;
			case 'wrl': $ctype='model/vrml'; break;
			case 'wvx': $ctype='video/x-ms-wvx'; break;
			case 'xbm': $ctype='image/x-xbitmap'; break;
			case 'xht': $ctype='application/xhtml+xml'; break;
			case 'xhtml': $ctype='application/xhtml+xml'; break;
			case 'xls': $ctype='application/vnd.ms-excel'; break;
			case 'xlt': $ctype='application/vnd.ms-excel'; break;
			case 'xlsx': $ctype='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'; break;
			case 'xml': $ctype='application/xml'; break;
			case 'xpm': $ctype='image/x-xpixmap'; break;
			case 'xsl': $ctype='text/xml'; break;
			case 'xwd': $ctype='image/x-xwindowdump'; break;
			case 'xyz': $ctype='chemical/x-xyz'; break;
			case 'z': $ctype='application/x-compress'; break;
			case 'zip': $ctype='application/zip'; break;

	 
	      default: $ctype="application/force-download";
	    }
	     
	    ob_end_clean();//清除缓冲区,避免乱码
	    ob_clean();
	    //Begin writing headers
	    header("Pragma: public");
	    header("Expires: 0");
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Cache-Control: public"); 
	    header("Content-Description: File Transfer");
	     
	    //Use the switch-generated Content-Type
	    header("Content-Type: $ctype");
	        header("Content-Type: application/force-download"); //默认的下载方式
	        //header("Content-Type: application/octet-stream");
	        header("Content-Type: application/download");
	    $header="Content-Disposition: attachment; filename=".$filename.";";
	    header($header );
	    header("Content-Transfer-Encoding: binary");
	    header("Content-Length: ".$len);
	    @readfile($file);
	    exit;
	 }
	 /**
	 * 获取客户端浏览器类型
	 * @param  string $glue 浏览器类型和版本号之间的连接符
	 * @return string|array 传递连接符则连接浏览器类型和版本号返回字符串否则直接返回数组 false为未知浏览器类型
	 */
	function get_client_browser($glue = null) {
	    $browser = array();
	    $agent = $_SERVER['HTTP_USER_AGENT']; //获取客户端信息
	    
	    /* 定义浏览器特性正则表达式 */
	    $regex = array(
	        'ie'      => '/(MSIE) (\d+\.\d)/',
	        'chrome'  => '/(Chrome)\/(\d+\.\d+)/',
	        'firefox' => '/(Firefox)\/(\d+\.\d+)/',
	        'opera'   => '/(Opera)\/(\d+\.\d+)/',
	        'safari'  => '/Version\/(\d+\.\d+\.\d) (Safari)/',
	    );
	    foreach($regex as $type => $reg) {
	        preg_match($reg, $agent, $data);
	        if(!empty($data) && is_array($data)){
	            $browser = $type === 'safari' ? array($data[2], $data[1]) : array($data[1], $data[2]);
	            break;
	        }
	    }
	    return empty($browser) ? false : (is_null($glue) ? $browser : implode($glue, $browser));
	}

?>