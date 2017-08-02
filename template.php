
<?php e($use_figure, "<figure class='html-video ${class}' style='${size_style}'>") ?>

  <!-- Video -->
  <video <?= $options ?> width="100%">

    <?php foreach($videos as $format => $file): ?>
      <source <?php e($lazy, 'data-') ?>src="<?= $file->url() ?>" type='<?= $video_types[$format] ?>'></source>
    <?php endforeach ?>

    <?php if($image): ?>
      <img <?php e($lazy, 'data-') ?>src="<?= $image->url() ?>">
    <?php endif ?>

  </video>


  <!-- Color Placeholder -->
  <div class="video-placeholder" style="background: <?= $color ?>"></div>

<?php e($use_figure, "</figure>") ?>
