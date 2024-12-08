<?php
require_once 'models/ServicioModel.php';

class ServicioController {
    public function listarServicios() {
        $model = new ServicioModel();
        $servicios = $model->obtenerServicios();

        require 'views/servicios.php';
    }

    public function obtenerDetallesServicios($servicio_id) {
        $model = new ServicioModel();
        $servicio = $model->obtenerDetallesServicio($servicio_id);

        require 'views/detallesServicio.php';
    }
}
?>
