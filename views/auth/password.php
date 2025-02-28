<div class="title rosa mt">
    <h1>UpTask</h1>
    <h3>Crea y Administra tus Proyectos</h3>
    <p>Agregar tu Password Nuevo</p>
</div>
<section class="contenedor-sm contenedor">
    <?php include_once __DIR__ . "/../templates/alertas.php" ?>
    <form class="formulario" method="POST" action="/password">
        <div class="campo">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" placeholder="Tu E-mail">
        </div>
        <input type="submit" value="Enviar" class="btn-rosa">
    </form>
    <section class="formulario-extra rosa">
        <div>
            <form method="GET" action="/"><input type="submit" value="¿Ya tienes una cuenta? Iniciar Sesión" class="registro"></form>
        </div>
        <div>
            <form method="GET" action="/password"><input type="submit" value="¿Olvidaste tu Password?" class="password"></form>
        </div>
    </section>
</section>