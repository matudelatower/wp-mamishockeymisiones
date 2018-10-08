<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 29/12/17
 * Time: 10:04
 */

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

function mamishockeymisiones_enqueue_styles() {
	wp_enqueue_style( 'mamishockeymisiones', get_template_directory_uri() . '/style.css' );

}

add_action( 'wp_enqueue_scripts', 'mamishockeymisiones_enqueue_styles' );

function mamishockeymisiones_enqueue_scripts() {


	wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/bundle.js', [], '1.0.0', false );


}

add_action( 'wp_enqueue_scripts', 'mamishockeymisiones_enqueue_scripts' );


add_theme_support( 'custom-logo',
	array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );


add_action( 'customize_register', 'registrar_customizer' );
function registrar_customizer( WP_Customize_Manager $wp_customize ) {
	require_once get_stylesheet_directory() . '/inc/dropdown-categoria.php';
	$wp_customize->add_section( 'homepage',
		array(
			'title' => esc_html_x( 'Homepage Options', 'customizer section title', 'mamishockeymisiones' ),
		) );
	$wp_customize->add_setting( 'mamishockeymisiones_categoria_dropdown',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		) );
	$wp_customize->add_control( new DropdownCategoria( $wp_customize, 'mamishockeymisiones_categoria_dropdown', array(
		'section'     => 'homepage',
		'label'       => esc_html__( 'Categoría', 'mamishockeymisiones' ),
		'description' => esc_html__( 'Elegi una categoría para que sea mostrada en esta sección.',
			'mamishockeymisiones' ),
		// Uncomment to pass arguments to wp_dropdown_categories()
		//'dropdown_args' => array(
		//	'taxonomy' => 'post_tag',
		//),
	) ) );
}


function mamishockeymisiones_pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo '<div class="row"><div class="col-md-12 text-center">';
		echo '<ul class="pagination justify-content-center">';
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<a class='page-link' href='" . get_pagenum_link( 1 ) . "'>&laquo;</a>";
		}
		if ( $paged > 1 && $showitems < $pages ) {
			echo "<a class='page-link' href='" . get_pagenum_link( $paged - 1 ) . " aria-label='Anterior''><span aria-hidden='true'>«</span></a>";
		}

		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? "<li class='page-item active'><a class='page-link' href='#'>" . $i . "</a></li>" : "<li class='page-item'><a class='page-link' href='" . get_pagenum_link( $i ) . "' >" . $i . "</a></li>";
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo "<a class='page-link' href='" . get_pagenum_link( $paged + 1 ) . "' aria-label='Siguiente'><span aria-hidden='true'>»</span></a>";
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<a class='page-link' href='" . get_pagenum_link( $pages ) . "'>&raquo;</a>";
		}
		echo "</ul>\n";
		echo '</div></div>';
	}
}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

// widgets

function mamishockeymisiones_partidos_futuros_widget( $content ) {
	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
		dynamic_sidebar( 'mamishockeymisiones-partidos_futuros' );
	}

	return $content;
}

add_filter( 'the_content', 'mamishockeymisiones_partidos_futuros_widget' );

register_sidebar( array(
	'id'            => 'mamishockeymisiones-partidos-futuros',
	'name'          => 'Partidos Futuros',
	'description'   => 'Widgets Partidos Futuros',
	'before_widget' => '<div class="card"><div class="card-body">',
	'after_widget'  => '</div></div>',
) );


function mamishockeymisiones_fixture_widget( $content ) {
	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
		dynamic_sidebar( 'mamishockeymisiones-fixture' );
	}

	return $content;
}

add_filter( 'the_content', 'mamishockeymisiones_fixture_widget' );

register_sidebar( array(
	'id'            => 'mamishockeymisiones-fixture',
	'name'          => 'Fixture',
	'description'   => 'Widgets Fixture',
	'before_widget' => '<div class="card"><div class="card-body">',
	'after_widget'  => '</div></div>',
) );

function mamishockeymisiones_tabla_posiciones_widget( $content ) {
	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
		dynamic_sidebar( 'mamishockeymisiones-tabla-posiciones' );
	}

	return $content;
}

add_filter( 'the_content', 'mamishockeymisiones_tabla_posiciones_widget' );

register_sidebar( array(
	'id'            => 'mamishockeymisiones-tabla-posiciones',
	'name'          => 'Tabla de Posiciones',
	'description'   => 'Widgets Tabla de Posiciones',
	'before_widget' => '<div class="card"><div class="card-body">',
	'after_widget'  => '</div></div>',
) );


//Institucion

$aInstitucionWidget = [
	'sobre'       => 'Sobre la Institucion',
	'autoridades' => 'Autoridades',
	'estatuto'    => 'Estatuto',
	'dondetamo'   => 'Donde estamos?',
	'seguro'      => 'Seguro y Coberturas',
];

foreach ( $aInstitucionWidget as $key => $item ) {


	add_filter( 'the_content',
		function ( $content ) use ( $key ) {
			if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
				dynamic_sidebar( 'mamishockeymisiones-' . $key );
			}

			return $content;
		} );

	register_sidebar( array(
		'id'            => 'mamishockeymisiones-' . $key,
		'name'          => $item,
		'description'   => 'Widgets ' . $item,
		'before_widget' => '<div class="col-md-12">',
		'after_widget'  => '</div>',
	) );
}


// Normativas

function mamishockeymisiones_circulares_widget( $content ) {
	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
		dynamic_sidebar( 'mamishockeymisiones-circulares' );
	}

	return $content;
}

add_filter( 'the_content', 'mamishockeymisiones_circulares_widget' );

register_sidebar( array(
	'id'            => 'mamishockeymisiones-circulares',
	'name'          => 'Circulares',
	'description'   => 'Widgets Circulares',
	'before_widget' => '<div class="col-md-4"><div class="card">',
	'before_title'  => '<div class="card-header">',
	'after_title'   => '</div><div class="card-body">',
	'after_widget'  => '</div></div></div>',
) );

function mamishockeymisiones_reglamentos_widget( $content ) {
	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
		dynamic_sidebar( 'mamishockeymisiones-reglamentos' );
	}

	return $content;
}

add_filter( 'the_content', 'mamishockeymisiones_reglamentos_widget' );

register_sidebar( array(
	'id'            => 'mamishockeymisiones-reglamentos',
	'name'          => 'Reglamentos',
	'description'   => 'Widgets Reglamentos',
	'before_widget' => '<div class="col-md-4"><div class="card">',
	'before_title'  => '<div class="card-header">',
	'after_title'   => '</div><div class="card-body">',
	'after_widget'  => '</div></div></div>',
) );

function mamishockeymisiones_tribunal_widget( $content ) {
	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
		dynamic_sidebar( 'mamishockeymisiones-tribunal' );
	}

	return $content;
}

add_filter( 'the_content', 'mamishockeymisiones_tribunal_widget' );

register_sidebar( array(
	'id'            => 'mamishockeymisiones-tribunal',
	'name'          => 'Tribunal',
	'description'   => 'Widgets Tribunal de Penas',
	'before_widget' => '<div class="col-md-12">',
	'after_widget'  => '</div>',
) );

function mamishockeymisiones_formularios_widget( $content ) {
	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
		dynamic_sidebar( 'mamishockeymisiones-formularios' );
	}

	return $content;
}

add_filter( 'the_content', 'mamishockeymisiones_formularios_widget' );

register_sidebar( array(
	'id'            => 'mamishockeymisiones-formularios',
	'name'          => 'Formularios',
	'description'   => 'Widgets Formularios',
	'before_widget' => '<div class="col-md-4"><div class="card">',
	'before_title'  => '<div class="card-header">',
	'after_title'   => '</div><div class="card-body">',
	'after_widget'  => '</div></div></div>',
) );

function mamishockeymisiones_contacto_widget( $content ) {
	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'before-post' ) && is_main_query() ) {
		dynamic_sidebar( 'mamishockeymisiones-contacto' );
	}

	return $content;
}

add_filter( 'the_content', 'mamishockeymisiones_contacto_widget' );

register_sidebar( array(
	'id'            => 'mamishockeymisiones-contacto',
	'name'          => 'Contacto',
	'description'   => 'Widget Contato',
	'before_widget' => '<div class="col-md-12">',
	'after_widget'  => '</div>',
) );


//POST TYPE
function create_posttype() {

	register_post_type( 'equipos',
		array(
			'labels'      => array(
				'name'          => __( 'Equipos' ),
				'singular_name' => __( 'Equipo' )
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array( 'slug' => 'equipos' ),
		)
	);
}

// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'               => _x( 'Equipos', 'Post Type General Name', 'mamishockeymisiones' ),
		'singular_name'      => _x( 'Equipo', 'Post Type Singular Name', 'mamishockeymisiones' ),
		'menu_name'          => __( 'Equipos', 'mamishockeymisiones' ),
		'parent_item_colon'  => __( 'Equipo Padre', 'mamishockeymisiones' ),
		'all_items'          => __( 'Todos los Equipos', 'mamishockeymisiones' ),
		'view_item'          => __( 'Ver Equipo', 'mamishockeymisiones' ),
		'add_new_item'       => __( 'Agregar Nuevo Equipo', 'mamishockeymisiones' ),
		'add_new'            => __( 'Agregar Nuevo', 'mamishockeymisiones' ),
		'edit_item'          => __( 'Editar Equipo', 'mamishockeymisiones' ),
		'update_item'        => __( 'Actualizar Equipo', 'mamishockeymisiones' ),
		'search_items'       => __( 'Buscar Equipo', 'mamishockeymisiones' ),
		'not_found'          => __( 'No encontrado', 'mamishockeymisiones' ),
		'not_found_in_trash' => __( 'No encontrado en papelera', 'mamishockeymisiones' ),
	);

// Set other options for Custom Post Type


	$supports = array(
		'title',
		'editor',
		'excerpt',
		'author',
		'thumbnail',
		'comments',
		'revisions'
	);
	$args     = array(
		'label'               => __( 'equipos', 'mamishockeymisiones' ),
		'description'         => __( 'Equipo news and reviews', 'mamishockeymisiones' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => $supports,
		// You can associate this CPT with a taxonomy or custom taxonomy.
//		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'equipos', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );


//metabox
function add_your_fields_meta_box() {
	add_meta_box(
		'your_fields_meta_box', // $id
		'Campos Personalizados', // $title
		'show_your_fields_meta_box', // $callback
		'equipos', // $screen
		'normal', // $context
		'high' // $priority
	);
}

add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );

function show_your_fields_meta_box() {
	global $post;

	$meta = get_post_meta( $post->ID, 'your_fields', true ); ?>

    <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>">


    <p>
        <label for="your_fields[image]">Foto de Portada</label><br>
        <input type="text" name="your_fields[image]" id="your_fields[image]" class="meta-image regular-text"
               value="<?php if ( is_array( $meta ) && isset( $meta['image'] ) ) {
			       echo $meta['image'];
		       } ?>">
        <input type="button" class="button image-upload" value="Buscar">
    </p>
    <div class="image-preview"><img src="<?php if ( is_array( $meta ) && isset( $meta['image'] ) ) {
			echo $meta['image'];
		} ?>" style="max-width: 250px;"></div>


    <script>
        jQuery(document).ready(function ($) {
            // Instantiates the variable that holds the media library frame.
            var meta_image_frame;
            // Runs when the image button is clicked.
            $('.image-upload').click(function (e) {
                // Get preview pane
                var meta_image_preview = $(this).parent().parent().children('.image-preview');
                // Prevents the default action from occuring.
                e.preventDefault();
                var meta_image = $(this).parent().children('.meta-image');
                // If the frame already exists, re-open it.
                if (meta_image_frame) {
                    meta_image_frame.open();
                    return;
                }
                // Sets up the media library frame
                meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                    title: meta_image.title,
                    button: {
                        text: meta_image.button
                    }
                });
                // Runs when an image is selected.
                meta_image_frame.on('select', function () {
                    // Grabs the attachment selection and creates a JSON representation of the model.
                    var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
                    // Sends the attachment URL to our custom image input field.
                    meta_image.val(media_attachment.url);
                    meta_image_preview.children('img').attr('src', media_attachment.url);
                });
                // Opens the media library frame.
                meta_image_frame.open();
            });
        });
    </script>


    <p>
        <label for="your_fields[delegada]">Delegada</label>
        <br>
        <input type="text" name="your_fields[delegada]" id="your_fields[delegada]" class="regular-text"
               value="<?php if ( is_array( $meta ) && isset( $meta['delegada'] ) ) {
			       echo $meta['delegada'];
		       } ?>">
    </p>

    <p>
        <label for="your_fields[mail-delegada]">Mail</label>
        <br>
        <input type="email" name="your_fields[mail-delegada]" id="your_fields[mail-delegada]" class="regular-text"
               value="<?php if ( is_array( $meta ) && isset( $meta['mail-delegada'] ) ) {
			       echo $meta['mail-delegada'];
		       } ?>">
    </p>
    <p>
        <label for="your_fields[subdelegada]">Sub Delegada</label>
        <br>
        <input type="text" name="your_fields[subdelegada]" id="your_fields[subdelegada]" class="regular-text"
               value="<?php if ( is_array( $meta ) && isset( $meta['subdelegada'] ) ) {
			       echo $meta['subdelegada'];
		       } ?>">
    </p>

    <p>
        <label for="your_fields[subdelegada-mail]">Sub Delegada Mail</label>
        <br>
        <input type="email" name="your_fields[subdelegada-mail]" id="your_fields[subdelegada-mail]" class="regular-text"
               value="<?php if ( is_array( $meta ) && isset( $meta['subdelegada-mail'] ) ) {
			       echo $meta['subdelegada-mail'];
		       } ?>">
    </p>
    <p>
        <label for="your_fields[capitana]">Capitana</label>
        <br>
        <input type="text" name="your_fields[capitana]" id="your_fields[capitana]" class="regular-text"
               value="<?php if ( is_array( $meta ) && isset( $meta['capitana'] ) ) {
			       echo $meta['capitana'];
		       } ?>">
    </p>

    <p>
        <label for="your_fields[dt]">DT</label>
        <br>
        <input type="text" name="your_fields[dt]" id="your_fields[dt]" class="regular-text"
               value="<?php if ( is_array( $meta ) && isset( $meta['dt'] ) ) {
			       echo $meta['dt'];
		       } ?>">
    </p>


<?php }

function save_your_fields_meta( $post_id ) {
	// verify nonce
	if ( isset( $_POST['your_meta_box_nonce'] )
	     && ! wp_verify_nonce( $_POST['your_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( isset( $_POST['post_type'] ) ) { //Fix 2
		if ( 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}
	}

	$old = get_post_meta( $post_id, 'your_fields', true );
	if ( isset( $_POST['your_fields'] ) ) { //Fix 3
		$new = $_POST['your_fields'];
		if ( $new && $new !== $old ) {
			update_post_meta( $post_id, 'your_fields', $new );
		} elseif ( '' === $new && $old ) {
			delete_post_meta( $post_id, 'your_fields', $old );
		}
	}
}

add_action( 'save_post', 'save_your_fields_meta' );


?>