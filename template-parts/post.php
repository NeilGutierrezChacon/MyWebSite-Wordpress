<?php
$image_destacada = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'single-post-thumbnail')[0];
?>

<div class="post"
>
  <a href="<?= $post->guid ?>">
    <img src="<?= $image_destacada ?>" alt="Provisional image">
  </a>
  <div class = "cont-text">
    <h2 class="display-7 post-title">
      <a href="<?= $post->guid ?>">
        <?= $post->post_title ?>
      </a>
    </h2>
    <span class="date"><?= $post->post_modified ?></span>
    <div class="post-content">
        <?= $post->post_content ?>
    </div>
  </div>
</div>