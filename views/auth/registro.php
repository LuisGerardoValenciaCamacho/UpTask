<div class="title morado mt">
    <h1>UpTask</h1>
    <h3>Crea y Administra tus Proyectos</h3>
    <p>Agregar los datos correspondientes</p>
</div>
<section class="contenedor-sm contenedor">
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
    <form class="formulario" method="POST" action="/registro">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" value="<?php echo $usuario->nombre ?>">
        </div>
        <div class="campo">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" placeholder="Tu E-mail" value="<?php echo $usuario->email ?>">
        </div>
        <div class="campo">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $usuario->password ?>">
        </div>
        <div class="campo">
            <label for="passwordReply">Repetir Password:</label>
            <input type="password" name="passwordReply" id="passwordReply" value="<?php echo $usuario->passwordReply ?>">
        </div>
        <input type="submit" value="Registrar" class="btn-morado">
    </form>
    <section class="formulario-extra morado">
        <div>
            <form method="GET" action="/"><input type="submit" value="¿Ya tienes una cuenta? Iniciar Sesión" class="registro"></form>
        </div>
        <div>
            <form method="GET" action="/password"><input type="submit" value="¿Olvidaste tu Password?" class="password"></form>
        </div>
    </section>
</section>