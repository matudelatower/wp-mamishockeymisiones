<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <div class="col-md-12">
        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
			<?php if ( has_post_thumbnail() ) { ?>
                <img class="card-img-left flex-auto d-none d-lg-block"
                     src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>"
                     alt="...">
			<?php } else { ?>
                <img class="card-img-left flex-auto d-none d-lg-block" src="http://placehold.it/150x150" alt="...">
			<?php } ?>

            <div class="card-body d-flex flex-column align-items-start">
                <h3 class="mb-0">
                    <a class="text-dark" href="#"><?php the_title( sprintf( '<a href="%s" rel="bookmark">',
							esc_url( get_permalink() ) ),
							'</a>' ); ?></a>
                    <span>
						<?php
                        // enlace editar
						edit_post_link( '<i class="fa fa-edit"></i>' );
						?>
                    </span>
                </h3>
                <div class="mb-1 text-muted"><?php echo get_the_date(); ?></div>
                <p class="card-text mb-auto"><?php echo get_the_excerpt(); ?></p>
            </div>

        </div>
    </div>


</article><!-- #post-## -->

