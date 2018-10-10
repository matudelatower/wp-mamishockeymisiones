<?php get_header(); ?>
    <main role="main">
		<?php $seccion_header_imagen_fondo = get_theme_mod( 'seccion_header_imagen_fondo' ); ?>
		<?php $seccion_header_titulo = get_theme_mod( 'seccion_header_titulo' ); ?>
		<?php $seccion_header_descripcion = get_theme_mod( 'seccion_header_descripcion' ); ?>
		<?php if ( $seccion_header_imagen_fondo ): ?>
        <div class="jumbotron" style="background-image: url('<?php $seccion_header_imagen_fondo; ?>');">
			<?php else: ?>
            <div class="jumbotron"
                 style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/cesped.jpg'); padding-top: 8rem;">
				<?php endif ?>
                <div class="container text-center">
                    <img style="width: 50%" src="<?php echo get_theme_mod( 'seccion_header_logo' ); ?>"
                         class="img-fluid" alt="logo">
                </div>
            </div>
    </main>

    <section>

        <div class="barra d-none d-xl-block">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-md-3 text-center">
                        <h3>Partidos Futuros</h3>
                    </div>
                    <div class="col-md-9 text-center">
                        <h3>Últimas noticias</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="barra row d-xs-block d-lg-block d-md-block d-sm-block d-xl-none">
                        <div class="col-12">
                            <div class="text-center">
                                <h3>Partidos Futuros</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
						<?php if ( is_active_sidebar( 'mamishockeymisiones-partidos-futuros' ) ) : ?>

							<?php dynamic_sidebar( 'mamishockeymisiones-partidos-futuros' ); ?>


						<?php endif; ?>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="barra ultimas-noticias row d-xs-block d-lg-block d-md-block d-sm-block d-xl-none">
                        <div class="col-12">
                            <div class="text-center">
                                <h3>Últimas noticias</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="carouselNovedadesControls" class="carousel slide" data-ride="carousel">
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="carousel-inner">

		                                <?php
		                                $category_id = get_cat_ID( 'Novedades' );

		                                // Get the URL of this category
		                                $category_link = get_category_link( $category_id );

		                                $args         = array( 'numberposts' => '6', 'category' => $category_id );
		                                $recent_posts = wp_get_recent_posts( $args );


		                                foreach ( $recent_posts as $recent ) {
			                                if ( $countNovedades == 0 ) {
				                                print '<div class="carousel-item active"><div class="row card-group">';
				                                $countNovedades = 1;
			                                } elseif ( $countNovedades == 1 ) {
				                                print '<div class="carousel-item"><div class="row card-group">';
			                                }

			                                ?>

                                            <div class="col-xs-12 col-md-4">
                                                <div class="card">

					                                <?php
					                                if ( has_post_thumbnail( $recent["ID"] ) ) {
						                                ?>

                                                        <img class="card-img-top"
                                                             src="<?php echo get_the_post_thumbnail_url( $recent["ID"] ); ?>"
                                                             alt="Card image cap">

						                                <?php
					                                } else {
						                                ?>
                                                        <img class="card-img-top"
                                                             src="<?php echo get_stylesheet_directory_uri(); ?>/images/placeholder.png"
                                                             alt="Card image cap">

						                                <?php
					                                }
					                                ?>
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $recent["post_title"]; ?></h5>
                                                        <p class="card-text">
                                                            <small class="text-muted">
                                                                <time><?php echo date( get_option( 'date_format' ),
										                                strtotime( $recent['post_date'] ) ); ?></time>
                                                            </small>
                                                        </p>
                                                        <a href="<?php echo get_permalink( $recent["ID"] ); ?>"
                                                           class="btn btn-primary">Leer mas</a>
                                                    </div>
                                                </div>
                                            </div>

			                                <?php
			                                if ( $countNovedades % 3 == 0 ) {
				                                print '</div></div>';
				                                $countNovedades = 1;
			                                } else {

				                                $countNovedades ++;
			                                }
		                                }
		                                wp_reset_query();
		                                ?>

                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 text-center mt-4">
                                                <a class="btn btn-outline-secondary mx-1 prev"
                                                   href="#carouselNovedadesControls" role="button"
                                                   data-slide="prev">
                                                    <i class="fa fa-lg fa-chevron-left"></i>
                                                </a>
                                                <a class="btn btn-outline-secondary mx-1 next"
                                                   href="#carouselNovedadesControls" role="button"
                                                   data-slide="next">
                                                    <i class="fa fa-lg fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="barra pointer" data-toggle="collapse" href="#collapseTorneos" role="button" aria-expanded="false"
         aria-controls="collapseTorneos">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 text-center">
                    <h2>Torneos</h2>
                </div>
            </div>
        </div>
    </div>
    <section id="torneos">
        <div class="container collapse" id="collapseTorneos">
            <div class="row">
                <div class="col-12 mt-1">
                    <ul class="nav nav-tabs nav-fill" id="tabTorneos" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="fixture-tab" data-toggle="tab" href="#fixture" role="tab"
                               aria-controls="fixture" aria-selected="true">Fixture</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tabla-tab" data-toggle="tab" href="#tabla" role="tab"
                               aria-controls="tabla" aria-selected="false">Tabla de Posiciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="goleadoras-tab" data-toggle="tab" href="#goleadoras" role="tab"
                               aria-controls="goleadoras" aria-selected="false">Goleadoras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tarjetas-tab" data-toggle="tab" href="#tarjetas" role="tab"
                               aria-controls="tarjetas" aria-selected="false">Tarjetas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="archivos-tab" data-toggle="tab" href="#archivos" role="tab"
                               aria-controls="archivos" aria-selected="false">Archivos</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="tabTorneosContent">
                        <div class="tab-pane fade show active" id="fixture" role="tabpanel"
                             aria-labelledby="fixture-tab">

							<?php if ( is_active_sidebar( 'mamishockeymisiones-fixture' ) ) : ?>

								<?php dynamic_sidebar( 'mamishockeymisiones-fixture' ); ?>

							<?php endif; ?>

                        </div>
                        <div class="tab-pane fade" id="tabla" role="tabpanel" aria-labelledby="tabla-tab">
							<?php if ( is_active_sidebar( 'mamishockeymisiones-tabla-posiciones' ) ) : ?>

								<?php dynamic_sidebar( 'mamishockeymisiones-tabla-posiciones' ); ?>

							<?php endif; ?>

                        </div>
                        <div class="tab-pane fade" id="goleadoras" role="tabpanel" aria-labelledby="goleadoras-tab">
							<?php if ( is_active_sidebar( 'mamishockeymisiones-goleadoras' ) ) : ?>

								<?php dynamic_sidebar( 'mamishockeymisiones-goleadoras' ); ?>

							<?php endif; ?>
                        </div>
                        <div class="tab-pane fade" id="tarjetas" role="tabpanel" aria-labelledby="tarjetas-tab">
							<?php if ( is_active_sidebar( 'mamishockeymisiones-tarjetas' ) ) : ?>

								<?php dynamic_sidebar( 'mamishockeymisiones-tarjetas' ); ?>

							<?php endif; ?>
                        </div>
                        <div class="tab-pane fade" id="archivos" role="tabpanel" aria-labelledby="archivos-tab">
							<?php if ( is_active_sidebar( 'mamishockeymisiones-archivos' ) ) : ?>

								<?php dynamic_sidebar( 'mamishockeymisiones-archivos' ); ?>

							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--institución-->

<?php

$seccion_institucion_imagen_fondo = get_theme_mod( 'seccion_institucion_imagen_fondo' );

if ( ! $seccion_institucion_imagen_fondo ) {
	$seccion_institucion_imagen_fondo = get_template_directory_uri() . '/images/institucion.jpg';
}

?>

    <div class="jumbotron jumbotron-img"
         style="background: url('<?php echo $seccion_institucion_imagen_fondo; ?>')no-repeat center center;">
        <div class="container">

        </div>
    </div>
    <div class="barra pointer" data-toggle="collapse" href="#collapseInstitucion" role="button" aria-expanded="false"
         aria-controls="collapseInstitucion">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 text-center">
                    <h2>
                        Institución
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <section id="institucion">
        <div class="container collapse" id="collapseInstitucion">
            <div class="row">
                <div class="col-12 mt-1">
                    <ul class="nav nav-fill nav-tabs" id="tabInstitucion" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="sobre-tab" data-toggle="tab" href="#sobre" role="tab"
                               aria-controls="sobre" aria-selected="true">Sobre la Asociación</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="autoridades-tab" data-toggle="tab" href="#autoridades" role="tab"
                               aria-controls="autoridades" aria-selected="false">Autoridades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="estatuto-tab" data-toggle="tab" href="#estatuto" role="tab"
                               aria-controls="estatuto" aria-selected="false">Estatuto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dondetamo-tab" data-toggle="tab" href="#dondetamo" role="tab"
                               aria-controls="dondetamo" aria-selected="false">Dónde estamos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="seguro-y-cobertura-tab" data-toggle="tab" href="#seguro-y-cobertura"
                               role="tab"
                               aria-controls="seguro-y-cobertura" aria-selected="false">Seguro y Coberturas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="tabInstitucionContent">
                        <div class="tab-pane fade show active" id="sobre" role="tabpanel"
                             aria-labelledby="sobre-tab">
                            <div class="row">
								<?php if ( is_active_sidebar( 'mamishockeymisiones-sobre' ) ) : ?>

									<?php dynamic_sidebar( 'mamishockeymisiones-sobre' ); ?>

								<?php endif; ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="autoridades" role="tabpanel" aria-labelledby="autoridades-tab">
                            <div class="row">
								<?php if ( is_active_sidebar( 'mamishockeymisiones-autoridades' ) ) : ?>

									<?php dynamic_sidebar( 'mamishockeymisiones-autoridades' ); ?>

								<?php endif; ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="estatuto" role="tabpanel" aria-labelledby="estatuto-tab">
                            <div class="row">
								<?php if ( is_active_sidebar( 'mamishockeymisiones-estatuto' ) ) : ?>

									<?php dynamic_sidebar( 'mamishockeymisiones-estatuto' ); ?>

								<?php endif; ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="dondetamo" role="tabpanel" aria-labelledby="dondetamo-tab">
                            <div class="row">
								<?php if ( is_active_sidebar( 'mamishockeymisiones-dondetamo' ) ) : ?>

									<?php dynamic_sidebar( 'mamishockeymisiones-dondetamo' ); ?>

								<?php endif; ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="seguro-y-cobertura" role="tabpanel"
                             aria-labelledby="seguro-y-cobertura-tab">
                            <div class="row">
								<?php if ( is_active_sidebar( 'mamishockeymisiones-seguro' ) ) : ?>

									<?php dynamic_sidebar( 'mamishockeymisiones-seguro' ); ?>

								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--normativas-->

<?php

$seccion_normativas_imagen_fondo = get_theme_mod( 'seccion_normativas_imagen_fondo' );

if ( ! $seccion_normativas_imagen_fondo ) {
	$seccion_normativas_imagen_fondo = get_template_directory_uri() . '/images/normativas.jpg';
}

?>
    <div class="jumbotron jumbotron-img"
         style="background: url('<?php echo $seccion_normativas_imagen_fondo; ?>')no-repeat center center;">
        <div class="container">

        </div>
    </div>
    <div class="barra pointer" data-toggle="collapse" href="#collapseNormativas" role="button" aria-expanded="false"
         aria-controls="collapseNormativas">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 text-center">
                    <h2>Normativas</h2>
                </div>
            </div>
        </div>
    </div>

    <section id="normativas">
        <div class="container collapse" id="collapseNormativas">
            <div class="row">
                <div class="col-12 mt-1">
                    <ul class="nav nav-tabs nav-fill" id="tabNormativas" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="circulares-tab" data-toggle="tab" href="#circulares"
                               role="tab"
                               aria-controls="circulares" aria-selected="true">Circulares</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reglamento-tab" data-toggle="tab" href="#reglamento" role="tab"
                               aria-controls="reglamento" aria-selected="false">Reglamento de Torneo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tribunal-penas-tab" data-toggle="tab" href="#tribunal-penas"
                               role="tab"
                               aria-controls="tribunal-penas" aria-selected="false">Tribunal de penas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="tabNormativasContent">
                        <div class="tab-pane fade show active" id="circulares" role="tabpanel"
                             aria-labelledby="circulares-tab">
                            <div class="row mt-1">
								<?php if ( is_active_sidebar( 'mamishockeymisiones-circulares' ) ) : ?>

									<?php dynamic_sidebar( 'mamishockeymisiones-circulares' ); ?>

								<?php endif; ?>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="reglamento" role="tabpanel" aria-labelledby="reglamento-tab">
                            <div class="row mt-1">
								<?php if ( is_active_sidebar( 'mamishockeymisiones-reglamentos' ) ) : ?>

									<?php dynamic_sidebar( 'mamishockeymisiones-reglamentos' ); ?>

								<?php endif; ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tribunal-penas" role="tabpanel"
                             aria-labelledby="tribunal-penas-tab">
                            <div class="row mt-1">
								<?php if ( is_active_sidebar( 'mamishockeymisiones-tribunal' ) ) : ?>

									<?php dynamic_sidebar( 'mamishockeymisiones-tribunal' ); ?>

								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--equipos-->
<?php

$seccion_equipos_imagen_fondo = get_theme_mod( 'seccion_equipos_imagen_fondo' );

if ( ! $seccion_equipos_imagen_fondo ) {
	$seccion_equipos_imagen_fondo = get_template_directory_uri() . '/images/equipos.jpg';
}

?>
    <div class="jumbotron jumbotron-img"
         style="background: url('<?php echo $seccion_equipos_imagen_fondo; ?>')no-repeat center center;">
        <div class="container">

        </div>
    </div>
    <div class="barra pointer" data-toggle="collapse" href="#collapseEquipos" role="button" aria-expanded="false"
         aria-controls="collapseEquipos">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 text-center">
                    <h2>Equipos</h2>
                </div>
            </div>
        </div>
    </div>

    <section id="equipos">
        <div class="container collapse" id="collapseEquipos">
            <div id="carouselEquiposControls" class="carousel slide" data-ride="carousel">
                <div class="row">
                    <div class="carousel-inner">
                        <div class="row">
							<?php
							//                                $category_id = get_cat_ID( 'Concejales' );
							//
							//                                // Get the URL of this category
							//                                $category_link = get_category_link( $category_id );

							$args         = array(
								'numberposts' => '14',
								'post_type'   => 'equipos',
//								'orderby'     => 'post_date',
//								'order'       => 'ASC',
								'post_status' => 'publish'
							);
							$recent_posts = wp_get_recent_posts( $args );
							$countEquipos = 0;
							foreach ( $recent_posts as $recent ) {
								if ( $countEquipos == 0 ) {
									print '<div class="carousel-item active"><div class="row card-group">';
									$countEquipos = 1;
								} elseif ( $countEquipos == 1 ) {
									print '<div class="carousel-item"><div class="row card-group">';
								}

								$meta = get_post_meta( $recent["ID"], 'your_fields', true );

								?>

                                <div class="col-xs-12 col-md-3">

                                    <div class="card">
                                        <a href="<?php echo get_permalink( $recent["ID"] ); ?>">
                                            <div class="card-header">
												<?php echo $recent["post_title"]; ?>
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong> Delegada: </strong><br>
													<?php if ( is_array( $meta ) && isset( $meta['delegada'] ) ) {
														echo $meta['delegada'];
													} ?><br>

                                                    <strong> Correo electónico: </strong><br>
													<?php if ( is_array( $meta ) && isset( $meta['mail-delegada'] ) ) {
														echo $meta['mail-delegada'];
													} ?><br>

                                                    <strong> Sub Delegada: </strong><br>
													<?php if ( is_array( $meta ) && isset( $meta['subdelegada'] ) ) {
														echo $meta['subdelegada'];
													} ?><br>

                                                    <strong> Correo electónico: </strong><br>
													<?php if ( is_array( $meta ) && isset( $meta['subdelegada-mail'] ) ) {
														echo $meta['subdelegada-mail'];
													} ?><br>

                                                    <strong> Capitana: </strong><br>
													<?php if ( is_array( $meta ) && isset( $meta['capitana'] ) ) {
														echo $meta['capitana'];
													} ?><br>

                                                    <strong> Director Técnico: </strong><br>
													<?php if ( is_array( $meta ) && isset( $meta['dt'] ) ) {
														echo $meta['dt'];
													} ?><br>

                                                </div>
                                                <div class="col-6">
													<?php
													if ( has_post_thumbnail( $recent["ID"] ) ) {
														?>
                                                        <img src="<?php echo get_the_post_thumbnail_url( $recent["ID"],
															'thumbnail' ); ?>" alt="" class="img-fluid">
														<?php
													} else {
														?>

                                                        <img class="img-fluid"
                                                             src="<?php echo get_template_directory_uri() . '/images/equipo-generico.png' ?>">


														<?php
													}
													?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


								<?php
								if ( $countEquipos % 4 == 0 ) {
									print '</div></div>';
									$countEquipos = 1;
								} else {

									$countEquipos ++;
								}
							}
							wp_reset_query();
							?>

                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center mt-4">
                            <a class="btn btn-outline-secondary mx-1 prev" href="#carouselEquiposControls" role="button"
                               data-slide="prev">
                                <i class="fa fa-lg fa-chevron-left"></i>
                            </a>
                            <a class="btn btn-outline-secondary mx-1 next" href="#carouselEquiposControls" role="button"
                               data-slide="next">
                                <i class="fa fa-lg fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- /#myCarousel -->
        </div>
    </section>

    <!--socias-->
<?php

$seccion_socias_imagen_fondo = get_theme_mod( 'seccion_socias_imagen_fondo' );

if ( ! $seccion_socias_imagen_fondo ) {
	$seccion_socias_imagen_fondo = get_template_directory_uri() . '/images/socias.jpg';
}

?>
    <div class="jumbotron jumbotron-img"
         style="background: url('<?php echo $seccion_socias_imagen_fondo; ?>')no-repeat center center;">
        <div class="container">
            <!--            <img src="#" class="img-fluid" alt="socias">-->
        </div>
    </div>
    <div class="barra pointer" data-toggle="collapse" href="#collapseSocias" role="button" aria-expanded="false"
         aria-controls="collapseSocias">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 text-center">
                    <h2>Socias</h2>
                </div>
            </div>
        </div>
    </div>

    <section id="socias">
        <div class="container collapse" id="collapseSocias">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
						<?php echo do_shortcode( get_theme_mod( 'seccion_socias_descripcion' ) ); ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--galeria-->
<?php

$seccion_galeria_imagen_fondo = get_theme_mod( 'seccion_galeria_imagen_fondo' );

if ( ! $seccion_galeria_imagen_fondo ) {
	$seccion_galeria_imagen_fondo = get_template_directory_uri() . '/images/equipos.jpg';
}

?>
    <div class="jumbotron jumbotron-img"
         style="background: url('<?php echo $seccion_galeria_imagen_fondo; ?>')no-repeat center center;">
        <div class="container">
            <!--            <img src="#" class="img-fluid" alt="galeria">-->
        </div>
    </div>
    <div class="barra pointer" data-toggle="collapse" href="#collapseGaleria" role="button" aria-expanded="false"
         aria-controls="collapseGaleria">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 text-center">
                    <h2>Galería</h2>
                </div>
            </div>
        </div>
    </div>

    <section id="galeria">
        <div class="container collapse" id="collapseGaleria">
            <div id="carouselGaleriasControls" class="carousel slide" data-ride="carousel">
                <div class="row">
                    <div class="carousel-inner">
                        <div class="row p-3">
							<?php
							//                                $category_id = get_cat_ID( 'Concejales' );
							//
							//                                // Get the URL of this category
							//                                $category_link = get_category_link( $category_id );

							$category_id = get_cat_ID( 'Galeria' );

							// Get the URL of this category
							$category_link = get_category_link( $category_id );

							$args          = array(
								'numberposts' => '12',
//						        'post_type'   => 'equipos',
								'orderby'     => 'post_date',
								'order'       => 'ASC',
								'category'    => $category_id,
								'post_status' => 'publish'
							);
							$recent_posts  = wp_get_recent_posts( $args );
							$countGalerias = 0;
							foreach ( $recent_posts as $recent ) {
								if ( $countGalerias == 0 ) {
									print '<div class="carousel-item active"><div class="row">';
									$countGalerias = 1;
								} elseif ( $countGalerias == 1 ) {
									print '<div class="carousel-item"><div class="row">';
								}

								?>

                                <div class="col-sm-3">

                                    <div class="card">
                                        <a href="<?php echo get_permalink( $recent["ID"] ); ?>">

                                            <div class="card-body">
                                                <p class="card-text">
                                                    <small class="text-muted"><?php echo $recent["post_title"]; ?></small>
                                                </p>
                                            </div>

											<?php
											if ( has_post_thumbnail( $recent["ID"] ) ) {
												?>
                                                <img src="<?php echo get_the_post_thumbnail_url( $recent["ID"],
													'thumbnail' ); ?>" alt="" class="card-img-bottom">
												<?php
											} else {
												?>

                                                <img class="card-img-bottom"
                                                     src="<?php echo get_template_directory_uri() . '/images/equipo-generico.png' ?>">


												<?php
											}
											?>
                                        </a>
                                    </div>

                                </div>


								<?php
								if ( $countGalerias % 4 == 0 ) {
									print '</div></div>';
									$countGalerias = 1;
								} else {

									$countGalerias ++;
								}
							}
							wp_reset_query();
							?>

                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center mt-4">
                            <a class="btn btn-outline-secondary mx-1 prev" href="#carouselGaleriasControls"
                               role="button"
                               data-slide="prev">
                                <i class="fa fa-lg fa-chevron-left"></i>
                            </a>
                            <a class="btn btn-outline-secondary mx-1 next" href="#carouselGaleriasControls"
                               role="button"
                               data-slide="next">
                                <i class="fa fa-lg fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- /#myCarousel -->
        </div>
    </section>

    <!--formularios-->
<?php

$seccion_formularios_imagen_fondo = get_theme_mod( 'seccion_formularios_imagen_fondo' );

if ( ! $seccion_formularios_imagen_fondo ) {
	$seccion_formularios_imagen_fondo = get_template_directory_uri() . '/images/equipos.jpg';
}

?>
    <div class="jumbotron jumbotron-img"
         style="background: url('<?php echo $seccion_formularios_imagen_fondo; ?>')no-repeat center center;">
        <div class="container">
            <!--            <img src="#" class="img-fluid" alt="formularios">-->
        </div>
    </div>
    <div class="barra pointer" data-toggle="collapse" href="#collapseFormularios" role="button" aria-expanded="false"
         aria-controls="collapseFormularios">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 text-center">
                    <h2>Formularios</h2>
                </div>
            </div>
        </div>
    </div>

    <section id="formularios">
        <div class="container collapse" id="collapseFormularios">
            <div class="row mt-1">
				<?php if ( is_active_sidebar( 'mamishockeymisiones-formularios' ) ) : ?>

					<?php dynamic_sidebar( 'mamishockeymisiones-formularios' ); ?>

				<?php endif; ?>
            </div>
        </div>
    </section>

    <!--contacto-->
<?php

$seccion_contacto_imagen_fondo = get_theme_mod( 'seccion_contacto_imagen_fondo' );

if ( ! $seccion_contacto_imagen_fondo ) {
	$seccion_contacto_imagen_fondo = get_template_directory_uri() . '/images/equipos.jpg';
}

?>
    <div class="jumbotron jumbotron-img"
         style="background: url('<?php echo $seccion_contacto_imagen_fondo; ?>')no-repeat center center;">
        <div class="container">
            <!--            <img src="#" class="img-fluid" alt="contacto">-->
        </div>
    </div>
    <div class="barra pointer" data-toggle="collapse" href="#collapseContacto" role="button" aria-expanded="false"
         aria-controls="collapseContacto">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 text-center">
                    <h2>Contacto</h2>
                </div>
            </div>
        </div>
    </div>

    <section id="contacto">
        <div class="container collapse" id="collapseContacto">
            <div class="row mt-2">
                <div class="col-md-6">
                    <p class="text-justify">
                        Comunicate con nosotros y con gusto atenderemos tus dudas,
                        comentarios y sugerencias
                    </p>
                    <p class="text-justify">
                        Por favor no realices ataques personales y mantené tu lenguaje dentro de
                        los límites adecuados. La brevedad es una virtud y la apreciamos.
                    </p>

                    <div class="row">
                        <div class="col-md-12">
							<?php echo do_shortcode( get_theme_mod( 'seccion_contacto_formulario' ) ); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <p>
							<?php $mamihockyemisiones_direccion = get_theme_mod( 'mamihockyemisiones_direccion' ); ?>
							<?php $mamihockyemisiones_mail = get_theme_mod( 'mamihockyemisiones_mail' ); ?>
							<?php $mamihockyemisiones_telefono = get_theme_mod( 'mamihockyemisiones_telefono' ); ?>
                            <i class="fa fa-map-marker"
                               aria-hidden="true"></i> <?php echo $mamihockyemisiones_direccion; ?> <br>
                            <i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $mamihockyemisiones_mail; ?>
                            <br>
                            <i class="fa fa-mobile" aria-hidden="true"></i> <?php echo $mamihockyemisiones_telefono; ?>
                        </p>
                    </div>

					<?php if ( is_active_sidebar( 'mamishockeymisiones-contacto' ) ) : ?>

						<?php dynamic_sidebar( 'mamishockeymisiones-contacto' ); ?>


					<?php endif; ?>

                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>