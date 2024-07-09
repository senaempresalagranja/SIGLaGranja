<!-- Descripcion la creacion la parte del ingreso como Administrador o como Usuario-->
<form action="login.php" method="post">
	<table width="100%">
		<tr>
			<td width="100px">
				
			</td>
			<td>
				<?php 
					if(isset($_GET['error']))
					{
						echo '<b><h3><center>Usuario o Contraseña Inválido</h3></b>';
					}
				?>
			</td>
			<td width="50%">
				Iniciar Sesión
				<input type="text" id="usuario" name="usuario" placeholder="Usuario" class="inp-ing" onkeyup="this.value=this.value.toUpperCase()" required/>
				<input type="password" id="password" name="password" placeholder="Contraseña" class="inp-ing"  onkeyup="this.value=this.value.toUpperCase()" required/>
				<input type="submit" value="Ingresar" class="inp-button">
			</td>
		</tr>
	</table>
</form>