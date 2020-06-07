<?php

require_once('config.php');
require_once('template.php');

$tpl->get_tpl('up.htm');
$title = '';
$description = '';
$query = 'SELECT * FROM dumi WHERE id=1';
$stmt = $db->query($query);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$title = $row['t'];
	$description = $row['d'];
}	
$tpl->set_value('title','Категории - ' .$title);          
$tpl->set_value('description','Категории. ' .$description);  
$tpl->set_value('meta','');            

$tpl->tpl_parse();
echo $tpl->html;

require_once('menu.php');

$theFirst = false;
$strFilterExpr = '';
$pagerLink = 'songs.php';
if (isset($_REQUEST['v']) && $_REQUEST['v'] > 0) {
    if ($theFirst == true) {
        $strFilterExpr .= " AND vid =" .$_REQUEST['v'] ." ";
    }
    else {
        $strFilterExpr .= " WHERE vid = " .$_REQUEST['v'] ." ";
        $theFirst = true;
    }
    $pagerLink .= "?v=" .$_REQUEST['v'];
} else {
    $pagerLink .= "?v=0";
}

?>
<div class="contoverall">
	<div class="contall">  
        <div class="call centered paddingupdown">
            <h1 class="centered"><?=GetVid($db, $_REQUEST['v'])?></h1>
<?php 
$songs = '';
$query = "SELECT * FROM products " .$strFilterExpr ." ORDER by id desc";
$records_per_page = 6;
$offset = 0;
if(isset($_GET["page"])) {
	$offset = ($_GET["page"]-1) * $records_per_page;
}
$query2 = $query. " limit " .$records_per_page ." OFFSET " .$offset;
$stmt = $db->query($query2);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
    $videoId = $row['youtube'];
    $videoId = str_replace('https://www.youtube.com/watch?v=','',$videoId);
    $iframe = '<div class="contproduct"><iframe id="' .$row['id'] .'" src="//www.youtube.com/embed/' .$videoId .'" frameborder="0" allowfullscreen allow="autoplay"></iframe><a href="javascript:getPlayed(' .$row['id'] .');" id="link' .$row['id'] .'" class="play">&nbsp;</a></div>';
    $songs .= $iframe;
}
echo($songs);

$self = $pagerLink;
$sign = '?';
if (strpos($self, '?') > -1) {
    $sign = '&';
}
$row_count = $db->query($query)->rowCount();
$pagination = '';			
if($row_count > 0) {
    $totalproducts = ceil($row_count/$records_per_page);
    $currentPage = 1;
    if(isset($_GET["page"])) {
        $currentPage = $_GET["page"];
    }
    if($currentPage != 1) {
        $previous = $currentPage-1;
        if($previous==1) {
            $pagination .= '<a class="page-link" href="' .$self .'">&laquo;</a>';
        }
        else {
            $pagination .= '<a class="page-link" href="' .$self .$sign .'page=' .$previous .'">&laquo;</a>';
        }
    }
    if($currentPage!=$totalproducts) {
        $next = $currentPage+1;
        $pagination .= '<a class="page-link" href="' .$self .$sign .'page=' .$next .'">&raquo;</a>';
    }
}
if ($row_count > $records_per_page) {
    $pagination = '<div class="text-center"><ul class="pagination justify-content-center">' .$pagination .'</ul></div>';
    echo $pagination;
}

?>
<script>
    function getPlayed(videoid) {
        fetch('login.php?playid=' + videoid, {method:'get'});
        var isAutoplay = false;
        if (document.getElementById(videoid).src.includes('?autoplay=1')) {
            document.getElementById(videoid).src = document.getElementById(videoid).src.replace('?autoplay=1','');
        } else {
            document.getElementById(videoid).src += "?autoplay=1";
            document.getElementById("link" + videoid).style.display="none";
        }
    }
</script>
        </div>

        
   </div>
</div>


<?php
require_once('down.php');
?>