<section class="dashboard">
    <?php include_once __dir__ . "/../templates/sidebar.php"?>
    <section class=" contenido">        
        <?php include_once __DIR__ . "/../templates/barra.php"; ?>
        <h3>Proyectos</h3>
        <section class="contenedor-sm">
            <?php include_once __DIR__ . "/../templates/alertas.php" ?>
            <form method="POST" action="/crear-proyecto">
                <div class="formulario-dashboard">
                    <label for="proyecto">Nombre del Proyecto:</label>
                    <input type="text" placeholder="Proyecto" id="proyecto" name="proyecto">
                </div>
                <input type="submit" value="Crear Proyecto" class="btn-indigo">
            </form>
        </section>
    </section>
</section>
<?php $script = "<script src='/build/js/app.js'></script>"; ?>