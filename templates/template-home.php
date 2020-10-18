<?php

/*
Template Name: Template - Home
*/

get_header();


$args = array(
	'post_type' => 'projects',
	'posts_per_page' => 4,
);
$query = new WP_Query( $args );
$projects = $query->posts;

?>

	<section class="page-home">
		<!-- Jumbotrom -->
		<div class="row">
			<div class="col-sm-12 p-0">
				<div class="image-landing bg-image">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 540">
						<path id="Selección #1"
								fill="#042145" stroke="#042145" stroke-width="1"
								d="M 0.00,0.00
								C 0.00,0.00 1200.00,0.00 1200.00,0.00
									1194.87,36.42 1165.38,77.62 1140.00,103.00
									1102.77,140.23 1066.17,160.65 1019.00,182.31
									1019.00,182.31 991.00,195.58 991.00,195.58
									961.19,208.54 930.82,219.73 900.00,230.00
									824.63,255.12 733.21,277.10 655.00,292.20
									655.00,292.20 567.00,307.80 567.00,307.80
									471.88,326.16 367.62,349.49 275.00,377.28
									220.56,393.61 164.62,413.80 114.00,439.74
									85.85,454.17 58.39,470.40 35.00,491.92
									35.00,491.92 27.17,499.04 27.17,499.04
									19.87,506.76 13.00,514.93 7.43,524.00
									7.43,524.00 0.00,538.00 0.00,538.00
									0.00,538.00 0.00,0.00 0.00,0.00 Z" />
					</svg>
					<div class="jumbotron content-header">
						<h1 class="py-4">NGCH43</h1>
						<p>
							This page has been created to show the projects that I have
							developed or am developing in this way to show my knowledge
							and my way of working
						</p>
						<hr class="my-4" />
						<a
							class="btn btn-primary btn-lg"
							href="/projects"
							role="button"
						>
							See projects
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Features list  -->
        <div class="row block-what-i-do">
          <div class="col-12">
            <h2 class="text-center">¿What i do?</h2>
          </div>
          <div class="col-md-4 col-sm-12">
            <h3 class="text-center mt-4">Education</h3>
            <ul class="list list-education">
              <li>
                <span>Web developer</span><br>
                <span>Instituto Pedralbes, Barcelona(España)</span><br>
                <span>9/18 - 06/20</span>
              </li>
              <li>
                <span>Docker for developers</span><br>
                <span>OpenWebinars, Barcelona(España)</span><br>
                <span>5/20 - 5/20</span><br>
              </li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-12">
            <h3 class="text-center mt-4">Experience</h3>
            <ul class="list list-experience">
              <li>
                <span>Web developer</span><br>
                <span>Deideasmarketing, Barcelona(España)</span><br>
                <span>07/20 - 09/20</span>
              </li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-12">
            <h3 class="text-center mt-4">Skills & Tools</h3>
            <ul class="list list-skills">  
              <li>
                <span list-id="FrontEnd" class="block-list-toggle">FrontEnd <i class="fas fa-caret-up"></i></span>
                <ul id="FrontEnd" class="block-list" init_state="visible">
                  <li>Html</li>
                  <li>Css</li>
                  <li>JavaScript</li>
                  <li>Sass</li>
                  <li>WebPack</li>
                  <li>Gulp</li>
                </ul>
              </li>
              <li>
                <span list-id="BackEnd" class="block-list-toggle">BackEnd <i class="fas fa-caret-down"></i></span>
                <ul id="BackEnd" class="block-list" init_state="hidden">
                  <li>Sistemas Linux</li>
                  <li>Apache</li>
                  <li>Nginx</li>
                  <li>Php</li>
                  <li>NodeJs - Express</li>
                  <li>MySql</li>
                  <li>MongoDB</li>
                  <li>Docker</li>
                </ul>
              </li>
              <li>
                <span list-id="Graphic-Design" class="block-list-toggle">Graphic design <i class="fas fa-caret-down"></i></span>
                <ul id="Graphic-Design" class="block-list">
                  <li>Figma - Mockup and prototyping</li>
                  <li>Gimp</li>
                </ul>
              </li>
              <li>
                <span list-id="Frameworks" class="block-list-toggle">Frameworks <i class="fas fa-caret-down"></i></span>
                <ul id="Frameworks" class="block-list">
                  <li>Symfony</li>
                  <li>Angular</li>
                  <li>Vue</li>
                </ul>
              </li>
              <li>
                <span list-id="CMD" class="block-list-toggle">CMD <i class="fas fa-caret-down"></i></span>
                <ul id="CMD" class="block-list">
                  <li>WordPress</li>
                  <li>Prestashop</li>
                </ul>
              </li>
              <li>
                <span list-id="Development-Tools" class="block-list-toggle">Development tools <i class="fas fa-caret-down"></i></span>
                <ul id="Development-Tools" class="block-list">
                  <li>Git</li>
                  <li>Jira</li>
                  <li>Docker Hub</li>
                  <li>GitHub</li>
                  <li>Vercel - Now</li>
                  <li>Heroku</li>
                  <li>AWS</li>
                </ul>
              </li>
              
            </ul>
          </div>
		</div>
		<!-- Featured project -->
        <div class="row">
          <div class="col-12">
            <h2 class="my-5 ml-3">
              Featured project
            </h2>
          </div>
          <div class="col-12 p-0">
            <div class="card-deck-projects">
				<?php
					foreach ($projects as $key => $project) {
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($project->ID),'single-post-thumbnail');
						/* var_dump($image); */
						/* var_dump($project); */
						/* var_dump(get_field('galeria_imagenes',$project->ID)); */
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