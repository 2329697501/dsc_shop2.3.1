<?php
//dezend by  QQ:2172298892
function encode_output($str)
{
	if (EC_CHARSET != 'utf-8') {
		$str = ecs_iconv(EC_CHARSET, 'utf-8', $str);
	}

	return htmlspecialchars($str);
}

function get_wap_pager($num, $perpage, $curr_page, $mpurl, $pvar)
{
	$multipage = '';

	if ($perpage < $num) {
		$page = 2;
		$offset = 1;
		$pages = ceil($num / $perpage);
		$all_pages = $pages;
		$tmp_page = $curr_page;
		$setp = (strpos($mpurl, '?') === false ? '?' : '&amp;');

		if (1 < $curr_page) {
			$multipage .= '<a href="' . $mpurl . $setp . $pvar . '=' . ($curr_page - 1) . '">上一页</a>';
		}

		$multipage .= $curr_page . '/' . $pages;

		if ($curr_page++ < $pages) {
			$multipage .= '<a href="' . $mpurl . $setp . $pvar . '=' . $curr_page++ . '">下一页</a><br/>';
		}

		$url_array = explode('?', $mpurl);
		$field_str = '';

		if (isset($url_array[1])) {
			$filed_array = explode('&amp;', $url_array[1]);

			if (0 < count($filed_array)) {
				foreach ($filed_array as $data) {
					$value_array = explode('=', $data);
					$field_str .= '<postfield name=\'' . $value_array[0] . '\' value=\'' . encode_output($value_array[1]) . "'/>\n";
				}
			}
		}

		$multipage .= '跳转到第<input type=\'text\' name=\'pageno\' format=\'*N\' size=\'4\' value=\'\' maxlength=\'2\' emptyok=\'true\' />页<anchor>[GO]<go href=\'' . $url_array[0] . '\' method=\'get\'>' . $field_str . '<postfield name=\'' . $pvar . '\' value=\'$(pageno)\'/></go></anchor>';
	}

	return $multipage;
}

function get_footer()
{
	if (substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/')) == '/index.php') {
		$footer = '<br/>Powered by ECShop[' . local_date('H:i') . ']';
	}
	else {
		$footer = '<br/><select><option onpick=\'index.php\'>快速通道</option><option onpick=\'goods_list.php?type=best\'>精品推荐</option><option onpick=\'goods_list.php?type=promote\'>商家促销</option><option onpick=\'goods_list.php?type=hot\'>热门商品</option><option onpick=\'goods_list.php?type=new\'>最新产品</option></select>';
	}

	return $footer;
}

if (!defined('IN_ECS')) {
	exit('Hacking attempt');
}

?>
