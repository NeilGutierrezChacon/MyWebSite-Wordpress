<?php


/* $github_link = get_field('github',$project->ID);
$website_link = get_field('website',$project->ID); */

?>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php
            foreach ($posts as $key => $post) {
                $image_destacada = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'single-post-thumbnail')[0];
               
        ?>
            <div class="swiper-slide">
                <img src="<?= $image_destacada ?>" alt="Featured image of the post">
                <span class="date"><?= $post->post_modified ?></span>
                <h6 class="text-center">
                    <a href="<?= $post->guid ?>">
                        <?= $post->post_title ?>
                    </a>
                </h6>
            </div>
        <?php
            }
        ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>