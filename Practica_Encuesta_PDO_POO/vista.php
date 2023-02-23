<div class="opcion">
	
<?php

$widthbar= $porcentaje*5;
$estilo="barra";


if ($this->GetOpcionSeleccionada()== $lenguaje['opcion']) {
	$estilo="seleccionado";

}

echo $lenguaje['opcion'];
?>


<div class="<?php echo $estilo; ?>" style="width: <?php echo $widthbar."px;" ?>" >
	<?php echo $porcentaje." %" ?>
	
</div>



</div>