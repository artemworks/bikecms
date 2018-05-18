<?php
class Utilities{
 
    public function getPages($page, $total_rows, $obj_per_page, $page_url){
 
        $p_array=array();
 
        $p_array["first"] = $page>1 ? "{$page_url}page=1" : "";
 
        $total_pages = ceil($total_rows / $obj_per_page);
 
        $range = 2;
 
        $initial_num = $page - $range;
        $condition_limit_num = ($page + $range)  + 1;
 
        $p_array['pages']=array();
        $page_count=0;
         
        for($x=$initial_num; $x<$condition_limit_num; $x++){


            if(($x > 0) && ($x <= $total_pages)){
                $p_array['pages'][$page_count]["page"]=$x;
                $p_array['pages'][$page_count]["url"]="{$page_url}page={$x}";
                $p_array['pages'][$page_count]["current_page"] = $x==$page ? "yes" : "no";
 
                $page_count++;
            }
        }
 
        $p_array["last"] = $page<$total_pages ? "{$page_url}page={$total_pages}" : "";
 
        return $p_array;
    }
 
}
?>