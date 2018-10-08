<form role="search" method="get" class="form-inline mt-2 mt-md-0" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="s"
           value="<?php echo get_search_query(); ?>">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
</form>