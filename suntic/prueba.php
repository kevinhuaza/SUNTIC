<?php 
include("conexion.php");
session_start();
if (isset($_GET["email"]) && !empty($_GET["email"]) AND isset($_GET["token"]) && !empty($_GET["token"])	) {
	$correo = mysqli_real_escape_string($conexion,$_GET['email']);
	$token  = mysqli_real_escape_string($conexion,$_GET['token']);
	
	$sql = "SELECT * FROM usuarios WHERE email = '$correo' AND token2 = '$token' AND estado2 = '0' ";
	$resultado = $conexion->query($sql);
	$rows = $resultado->num_rows;
	if ($rows === 0) {
		echo "<script>
				alert('Tu cuenta ya fue activada o la URL es incorrecta!');
				window.location = 'admin.php';
		</script>";
		
	}else{
		$sqlA = "UPDATE usuarios SET estado2 = '1' WHERE email='$correo'";
		$resultadoA = $conexion->query($sqlA);
		echo "<script>
				alert('Tu cuenta ha sido activada !');
				window.location = 'admin.php';
		</script>";
	}
}else{
	echo "<script>
				alert('La URL contiene información incorrecta!');
				window.location = 'index.php';
		</script>";
}

?>