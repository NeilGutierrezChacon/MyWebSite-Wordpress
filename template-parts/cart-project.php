<?php

$image_destacada = wp_get_attachment_image_src(get_post_thumbnail_id($project->ID),'single-post-thumbnail')[0];
$github_link = get_field('github',$project->ID);
$website_link = get_field('website',$project->ID);

?>

<div
  class="card mt-4 card-project"
>
  <div class="cont-img-top">
    <a href="<?= $project->guid ?>">
      <img
      src="<?= ($image_destacada) ? $image_destacada: '/img/img_not_found.png'  ?>"
      class="card-img-top"
      alt="Image of the project"
      />
    </a>
  </div>
  
  
  <div class="card-body">
    
    <h4 class="card-title">
      <a href="<?= $project->guid ?>">
        <?= $project->post_title ?>
      </a>
    </h4>

    <h6 class="card-subtitle mb-2 text-muted">
      Update: <?= $project->post_modified ?>
    </h6>
    <a href="<?= $github_link ?>" class="card-link text-info">GitHub</a>
    <a href="<?= $website_link ?>" class="card-link text-info">WebSite</a>

    <div class="card-text delta delta-summary">
      <?= $project->post_content ?>
    </div>
  </div>
</div>
