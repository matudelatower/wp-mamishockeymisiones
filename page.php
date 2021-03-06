<?php get_header(); ?>
    <div class="container" style="margin-top: 8rem">
        <section>
            <article class="content_format row">
                <div class="col-md-8 offset-md-2 overlap">

                    <h1><?php the_title(); ?></h1>
                    <hr>
                    <div class="col-md-12">
						<?php
						while ( have_posts() ) :
							the_post();

							the_content();

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>
                    </div>

            </article>
        </section>
    </div>
<?php get_footer(); ?>