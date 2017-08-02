<?php

/**
* A kirbytag for embedding HTML5-videos by @wottpal featuring:
*  - lazyloading
*  - preview-color which fades out on load
*  - img/gif fallback
*
* @package   Kirby CMS
* @author    Dennis Kerzig <hi@wottpal.com>
* @version   0.1.0
*
*/


// Dynamic Tagname
$tagname = c::get('video.kirbytext.tagname', 'video');

$kirby->set('tag', $tagname, [
  'attr' => [
    'color',
    'options',
    'preset',
    'width',
    'height'
  ],
  'html' => function($tag) use ($tagname) {

    // Options
    $name = $tag->attr($tagname);
    $class = c::get('video.kirbytext.class', '');
    $width = $tag->attr('width');
    $height = $tag->attr('height');
    $given_color = $tag->attr('color');
    $default_color = c::get('video.kirbytext.default.color', '#fff');
    $presets = array_merge([
      'default' => 'lazyload controls',
      'gif' => 'lazyload autoplay loop muted playsinline'
    ], c::get('video.kirbytext.merge.presets', []));
    $preset = $tag->attr('preset');
    $preset_is_valid = array_key_exists($tag->attr('preset'), $presets);
    $options = $preset_is_valid ? $presets[$preset] : $tag->attr('options', $presets['default']);
    $video_types = c::get('video.kirbytext.video.types', [
      'webm' => 'video/webm; codecs="vp9"',
      'mp4' => 'video/mp4',
      'ogg' => 'video/ogg'
    ]);
    $image_formats = c::get('video.kirbytext.image.formats', ['gif', 'jpeg', 'jpg', 'png']);

    // Gather video-files
    $videos = [];
    foreach ($video_types as $format => $type) {
      $file = $tag->file("${name}.${format}");
      if ($file) $videos[$format] = $file;
    }

    // Gather available image-files and some metadata (dominant-color, dimension)
    $image = null;
    $images = [];
    $dominant_color = null;
    $dimensions = null;
    foreach ($image_formats as $format) {
      $file = $tag->file("${name}.${format}");
      if ($file) {
        $images[$format] = $file;
        if ($image == null) $image = $file;
        if ($dimensions == null) $dimensions = explode('×', $file->dimensions());
        if ($file->color()) $dominant_color = $file->color();
      }
    }

    // Determine Preview-Color
    // Policy: Color-Attr > Dominant-Color (http://bit.ly/2wkWi8L) > Default-Color
    $color = null;
    $given_color = $tag->attr('color');
    $pattern = "/[#]([\dA-F]{6}|[\dA-F]{3})/i";
    if ($dominant_color && preg_match($pattern, $dominant_color)) $color = $dominant_color;
    if ($given_color && preg_match($pattern, $given_color)) $color = $given_color;
    if (!$color) $color = $default_color;


    // Determine Sizing (Use file-dimensions if neither w. nor h. are given)
    if (!$width && !$height) {
      $width = $dimensions[0] . "px";
      $height = $dimensions[1] . "px";
    }
    $size_style = "width:${height};height:${height};";


    // Embed <video>, but only if at least one video-file is given
    if (!empty($videos)) {

      $video_html = tpl::load(__DIR__ . DS . 'template.php', [
        'use_figure' => true,
        'class' => $class,
        'size_style' => $size_style,
        'lazy' => strpos($options, 'lazyload') !== false,
        'options' => $options,
        'videos' => $videos,
        'video_types' => $video_types,
        'image' => $image,
        'color' => $color,
      ], true);

      return html($video_html);
    }

  }
]);


/**
 * Returns true if the given value if the given string is:
 *  - just a number or
 *  - px, rem, em, ch, vw, vh, vmin, vmax
 */
