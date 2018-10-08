<footer class="main-footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
				<?php if ( has_custom_logo( 0 ) ) {
					echo get_custom_logo( 0 );
				} else {
					?>
                    <img class="image-responsive" alt="Mami's Hockey Misiones logo pie"
                         src="<?php echo get_stylesheet_directory_uri(); ?>/images/argentinagob.svg">
				<?php } ?>
                <br>
                <p class="text-muted small">Los contenidos de <?php bloginfo( 'title' ); ?> están licenciados bajo <a
                            href="https://creativecommons.org/licenses/by/2.5/ar/">Creative Commons Reconocimiento
                        2.5 Argentina License</a></p>
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <h2 class="h3 section-title"><?php echo $seccion_contacto_titulo_seccion; ?></h2>
                <div>

                    <p class="margin-40">
						<?php $mamihockyemisiones_telefono = get_theme_mod( 'mamihockyemisiones_telefono' ); ?>
						<?php $mamihockyemisiones_celular = get_theme_mod( 'mamihockyemisiones_celular' ); ?>
						<?php $mamihockyemisiones_mail = get_theme_mod( 'mamihockyemisiones_mail' ); ?>
						<?php $mamihockyemisiones_direccion = get_theme_mod( 'mamihockyemisiones_direccion' ); ?>
                        <strong>Dirección:</strong> <?php echo $mamihockyemisiones_direccion ?><br>
						<?php if ( $mamihockyemisiones_celular ) : ?>
                            <strong>Celular:</strong> <?php echo $mamihockyemisiones_celular ?><br>
						<?php endif; ?>
                        <strong>Teléfono:</strong> <?php echo $mamihockyemisiones_telefono ?><br>
                        <strong>Correo electrónico:</strong> <a
                                href="mailto:<?php echo $mamihockyemisiones_mail ?>"><?php echo $mamihockyemisiones_mail ?></a>
                    </p>
                    <h5>Redes sociales</h5>
					<?php $mamihockyemisiones_facebook_text = get_theme_mod( 'mamihockyemisiones_facebook_text' ); ?>
					<?php $mamihockyemisiones_twitter_text = get_theme_mod( 'mamihockyemisiones_twitter_text' ); ?>
					<?php $mamihockyemisiones_instagram_text = get_theme_mod( 'mamihockyemisiones_instagram_text' ); ?>

                    <div class="social-share">
                        <ul class="list-inline">
                            <li><a target="_blank" href="<?php echo $mamihockyemisiones_facebook_text; ?>"><i
                                            class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" href="<?php echo $mamihockyemisiones_twitter_text; ?>"><i
                                            class="fa fa-twitter "></i></a></li>
                            <li><a target="_blank" href="<?php echo $mamihockyemisiones_instagram_text; ?>"><i
                                            class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>

<!--<script src="./node_modules/jquery/dist/jquery.min.js"></script>-->
<!--<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>-->


</body>
</html>