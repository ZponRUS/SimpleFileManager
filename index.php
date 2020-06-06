<?
$path = @$_GET["path"] or $path = __DIR__;
$s = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>File Manager</title>
	<style type="text/css">
		body{
			background: #ccc;
		}
		.block{
			background: #ddd;
			width: 40%;
			text-align: left;
		}		
	</style>
</head>
<body>
	<center>
		<h1>File Manager</h1>
		<div class="block">
			<?
				if(is_dir($path)){
					$dir = scandir($path);
					for ($i=0; $i < count($dir); $i++) { 
						print("<a href=".$s."?path=".$path."/".$dir[$i].">".$dir[$i]."<br>");
					}
				}else{
					print("<h2 style='text-align: center;'>".pathinfo($path)["basename"]."</h2>");

					$ext = strtolower(pathinfo($path)["extension"]);
					if(in_array($ext, array("png", "jpg", "jpeg", "gif", "bmp"))){
						$imgdata = base64_encode(file_get_contents($path));
						print("<img style='width: 100%;' src='data:image/".$ext.";base64, ".$imgdata."'>");
					}

				}

			?>
		</div>
	</center>
</body>
</html>
