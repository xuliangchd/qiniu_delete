<?php
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo "七牛云<br>";
require_once('qiniu/rsf.php');

//bucket
$bucket = 'nnn';
//accessKey
$accessKey = '-_';
//secretKey
$secretKey = 'H5_06_iPMpP6KwrCPA8zx8u2PvVn94dM8y9FI75X';
//删除条数
$limit = 200;

$marker = '';
Qiniu_setKeys($accessKey, $secretKey);

$client = new Qiniu_MacHttpClient(null);

$files = Qiniu_RSF_ListPrefix($client,$bucket,'',$marker,$limit);
echo "<hr>查找文件<br>";
echo "<pre>";
var_dump($files);

require_once('qiniu/rs.php');
if(count($files[0]) > 0){
	foreach ($files[0] as $key => $file) {
		$entries[] = new Qiniu_RS_EntryPath($bucket, $file['key']);
	}

	list($ret, $err) = Qiniu_RS_BatchDelete($client, $entries);
	echo "<hr>删除中<br>";
	if ($err !== null) {
		echo "<pre>";
		var_dump($err);
	} else {
		echo "<pre>";
		var_dump($ret);
	}
	?>
	<script type="text/javascript">
	function reflash()
	{
	    window.location.reload();
	}
	window.onload = setTimeout(reflash,1000);
	</script>
<?php
}
?>