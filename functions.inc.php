<?php

// verificar o data e hora de criacao de um arquivo
function get_file_datetime($filename){
   $exif = exif_read_data($filename, 0, true);
   $timestamp=$exif['FILE']['FileDateTime'];
   return gmdate("d/m/Y H:i:s ",$timestamp);
}

// gera galeria de imagens de um determinado diretorio
function jessica_img_gallery($uploads){
   if ($dir = opendir($uploads)) {
	$images = array();
	while (false !== ($file = readdir($dir))) {
		if ($file != "." && $file != ".." & $file != "._") {
			$images[] = $file; 
		}
	}
	closedir($dir);
   }
   
   // generate images
   foreach($images as $image) {
	if(strpos($image,'._') !== false){
	}else{
		echo '<li>
			<a href="'.$uploads.$image.'"><img src="'."thumb.php?src=".$uploads.$image."&w=300&h=180&rcz".'" /></a>
			<div style="font-size:13px;font-family:arial;z-index:99999;position:absolute;margin:-25px 10px;color:#fff;">'.get_file_datetime($uploads.$image).'</div>
		     </li>';
	}
   }
}

?>