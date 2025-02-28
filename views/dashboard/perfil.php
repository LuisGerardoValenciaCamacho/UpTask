<section class="dashboard">
    <?php include_once __dir__ . "/../templates/sidebar.php"?>
    <section class=" contenido">        
        <?php include_once __DIR__ . "/../templates/barra.php"; ?>
        <h3>Perfil</h3>
        <section class="contenedor-sm">
            <?php include_once __DIR__ . "/../templates/alertas.php" ?>
            <form class="formulario" method="POST" action="/perfil">
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" value="<?php echo $usuario->nombre ?>">
                </div>
                <div class="campo">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" id="email" placeholder="Tu E-mail" value="<?php echo $usuario->email ?>" disabled>
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
        </section>
    </section>
</section>
<?php $script = "<script src='/build/js/app.js'></script>"; ?>