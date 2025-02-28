<div class="title cyan mt">
    <h1>UpTask</h1>
    <h3>Crea y Administra tus Proyectos</h3>
    <p>Iniciar Sesión</p>
</div>
<section class="contenedor-sm contenedor">
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
    <form class="formulario" method="POST" action="/">
        <div class="campo">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" placeholder="Tu E-mail">
        </div>
        <div class="campo">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <input type="submit" value="Iniciar Sesión" class="btn-cyan">
    </form>
    <section class="formulario-extra cyan">
        <div>
            <form method="GET" action="/registro"><input type="submit" value="¿Aún no tienes una cuenta? Obtener Una" class="registro"></form>
        </div>
        <div>
            <form method="GET" action="/password"><input type="submit" value="¿Olvidaste tu Password?" class="password"></form>
        </div>
    </section>
</section>