<div class="title morado mt">
    <h1>UpTask</h1>
    <h3>Crea y Administra tus Proyectos</h3>
    <p><?php echo $mensaje; ?></p>
</div>
<section class="contenedor-sm contenedor">
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
    <?php if($mensaje == "Cuenta Confirmada"): ?>
        <section class="formulario">
            <div>
                <form method="GET" action="/"><input type="submit" value="Iniciar Sesión" class="btn-morado"></form>
            </div>
        </section>
    <?php elseif($titulo == "Confirmar Password"): ?>
        <section class="formulario">
            <div>
                <form method="GET" action="/"><input type="submit" value="Iniciar Sesión" class="btn-morado"></form>
            </div>
        </section>
    <?php endif; ?>
</section>