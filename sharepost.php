<?php
/*
Plugin Name: Share Post Shortcode
Plugin URI: http://daisukeblog.com/
Description: This is a shortcode in post content which enables you to share your favorite posts with url only.
Version: 0.2
Author: hondamarlboro
Author URI: http://daisukeblog.com/
License: GPLv2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

function sharepost_shortcode($atts){
	extract(shortcode_atts(array(
		'url' => 'http://www.google.co.jp',
		'img' => 'true',
		'hatebu' => 'true',
	), $atts));
	
	if($url) {
		$title = getPageTitle( $url );
		
		if($img == 'true') {
			$image = '<img style="border:0px;margin:0px;padding:0px 20px 0px 0px" class="alignleft" src="http://capture.heartrails.com/200x150?'.$url.'" alt="" width="100" height="75">';
		} else {
			$image = '';
		}
		
		if($hatebu == 'true') {
			$hatena = '<a href="http://b.hatena.ne.jp/entry/'.$url.'" target="_blank"><img src="http://b.hatena.ne.jp/entry/image/'.$url.'" alt="" /></a>';
		} else {
			$hatena = '';
		}

		$html = '<div style="margin:0px 10px 0px 10px;border:1px solid #ededed;padding:10px">'.$image.'<a href="'.$url.'" target="_blank">'.$title.'</a>'.' '.$hatena.'<br style="clear:both;" /></div>';

		return $html;
	}
	else {
		return '';
	}
}

function getPageTitle( $share ) {
    $html = file_get_contents($share);
    $html = mb_convert_encoding($html, mb_internal_encoding(), "ASCII,JIS,UTF-8,EUC-JP,SJIS" );
    if ( preg_match( "/<title>(.*?)<\/title>/i", $html, $matches) ) {
        return $matches[1];
    } else {
        return false;
    }
}

add_shortcode('sharepost','sharepost_shortcode');
?>