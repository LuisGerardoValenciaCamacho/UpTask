<?php foreach($alertas as $key => $value) : ?>    
    <?php foreach($value as $mensaje) : ?>
        <div class="alerta <?php echo $key; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>