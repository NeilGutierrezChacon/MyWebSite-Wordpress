<?php
$image_destacada = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'single-post-thumbnail')[0];
$post_modified = explode(' ',$post->post_modified)[0];
?>
<div class="post-most-seen"
>
  <a href="<?= $post->guid ?>">
    <img width="110" height="110" src="<?= $image_destacada ?>" alt="Provisional image">
  </a>
  
  <div class = "cont-text">
    <a href="<?= $post->guid ?>">
      <div class="post-content">
          <?= $post->post_content ?>
      </div>
    </a>
    <span class="date"><?= $post_modified ?></span>
  </div>
</div>
