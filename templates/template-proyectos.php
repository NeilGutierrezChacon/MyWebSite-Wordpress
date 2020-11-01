<?php

/*
Template Name: Template - Proyectos
*/

get_header();


$args = array(
	'post_type' => 'projects',
	/* 'posts_per_page' => 8, */
);
$query = new WP_Query( $args );
$projects = $query->posts;

?>

	<section class="page-projects container-fluid">
    <!-- Title -->
    <div class="row">
      <div class="col-sm-12 col-xl-12">
        <h1 class="text-center">¡WELCOME TO MY PROJECTS!</h1>
        <p class="text-center">Take a look at the jobs that I develop or am developing.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-center mb-4">Search by categories</h2>
      </div>
      <div class="col-sm-12">
        <div class="group-categories">
          <button class="btn btn-categorie">Html</button>
          <button class="btn btn-categorie">Css</button>
          <button class="btn btn-categorie">JavaScript</button>
          <button class="btn btn-categorie">NodeJs</button>
          <button class="btn btn-categorie">Bootstrap</button>
          <button class="btn btn-categorie">Angular</button>
          <button class="btn btn-categorie">MongoDB</button>
        </div>    
      </div>
      <div class="col-sm-12">
        <div class="nav-search">
          <form action="/projects" method="GET">
            <div class="input-group my-4">
              <input name="title" type="text" class="form-control" placeholder="Write a project" aria-label="Write a project" aria-describedby="button-search">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-search"><i class="fas fa-search fa-lg"></i><span>Search</span> </button>
              </div>
            </div>
          </form>
        </div>  
      </div>
    </div>
		<!-- Featured project -->
    <div class="row">
      <div class="col-12 p-0">
        <div class="card-deck-projects">
          <?php
            foreach ($projects as $key => $project) {
              include(locate_template('template-parts/cart-project.php'));
            }
          ?>
        </div>
      </div>
    </div>
	</section>

<?php

get_footer(); 

?>