<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php bloginfo( 'title' ); ?></title>

    <!-- Nav and address bar color -->
    <meta name="theme-color" content="<?php echo get_theme_mod( 'primary_color' ); ?>">
    <meta name="msapplication-navbutton-color" content="<?php echo get_theme_mod( 'primary_color' ); ?>">
    <meta name="apple-mobile-web-app-status-bar-style" content="<?php echo get_theme_mod( 'primary_color' ); ?>">

	<?php wp_head(); ?>

</head>


<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php if ( has_custom_logo( 0 ) ) {
			echo get_custom_logo( 0 );
		} else {
			?>
			<?php bloginfo( 'name' ); ?>
		<?php } ?>

    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">

			<?php

			//					$itemsMenu = wp_get_nav_menu_items( 'Principal' );
			//
			//					foreach ( $itemsMenu as $item ) {
			//						$cssClass = '';
			//						foreach ( $item->classes as $class ) {
			//							$cssClass .= " " . $class;
			//						}
			//						echo '<li><a class="' . $cssClass . '" href="' . $item->url . '" title="">' . $item->title . '</a></li>';
			//					}

			// wordpress does not group child menu items with parent menu items
			$navbar_items = wp_get_nav_menu_items( "Principal" );
			$child_items  = [];
			// pull all child menu items into separate object
			foreach ( $navbar_items as $key => $item ) {
				if ( $item->menu_item_parent ) {
					array_push( $child_items, $item );
					unset( $navbar_items[ $key ] );
				}
			}
			// push child items into their parent item in the original object
			foreach ( $navbar_items as $item ) {
				foreach ( $child_items as $key => $child ) {
					if ( $child->menu_item_parent == $item->ID ) {
						if ( ! $item->child_items ) {
							$item->child_items = [];
						}
						array_push( $item->child_items, $child );
						unset( $child_items[ $key ] );
					}
				}
			}
			// return navbar object where child items are grouped with parents


			foreach ( $navbar_items as $item ) {

				if ( $item->child_items ) {
					print '<li class="nav-item dropdown">';
					print '<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">' . $item->title;
					print '</a>';
					echo '<div class="dropdown-menu">';
					foreach ( $item->child_items as $child_item ) {

						$cssClass = 'dropdown-item';
						foreach ( $child_item->classes as $class ) {
							$cssClass .= " " . $class;
						}
						echo '<a class="' . $cssClass . '" href="' . $child_item->url . '" title="">' . $child_item->title . '</a>';


					}
					print '</div>';
					print '</li>';
				} else {

					$cssClass = 'nav-link';
					foreach ( $item->classes as $class ) {
						$cssClass .= " " . $class;
					}
					echo '<li class="nav-item"><a class="' . $cssClass . '" href="' . $item->url . '" title="">' . $item->title . '</a></li>';
				}


			}


			?>
        </ul>
		<?php echo get_search_form(); ?>
    </div>
</nav>

