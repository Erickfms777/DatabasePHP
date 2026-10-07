<?php 
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
 ?>
<div id="menu">
  <nav class="menu">
      <div style="position:relative;z-index:5;">
        <ul class="nav">
            <li><a  href="inventariosmonograf.php">Inicio</a></li>        
              <?php if (parametrizarpermisos()==1){ ?> 
              <?php if(usuariosmenuprincipal()==1){?><li><a href="cat-usuarios.php" target="_top">Usuarios</a></li> <?php }?> 
              <li><a href="cat-almacenes.php" target="_top">Almacenes</a></li>
              <li><a href="cat-productos.php" target="_top">Productos</a></li>
             <?php } ?>
              <?php if (parametrizarpermisos()==1){ ?> 
              <li><a href="movimientos.php">Movimientos al Inventario</a></li>
             <?php } ?>
             
            <li><a href="terminar.php">Cerrar Sesión</a></li>
        </ul>
        </div>
    </nav>  
</div>
