<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文件上传</title>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
.uploadify-button {
background:url(btnbg.PNG ) no-repeat;
border:0px;
border-radius:0;

}
.uploadify:hover .uploadify-button {
background:url(btnbg.PNG )  no-repeat;
border:1px solid #009999;
border-radius:0;
}
</style>
</head>

<body>
	<h1>Uploadify Demo</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file">
		
	</form>

	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : 'uploadify.swf',
				'uploader' : 'uploadify.php',
				'height'   : 30,
				'width'    : 120,
				'buttonText': '',
				'multi'     : false,
				'buttonClass' : 'uploadify-button',
				'fileSizeLimit' : '100KB',
			});
		});
	</script>
</body>
</html>