<?php
$pathToContent="data/cn/data.js";
$data = json_decode(file_get_contents($pathToContent));
$appTitle = $data->title;
$br = "\n";
  
function addPage($catIndex, $catTitle, $catColors, $pagesInCat, $pageIndex, $pageTitle, $items){
  global $appTitle, $br;
  
  $nextPage = $pageIndex+1;
  if ($nextPage>=$pagesInCat) $nextPage=0;
  $prevPage = $pageIndex-1;
  if ($prevPage<0) $prevPage=$pagesInCat-1;
  
  $h =$br.'<div data-role="page" id="page'.$catIndex.'_'.$pageIndex.'" class="page cat'.$catIndex.'">';
  
  $h.=$br.'<div data-role="header" data-position="fixed" class="header">';
  $h.='<h1>'.$appTitle.'</h1>';
  $h.='<a href="#page'.$catIndex.'_'.$prevPage.'" id="prev">Prev</a>';
  $h.='<a href="#page'.$catIndex.'_'.$nextPage.'" id="next">Next</a>';
  $h.='<a href="#catmenu" id="catlink">'.$catTitle.'</a>';
  $h.='<a href="#catmenu" id="catlink">'.$catTitle.'</a>';
  $h.='</div>';
  
  
  $h.=$br.'<div data-role="content" class="content">';
  
  $h.='<div class="belt" style="background-color:'.$catColors[0].'">';
  for ($i=1; $i<count($catColors); $i++){
    $h.='<div style="background-color:'.$catColors[$i].'"></div>';
  }
  $h.='</div>';
  
  $h.=$br.'<h2>'.$pageTitle.'</h2>';
  $h.=$br.'<ul data-role="listview" class="ui-listview">';
  $c = count($items);
  for ($i=0; $i<$c; $i++){
    $h.='<li><span class="label">'.($i+1).': </span><span class="content">'.$items[$i].'</span></li>';
  }
  $h.='</ul>';
  $h.='</div>';
  $h.='</div><!-- page'.$catIndex.'_'.$pageIndex.' -->';
  
  return $h;
}


$pagesHtml = "";
$catMenuHtml = "";
for ($c=0; $c<count($data->cats); $c++){
  $cat = $data->cats[$c];
  
  for ($p=0; $p<count($cat->pages); $p++){
    $page = $cat->pages[$p];
    $pagesHtml .= addPage($c, $cat->title, $cat->colors, count($cat->pages), $p, $page->title, $page->items);
  }
  
  $catMenuHtml .= '<li><a href="#page'.$c.'_0">'.$cat->title.'</a></li>';
}  


?>
<!DOCTYPE html> 
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title><?php echo $data->title; ?></title> 
  <link rel="stylesheet" href="css/jquery.mobile-1.2.0.min.css" />
  <link rel="stylesheet" href="css/styles.css" />
  <script src="js/jquery-1.8.2.min.js"></script>
  <script src="js/jquery.mobile-1.2.0.min.js"></script>
  <script src="js/script.js"></script>
</head> 

  
<body> 

<?php echo $pagesHtml; ?>


<div data-role="page" id="catmenu">

  <div data-role="header" data-theme="e">
    <h1>Choose Cat</h1>
  </div>
  <div data-role="content" data-theme="d">  
    <ul data-role="listview" class="ui-listview">
      <?php echo $catMenuHtml; ?>
    </ul>
  </div>
  
</div>

</body>
</html>