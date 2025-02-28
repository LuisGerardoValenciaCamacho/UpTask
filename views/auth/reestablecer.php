<div class="title azul mt">
    <h1>UpTask</h1>
    <h3>Crea y Administra tus Proyectos</h3>
    <p>Actualiza tu Password Nuevo</p>
</div>
<section class="contenedor-sm contenedor">
    <?php include_once __DIR__ . "/../templates/alertas.php" ?>
    <form class="formulario" method="POST" action="/recuperar-password">
        <div class="campo">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <input type="submit" value="Actualizar" class="btn-azul">
    </form>
    <section class="formulario-extra azul">
        <div>
            <form method="GET" action="/"><input type="submit" value="¿Ya tienes una cuenta? Iniciar Sesión" class="registro"></form>
        </div>
        <div>
            <form method="GET" action="/password"><input type="submit" value="¿Olvidaste tu Password?" class="password"></form>
        </div>
    </section>
</section>