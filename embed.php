<?php
/*
Plugin Name: DirtySuds - Embed PDF
Plugin URI: http://dirtysuds.com
Description: Embed a PDF using Google Docs Viewer
Author: Pat Hawks
Version: 1.01
Author URI: http://www.pathawks.com

Updates:
1.01 20110303 - Added support for class and ID attributes
1.00 20110224 - First Version

  Copyright 2011 Pat Hawks  (email : pat@pathawks.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

wp_embed_register_handler( 'pdf', '#(^(http|wpurl)\:\/\/.+\.pdf$)#i', 'wp_embed_handler_pdf' );

function wp_embed_handler_pdf( $matches, $atts, $url, $rawattr ) {
	extract( shortcode_atts( array(
		'height' => get_option('embed_size_h'),
		'width' => get_option('embed_size_w'),
		'border' => '',
		'style' => '',
		'title' => '',
		'class' => 'pdf',
		'id' => '',
	), $atts ) );

	$url = str_replace('wpurl://',get_bloginfo('wpurl').'/',$url);

	$embed = '<iframe src="http://docs.google.com/viewer?url='.urlencode($url).'&amp;embedded=true" style="height:'.$height.'px;width:'.$width.'px;" class="'.$class.'"';
	if ($id) {
		$embed .= ' id="'.$id.'"';
	}
	if ($border) {
		$embed .= ' frameborder="'.$border.'"';
	}
	if ($style) {
		$embed .= ' style="'.$style.'"';
	}
	if ($title) {
		$embed .= ' title="'.$title.'"';
	}
	$embed .= '></iframe>';

	return apply_filters( 'embed_pdf', $embed, $matches, $attr, $url, $rawattr  );
}