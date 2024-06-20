<?php
/*
Plugin Name: Buscar Destinos en Mapa Plus
Description: Un plugin para buscar destinos en mapaplus.com utilizando un formulario. Agregar shortcode : [buscar_destinos]
Version: 1.0
Author: Eduardo Araiza
*/


// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}


// Registrar los scripts y estilos
function buscar_destinos_enqueue_scripts() {
    wp_enqueue_style('bootstrap-css', plugins_url('css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('select2-css', plugins_url('css/select2.min.css', __FILE__));
    wp_enqueue_script('jquery');
    wp_enqueue_script('popper-js', plugins_url('js/popper.min.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_script('bootstrap-js', plugins_url('js/bootstrap.min.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_script('select2-js', plugins_url('js/select2.min.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_script('buscar-destinos-js', plugins_url('js/buscar-destinos.js', __FILE__), array('jquery', 'select2-js'), null, true);
}
add_action('wp_enqueue_scripts', 'buscar_destinos_enqueue_scripts');

// Crear el shortcode para el formulario
function buscar_destinos_shortcode() {
    ob_start();
    ?>
    <div class="container mt-5">
        <h1>Encuentra tu Circuito o Destino</h1>
        <p>Una vez que encuentres el circuito o destino, debes de llamarnos para solicitar el tour</p>
        <form action="https://www.mapaplus.com/en/availability" method="get" id="search_destinations_form" class="form" role="form" target="_blank">
            <div class="form-row">
                <div class="col-md-8">
                    <label for="zone" class="sr-only">Destinos</label>
                    <select id="zone" multiple="multiple" name="zone" class="form-control" data-nonselectedtext="Destination" data-nselectedtext="destinations" data-allselectedtext="All Selected" data-selectalltext="Select All" data-filterplaceholder="Search" data-filtercleantext="Clear" tabindex="-1">
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-block">Buscar Destinos</button>
                </div>
            </div>
        </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('buscar_destinos', 'buscar_destinos_shortcode');

?>
