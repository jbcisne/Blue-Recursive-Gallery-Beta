<?php
include("functions.inc.php");
$localpath="/storage.local/shared/www/BlueGallery/";
$path = realpath('img01');
$filter=$_REQUEST['filter'];

// DROP DOWN MENU
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename)
{
      $imgsrc=str_replace($localpath,"",$filename);
      if((strpos($imgsrc,'._') !== false OR strpos($imgsrc,'.DS_Store') !== false) OR (strpos($imgsrc,'..') !== false OR !strpos($imgsrc,'.jpg') ) ){
	}else{
	    // verificado a data do metada da imagem e organizo no dropdown
	    $created_file=get_file_datetime($imgsrc);
	    $created_file=explode(" ",$created_file);
	    $created_file=($created_file[0]);
	    //$files[] = '<option value="'.$created_file.'">'.$created_file.'</option>';
	    $files2[]=$created_file;
	}
}
$novo_array = array_unique($files2);
foreach($novo_array as $data){
      $files3[]='<option value="'.$data.'">'.$data.'</option>';
}
$options = implode('',$files3);
?>
<!--
                                                                                                          
           8 8888       .8.           ,o888888o.        ,o888888o.        ,o888888o.     b.             8 
           8 8888      .888.         8888     `88.     8888     `88.   . 8888     `88.   888o.          8 
           8 8888     :88888.     ,8 8888       `8. ,8 8888       `8. ,8 8888       `8b  Y88888o.       8 
           8 8888    . `88888.    88 8888           88 8888           88 8888        `8b .`Y888888o.    8 
           8 8888   .8. `88888.   88 8888           88 8888           88 8888         88 8o. `Y888888o. 8 
           8 8888  .8`8. `88888.  88 8888           88 8888           88 8888         88 8`Y8o. `Y88888o8 
88.        8 8888 .8' `8. `88888. 88 8888           88 8888           88 8888        ,8P 8   `Y8o. `Y8888 
`88.       8 888'.8'   `8. `88888.`8 8888       .8' `8 8888       .8' `8 8888       ,8P  8      `Y8o. `Y8 
  `88o.    8 88'.888888888. `88888.  8888     ,88'     8888     ,88'   ` 8888     ,88'   8         `Y8o.` 2013
    `Y888888 ' .8'       `8. `88888.  `8888888P'        `8888888P'        `8888888P'     8            `Yo 

-->
<html>
<head>
<style>
body{margin:0 0 0 0;}
ul li{
float: left;
margin: 5px;
}
img{
box-shadow: 2px 2px 5px #333;
}
.header{background: #000;width:100%;height:35px;padding:10px;}
.header_left{float: left;width: 200px;}
.filter_bt{padding: 5px;background: #000;color:#fff;border:0;border-radius: 3px;}
.header_logo{font-size:30px;color: #fff;font-family:arial;}
</style>
</head>
<body>
<div class="container">
      <div class="header">
	    <div class="header_left">
		 <span class="header_logo">HBR</span>
	    </div>
	    
	    <div class="header_right">
		  <form>
			<select name="filter" class="filter_dropdown">
			      <option value="">Desabilitar filtro</option>
			      <?= $options;?>
			</select>
			<input type="submit" name="Filtrar" value="Filtrar" class="filter_bt" />
		  </form>
	    </div>
      </div>
      
      <ul>
	    <?php
	    if(empty($filter)){
		  // without filter
		 foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename)
		  {
			$imgsrc=str_replace($localpath,"",$filename);
			if((strpos($imgsrc,'._') !== false OR strpos($imgsrc,'.DS_Store') !== false) OR (strpos($imgsrc,'..') !== false OR !strpos($imgsrc,'.jpg') ) ){
			  }else{
			      echo '<li>
				    <a href="'.$imgsrc.'"><img src="'."thumb.php?src=".$imgsrc."&w=150&h=95&rcz".'" /></a>
				    <div style="font-size:13px;font-family:arial;z-index:99999;position:absolute;margin:-25px 10px;color:#fff;text-shadow:1px 1px 1px #000;">'.get_file_datetime($imgsrc).'</div>
			      </li>';
				 
			  }
		  } 
	    }else{
		  // with filter
		  foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename)
		  {
			$imgsrc=str_replace($localpath,"",$filename);
			
			// data para filtrar imagens por meta-dado
			$img_date=get_file_datetime($imgsrc);
			$img_date=explode(" ",$img_date);
			$img_date=($img_date[0]);
			
			if((strpos($imgsrc,'._') !== false OR strpos($imgsrc,'.DS_Store') !== false) OR (strpos($imgsrc,'..') !== false OR !strpos($imgsrc,'.jpg') )){
			      // nothing to do here
			  }else{
			      // get only the filtered images
			      if($img_date == $filter){
				    echo '<li>
				    <a href="'.$imgsrc.'"><img src="'."thumb.php?src=".$imgsrc."&w=150&h=95&rcz".'" /></a>
				    <div style="font-size:13px;font-family:arial;z-index:99999;position:absolute;margin:-25px 10px;color:#fff;text-shadow:1px 1px 1px #000;">'.get_file_datetime($imgsrc).'</div>
				    </li>';
			      }
			  }
		  } 
	    }
	    ?>
      </ul>
</div>
</body>
</html>
