
<?php e($use_figure, "<figure class='html-video ${class}' style='${figure_style}'>") ?>
  
  <!-- Video -->
  <video <?= $options ?> <?= $video_sizing ?>>

    <?php foreach($videos as $format => $file): ?>
      <source <?php e($lazy, 'data-') ?>src="<?= $file->url() ?>" type='<?= $video_types[$format] ?>'></source>
    <?php endforeach ?>

    <?php if($image): ?>
      <img <?php e($lazy, 'data-') ?>src="<?= $image->url() ?>">
    <?php endif ?>

  </video>

<?php e($use_figure, "</figure>") ?>
