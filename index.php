<!DOCTYPE html>
<html>
<head>
  <title>Mi Curriculum Web</title>
  <link rel="stylesheet" href="style.css">

  <meta charset="UTF-8">

</head>
<body>


  <?php
  header('Content-Type: text/html; charset=UTF-8');

  include 'conexion/conexion.php';

  // Consulta para obtener los datos personales
  $sql = "SELECT nombre, telefono, direccion, sitio_web, correo_electronico FROM datospersonales";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<div class='card'>";
    echo "<div class='card-front'>";
    echo "<div class='profile-pic'><img src='img/Perfil/fotoperfil.jpg' alt='Foto de perfil'></div>";
    echo "<p class='p-front'><strong class='hover-effect'>Nombre:</strong> " . $row["nombre"] . "</p>";
    echo "<p class='p-front'><strong class='hover-effect'>Teléfono:</strong> " . $row["telefono"] . "</p>";
    echo "<p class='p-front'><strong class='hover-effect'>Correo electrónico:</strong> " . $row["correo_electronico"] . "</p>";
    
    echo "</div>";
    echo "<div class='card-back'>";
    echo "<div class='centrado'>";
  
    echo "<p><strong class='hover-effect'>Sitio web:</strong> <a href='" . $row["sitio_web"] . "'>" . $row["sitio_web"] . "</a></p>";
    echo "<p><strong class='hover-effect'>Dirección:</strong> " . $row["direccion"] . "</p>";

    echo "</div>";
    echo "</div>";
    echo "</div>";  
}
   else {
    echo "No se encontraron datos personales.";
  }

 // Consulta para obtener los conocimientos
$sql_conocimientos = "SELECT software, nivel FROM conocimientos WHERE id_datos_personales = 1";
$result_conocimientos = mysqli_query($conn, $sql_conocimientos);

if (mysqli_num_rows($result_conocimientos) > 0) {
  echo "<h2 class='hover-effect'>Conocimientos</h2>";
  echo "<div class='conocimientos-container'>";
  while ($row_conocimientos = mysqli_fetch_assoc($result_conocimientos)) {
    $class = strtolower($row_conocimientos["nivel"]);
    $software = $row_conocimientos["software"];
    $software_nombre_imagen = strtolower(str_replace(' ', '_', $software)); // Reemplazamos espacios por guiones bajos y convertimos a minúsculas

    echo "<div class='conocimiento flip-card'>";
    echo "<div class='flip-card-inner'>";
    echo "<div class='flip-card-front'>";
    echo "<img class='conocimiento-logo' src='img/logos/" . $software_nombre_imagen . ".png' alt='" . $software . "'>";
    echo "<p class='conocimiento-nivel " . $class . "'>" . strtoupper($row_conocimientos["nivel"]) . "</p>";
    echo "</div>";
    echo "<div class='flip-card-back'>";
    echo "<p class='conocimiento-nombre'>" . $software . "</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
  echo "</div>";
} else {
  echo "No se encontraron conocimientos.";
}



  // Consulta para obtener la experiencia laboral
$sql_experiencia = "SELECT empresa, fecha_inicio, fecha_fin, descripcion FROM experiencialaboral WHERE id_datos_personales = 1";
$result_experiencia = mysqli_query($conn, $sql_experiencia);

if (mysqli_num_rows($result_experiencia) > 0) {
  echo "<h2 class='hover-effect'>Experiencia Laboral</h2>";
  echo "<div class='grid-container'>";
  while ($row_experiencia = mysqli_fetch_assoc($result_experiencia)) {
    echo "<div class='grid-item'>";
    echo "<h3 class='hover-effect'>" . $row_experiencia['empresa'] . "</h3>";
    if (empty($row_experiencia['fecha_fin'])) {
      echo "<p><strong class='hover-effect'>Duración:</strong> Actualmente</p>";
    } else {
      $fecha_fin = date('Y', strtotime($row_experiencia['fecha_fin']));
      $fecha_inicio = date('Y', strtotime($row_experiencia['fecha_inicio']));
      echo "<p><strong class='hover-effect'>Duración:</strong> " . $fecha_inicio . " - " . $fecha_fin . "</p>";
    }
    echo "<p class='hover-effect'>" . $row_experiencia['descripcion'] . "</p>";
    echo "<hr class='hover-effect'>";
    echo "</div>";
  }
  echo "</div>";
} else {
  echo "No se encontraron datos de experiencia laboral.";
}


// Consulta para obtener las habilidades
$sql_habilidades = "SELECT habilidad, descripcion FROM habilidades WHERE id_datos_personales = 1";
$result_habilidades = mysqli_query($conn, $sql_habilidades);

if (mysqli_num_rows($result_habilidades) > 0) {
  echo "<h2 class='hover-effect'>Habilidades:</h2>";
  echo "<div class='habilidades-container'>";
  while ($row_habilidades = mysqli_fetch_assoc($result_habilidades)) {
    $habilidad = $row_habilidades["habilidad"];
    $descripcion = $row_habilidades["descripcion"];
    echo "<div class='habilidad'>";
    echo "<img class='habilidad-logo' src='img/logos/$habilidad.png' alt='$habilidad'>";
    echo "<div class='habilidad-info'>";
    echo "<p class='habilidad-nombre'>$habilidad</p>";
    echo "<p class='habilidad-descripcion'>$descripcion</p>";
    echo "</div>";
    echo "</div>";
  }
  echo "</div>";
} else {
  echo "No se encontraron habilidades.";
}

  // Consulta para obtener los proyectos personales
$sql_proyectos = "SELECT nombre_proyecto, descripcion, tecnologias, enlace FROM proyectospersonales WHERE id_datos_personales = 1";
$result_proyectos = mysqli_query($conn, $sql_proyectos);

if (mysqli_num_rows($result_proyectos) > 0) {
  echo "<h2 class='hover-effect'>Proyectos Personales:</h2>";
  echo "<div class='proyectos-container'>";
  while ($row_proyectos = mysqli_fetch_assoc($result_proyectos)) {
    $nombre_proyecto = $row_proyectos["nombre_proyecto"];
    $descripcion = $row_proyectos["descripcion"];
    $tecnologias = $row_proyectos["tecnologias"];
    $enlace = $row_proyectos["enlace"];
    echo "<div class='proyecto'>";
    echo "<p class='proyecto-nombre'>$nombre_proyecto</p>";
    echo "<p class='proyecto-descripcion'>$descripcion</p>";
    echo "<p class='proyecto-tecnologias'>$tecnologias</p>";
    echo "<p class='proyecto-enlace'><a href='$enlace'>$enlace</a></p>";
    echo "</div>";
  }
  echo "</div>";
} else {
  echo "No se encontraron proyectos personales.";
}

//Consulta para obtener los certificados
echo "<h2 class='hover-effect'>Certificados</h2>";
$sql_certificados = "SELECT id_certificado, nombre_curso, nombre_certificado FROM certificados";
$result_certificados = mysqli_query($conn, $sql_certificados);
if (mysqli_num_rows($result_certificados) > 0) {
  echo "<div class='certificados-container'>";
  while ($row_certificados = mysqli_fetch_assoc($result_certificados)) {
    $id_certificado = $row_certificados["id_certificado"];
    $nombre_curso = $row_certificados["nombre_curso"];
    $nombre_certificado = $row_certificados["nombre_certificado"];

    // Obtener el nombre de la imagen
    $imagen_certificado = $nombre_certificado . ".jpg";

    // Aquí puedes hacer lo que necesites con los datos obtenidos, por ejemplo, mostrar la imagen
    echo "<div class='certificado'>";
    echo "<h3>Nombre del Curso: " . $nombre_curso . "</h3>";
    echo "<img src='img/certificados/" . $imagen_certificado . "' alt='Certificado'>";
    echo "</div>";
  }
  echo "</div>";
} else {
  echo "<p class='no-certificados'>No se encontraron certificados.</p>";
}




// Consulta para obtener las referencias laborales
$sql_referencias_laborales = "SELECT nombre_referencia, telefono_referencia, empresa_referencia FROM referenciaslaborales WHERE id_datos_personales = 1";
$result_referencias_laborales = mysqli_query($conn, $sql_referencias_laborales);

if (mysqli_num_rows($result_referencias_laborales) > 0) {
  echo "<h2 class='hover-effect'>Referencias Laborales:</h2>";
  echo "<div class='referencias-container'>";
  while ($row_referencias_laborales = mysqli_fetch_assoc($result_referencias_laborales)) {
    $nombre_referencia = $row_referencias_laborales["nombre_referencia"];
    $telefono_referencia = $row_referencias_laborales["telefono_referencia"];
    $empresa_referencia = $row_referencias_laborales["empresa_referencia"];
    echo "<div class='referencia'>";
    echo "<p class='referencia-nombre'>$nombre_referencia</p>";
    echo "<p class='referencia-datos'>$telefono_referencia - $empresa_referencia</p>";
    echo "</div>";
  }
  echo "</div>";
} else {
  echo "No se encontraron referencias laborales.";
}

// Consulta para obtener las referencias personales
$sql_referencias_personales = "SELECT nombre_referencia, telefono_referencia FROM referenciaspersonales WHERE id_datos_personales = 1";
$result_referencias_personales = mysqli_query($conn, $sql_referencias_personales);

if (mysqli_num_rows($result_referencias_personales) > 0) {
  echo "<h2 class='hover-effect'>Referencias Personales:</h2>";
  echo "<div class='referencias-container'>";
  while ($row_referencias_personales = mysqli_fetch_assoc($result_referencias_personales)) {
    $nombre_referencia = $row_referencias_personales["nombre_referencia"];
    $telefono_referencia = $row_referencias_personales["telefono_referencia"];
    echo "<div class='referencia'>";
    echo "<p class='referencia-nombre'>$nombre_referencia</p>";
    echo "<p class='referencia-datos'>$telefono_referencia</p>";
    echo "</div>";
  }
  echo "</div>";
} else {
  echo "No se encontraron referencias personales.";
}

  mysqli_close($conn);
  ?>
  
</body>
</html>
