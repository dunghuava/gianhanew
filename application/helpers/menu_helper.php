<?php
function callMenu($data,$parent=0,$text="|--",$select=0)
{
	foreach($data as $k=>$value){
		if($value['parent_id'] == $parent){
			$id=$value['id'];
			if($select != 0 && $id == $select){
				echo "<option value='$value[id]' selected>".$text.'&nbsp;'.$value['title']."</option>";
			}else{
				echo "<option value='$value[id]'>".$text.'&nbsp;'.$value['title']."</option>";
			}
			unset($data[$k]);
			callMenu($data,$id,$text."|--",$select);
		}
	}
}
if (!function_exists('showMenu')) {
	function showMenu($navigation,$parent = 0,$flag = 'home'){
		if (!empty($navigation) && is_array($navigation)){
            $menu_tmp = array();
            if (!empty($navigation)) {
                foreach ($navigation as $key => $item) {
                    if ((int) $item['parent_id'] == (int) $parent) {
                        $menu_tmp[] = $item;
                        unset($navigation[$key]);
                    }
                }
            }
            $str = '';
            if ($menu_tmp) {
                $str .= "<ul ";
                if ($parent== 0) {
                    $str .= 'id="main-menu" class="nav navbar-nav navbar-left"';
                }else{
                    $str .= 'class="dropdown-menu" role="menu"';
                }
                $str .= ">";
                if($flag == 'home'){
                    $str .= '<li><a rel="nofollow" title="Trang chủ" href="'.base_url().'"><i class="fa fa-home fa-fw"></i></a></li>';
                    $flag = ''; 
                }
                foreach ($menu_tmp as $menu){
                    $str .= '<li class="dropdown">';
                    $str .= '<a class="dropdown-toggle" title="'.$menu['title'].'" href="'.$menu['title_alias'].'">'.$menu['title'].'</a>';
                    $str .= showMenu($navigation,$menu['id'],$flag = '');
                    $str .= "</li>";
                }
                $str .= "</ul>";
            }
            return $str;
        }
    }
}
if (!function_exists('showMenuMobile')) {
    function showMenuMobile($navigation,$parent = 0)
    {
        if (!empty($navigation) && is_array($navigation)){
            $menu_tmp = array();
            if (!empty($navigation)) {
                foreach ($navigation as $key => $item) {
                    if ((int) $item['parent_id'] == (int) $parent) {
                        $menu_tmp[] = $item;
                        unset($navigation[$key]);
                    }
                }
            }
            
            if ($menu_tmp) {
                echo "<ul>";
                foreach ($menu_tmp as $menu){
                    echo '<li>';
                    echo '<a title="'.$menu['title'].'" href="'.$menu['title_alias'].'">'.$menu['title'].'</a>';
                    showMenuMobile($navigation,$menu['id']);
                    echo "</li>";
                }
                echo "</ul>";
            }
        }
    }
}
// FR
if (!function_exists('showUnit')) {
    function showUnit($real_id)
    {
        $CI =& get_instance();
        $unit = $CI->db->select('unit_name')->where('id',$real_id)->get('realestate_units')->row();
        if (!empty($unit)) {
            return $unit->unit_name;
        }
    }
}
if (!function_exists('showDirections')) {
    function showDirections($direction)
    {
        $CI =& get_instance();
        $unit = $CI->db->select('direction_name')->where('id',$direction)->get('realestate_directions')->row();
        if (!empty($unit)) {
            return $unit->direction_name;
        }
    }
}
// Check Disable Post Đang Tin
if (!function_exists('postAgain')) {
    function postAgain($end_date,$id)
    {
        $currentdate = date('Y-m-d');
        $expire_time = date('Y-m-d',strtotime($end_date));
        
        if ($expire_time < $currentdate){
            return 'id="rePost" title="Đăng lại tin !" rel="rePost_'.toPublicId($id).'"';
        }else{
            return 'title="Tin hết hạn mới được đăng lại !"';
        }
    }
}
if (!function_exists('upReal')){
    function upReal($update_at,$realid)
    {
        // Lấy ngày giờ phút giây hiện
        $currentdate = date('Y-m-d H:i:s');
        // Đến thời gian này mới được updated_at
        $update_at   = date('Y-m-d H:i:s',strtotime($update_at.'+24 hours'));
        
        if ($currentdate > $update_at)
        {
            return "<button type='button' class='btn btn-sm btn-manage realUp' data-post='".$realid."' title='Lần up cuối (". date('d-m-Y H:i:s',strtotime($update_at))."). Hãy làm mới tin'><i class='fa fa-upload fa-fw'></i></button>";
        }else{
            $hours = round((strtotime($update_at) - strtotime($currentdate))/(60*60));
            return "<button type='button' class='btn btn-sm btn-manage notRealUp' title='Còn".abs($hours) . "h mới có thể làm mới'><i class='fa fa-upload fa-fw'></i></button>";
        }
    }
}
if (!function_exists('approval')) {
    function approval($approval_id){
        $CI =& get_instance();
        $approval = $CI->db->where('id',$approval_id)->get('approval');
        if ($approval->num_rows() > 0) {
            $name = $approval->row();
            return $name->approval_title;
        }else{
            return false;
        }
    }
}
// encode
if (!function_exists('toPublicId')) {
    function toPublicId($id) {
        return $id * 19872005 + 20051987;
    }
}
// decode
if (!function_exists('toInternalId')) {
    function toInternalId($publicId) {
        return ($publicId - 20051987) / 19872005;
    }
}
if (!function_exists('image_thumb')) {
    function image_thumb($src, $width = 185, $height = 110, $type = 1){
        $url_timthum = PATH_URL . "?src=" .$src . "&w=".$width."&h=".$height."&zc=".$type."&zc=1&q=100";
        return $url_timthum; 
    }
}