<section class="dashboard">
    <?php include_once __dir__ . "/../templates/sidebar.php"?>
    <section class=" contenido">        
        <?php include_once __DIR__ . "/../templates/barra.php"; ?>
        <h3><?php echo $proyecto ?></h3>
        <div class="contenido-proyectos contenido" id="padre">
            <?php include_once __DIR__ . "/../templates/alertas.php" ?>
            <div class="center">
                <button type="button" id="agregar-tarea" class="center btn-cyan">&#43; Nueva Tarea</button>
            </div>
            <form class="filtros contenedor-sm">
                <label class="name-filtros">Filtros:</label>
                <div class="value-filtros">
                    <label for="todas">Todas</label>
                    <input type="radio" value="todas" id="todas" name="filtro" checked>
                </div>
                <div class="value-filtros">
                    <label for="completadas">Completadas</label>
                    <input type="radio" value="completadas" id="completadas" name="filtro">
                </div>
                <div class="value-filtros">
                    <label for="pendientes">Pendientes</label>
                    <input type="radio" value="pendientes" id="pendientes" name="filtro">
                </div>
            </form>
        </div>
    </section>
</section>
<?php $script = "<script src='/build/js/tareas.js'></script>"; ?>
<?php $script .= "<script src='/build/js/filtro.js'></script>"; ?>
<?php $script .= '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; ?>