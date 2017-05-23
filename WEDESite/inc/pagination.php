<?php

include_once('constants.php');
include_once('functions.php');
include_once('db.php');

function pagination($totalRecords, $maxItemsPage, $page = 1, $url = '?'){
	$total = $totalRecords;
	$adjacents = "2"; 
	$page = ($page == 0 ? 1 : $page);  
	$start = ($page - 1) * $maxItemsPage;								
	$prev = $page - 1;							
	$next = $page + 1;
	$lastpage = ceil($total/$maxItemsPage);
	$lpm1 = $lastpage - 1;
	$pagination = "";	

	if($lastpage > 1){	
		$pagination .= "<ul class='pagination'>";
		if ($page < $lastpage - 1){ 
			$pagination.= "<li><a href='{$url}page/$next/'>Next</a></li>";
		}else{
			$pagination.= "<li><a class='current'>Next</a></li>";
		}
		// $pagination .= "<li>Page $page of $lastpage</li>";
		if ($lastpage < 7 + ($adjacents * 2)){	
			for ($counter = 1; $counter <= $lastpage; $counter++){
				if($counter == $page){
					$pagination.= "<li><a class='current'>$counter</a></li>";
				}else{
					if($counter == 1){
						$pagination.= "<li><a href='{$url}'>$counter</a></li>";
					}else{
						$pagination.= "<li><a href='{$url}page/$counter/'>$counter</a></li>";
				  }
				}
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2)){
			if($page < 1 + ($adjacents * 2)){
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
					if($counter == $page){
						$pagination.= "<li><a class='current'>$counter</a></li>";
					}else{
						if($counter == 1){
							$pagination.= "<li><a href='{$url}'>$counter</a></li>";
						}else{
							$pagination.= "<li><a href='{$url}page/$counter/'>$counter</a></li>";
						}
					}
				}
				$pagination.= "<li class='dot'>...</li>";
				$pagination.= "<li><a href='{$url}page/$lpm1/'>$lpm1</a></li>";
				$pagination.= "<li><a href='{$url}page/$lastpage/'>$lastpage</a></li>";		
			}elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){
				$pagination.= "<li><a href='{$url}page/1/'>1</a></li>";
				$pagination.= "<li><a href='{$url}page/2/'>2</a></li>";
				$pagination.= "<li class='dot'>...</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){
					if($counter == $page){
						$pagination.= "<li><a class='current'>$counter</a></li>";
					}else{
						if($counter == 1){
							$pagination.= "<li><a href='{$url}'>$counter</a></li>";
						}else{
							$pagination.= "<li><a href='{$url}page/$counter/'>$counter</a></li>";
						}
					}
				}
				$pagination.= "<li class='dot'>..</li>";
				$pagination.= "<li><a href='{$url}page/$lpm1/'>$lpm1</a></li>";
				$pagination.= "<li><a href='{$url}page/$lastpage/'>$lastpage</a></li>";		
			}else{
				$pagination.= "<li><a href='{$url}page/1/'>1</a></li>";
				$pagination.= "<li><a href='{$url}page/2/'>2</a></li>";
				$pagination.= "<li class='dot'>..</li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){
					if ($counter == $page){
						$pagination.= "<li><a class='current'>$counter</a></li>";
					}else{
						if($counter == 1){
							$pagination.= "<li><a href='{$url}'>$counter</a></li>";
						}else{
							$pagination.= "<li><a href='{$url}page/$counter/'>$counter</a></li>";
						}
					}
				}
			}
		}	 
		if ($page < $counter - 1){ 
			$pagination.= "<li><a href='{$url}page/$lastpage/'>Last</a></li>";
		}else{
			$pagination.= "<li><a class='current'>Last</a></li>";
		}
		$pagination.= "</ul>\n";		
	}
	return $pagination;
}

echo pagination(55, 10);
?>