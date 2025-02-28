<section class="dashboard">
    <?php include_once __dir__ . "/../templates/sidebar.php"?>
    <section class=" contenido">        
        <?php include_once __DIR__ . "/../templates/barra.php"; ?>
        <h3>Proyectos</h3>
        <div class="contenido-proyectos">
            <?php if(is_null($proyectos)): ?>
                <div class="no-proyectos">
                    <p>No Hay Proyectos Aún</p> <form method="GET" action="/crear-proyecto"><input type="submit" value="Comienza Creando uno" ></form>
                </div>
            <?php else: ?>
                <div class="proyectos">
                    <?php foreach($proyectos as $project): ?>
                        <form class="proyecto" method="GET" action="/proyecto">
                            <input type="hidden" value="<?php echo $project->url; ?>" name="url">
                            <input type="submit" value="<?php echo $project->proyecto ?>">
                        </form>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</section>
<?php $script = "<script src='/build/js/app.js'></script>"; ?>