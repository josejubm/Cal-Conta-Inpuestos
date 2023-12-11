<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora ISR</title>
    <!-- Agregar enlaces a Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 border p-4 bg-white">
        <!-- Sección: Datos de la Persona -->
        <h2>Datos de la Persona</h2>
        <form>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="rfc" class="form-label">RFC</label>
                <input type="text" class="form-control" id="rfc" name="rfc" required>
            </div>
            <div class="mb-3">
                <label for="curp" class="form-label">CURP</label>
                <input type="text" class="form-control" id="curp" name="curp" required>
            </div>
            <button type="submit" class="btn btn-primary">Siguiente</button>
        </form>
        </div>

    <div class="container mt-5 border p-4 bg-white">
        <!-- Sección: Gastos -->
        <h2>Gastos</h2>
        <form>
        <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="compras" class="form-label">Compras</label>
                <input type="number" class="form-control" id="compras" name="compras" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="combustibles" class="form-label">Combustibles y Lubricantes</label>
                <input type="number" class="form-control" id="combustibles" name="combustibles" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="mantenimiento" class="form-label">Mantenimiento de Equipo de Transporte</label>
                <input type="number" class="form-control" id="mantenimiento" name="mantenimiento" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="cuota_imss" class="form-label">Cuota IMSS, RVC e Infonavit</label>
                <input type="number" class="form-control" id="cuota_imss" name="cuota_imss" step="0.01" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="diversos" class="form-label">Diversos</label>
                <input type="number" class="form-control" id="diversos" name="diversos" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="depreciaciones" class="form-label">Depreciaciones</label>
                <input type="number" class="form-control" id="depreciaciones" name="depreciaciones" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="comisiones_bancarias" class="form-label">Comisiones Bancarias</label>
                <input type="number" class="form-control" id="comisiones_bancarias" name="comisiones_bancarias" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="sueldos_salarios" class="form-label">Sueldos y Salarios</label>
                <input type="number" class="form-control" id="sueldos_salarios" name="sueldos_salarios" step="0.01" required>
            </div>
        
    
    <?php
// Aquí deberías tener lógica para obtener los resultados de ingresos y deducciones
$resultadosIngresosDeducciones = [
    ['concepto' => 'Ingresos Mensuales', 'cantidad' => '$5,000.00'],
    ['concepto' => 'Deducciones Mensuales', 'cantidad' => '$1,000.00'],
    // Agrega más resultados según sea necesario
];
?>


<h4>Resultado de Ingresos y Deducciones Mensuales</h4>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Concepto</th>
            <th scope="col">Cantidad</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultadosIngresosDeducciones as $resultado): ?>
            <tr>
                <td><?= $resultado['concepto'] ?></td>
                <td><?= $resultado['cantidad'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </div>

<div class="container mt-5 border p-4 bg-white">

<div class="container mt-4">
    <h2>Tabla de Contadores</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">N° Lista</th>
                <th scope="col">Cédula</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Usuario</th>
                <th scope="col">Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            <!-- Datos de Contadores -->
            <tr>
                <th scope="row">1</th>
                <td>123456789</td>
                <td>Juan</td>
                <td>Pérez</td>
                <td>juanperez</td>
                <td>2023-12-15</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>987654321</td>
                <td>Maria</td>
                <td>López</td>
                <td>marialopez</td>
                <td>2023-12-16</td>
            </tr>
            <!-- Puedes agregar más filas según tus datos -->
        </tbody>
    </table>
</div>
        
<!-- Sección de Datos a Calcular -->
<div class="row">
    <div class="col-md-6">
        <h4>Datos a Calcular</h4>
        <form action="" method="post">
            <label for="mes">Mes:</label>
            <!-- Agrega tu combo para seleccionar el mes aquí -->
            <select name="mes" id="mes" class="form-control" required>
                <option value="enero">Enero</option>
                <!-- Agrega más opciones según sea necesario -->
            </select>

            <label for="ingresos_gravados">Ingresos Gravados:</label>
            <input type="text" name="ingresos_gravados" class="form-control" required>

            <label for="deduccion">(-) Deducción:</label>
            <input type="text" name="deduccion" class="form-control" required>

            <label for="perdida_fiscal">(-) Pérdida Fiscal de Ejercicios:</label>
            <input type="text" name="perdida_fiscal" class="form-control" required>

            <label for="impuesto_cargo">(=) Impuesto a Cargo:</label>
            <input type="text" name="impuesto_cargo" class="form-control" required>

            <label for="pagos_provisionales">(-) Pagos Provisionales Efecto Anterior:</label>
            <input type="text" name="pagos_provisionales" class="form-control" required>

            <label for="subsidio_empleo">Subsidio al Empleo:</label>
            <input type="text" name="subsidio_empleo" class="form-control" required>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
    </div>

    <div class="col-md-6">
        <h4>Tabla de Datos para Cálculo</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Límite Inferior</th>
                    <th scope="col">Límite Superior</th>
                    <th scope="col">Cuota Fija</th>
                    <th scope="col">% sobre el Excedente</th>
                </tr>
            </thead>
            <tbody>
                <!-- Agrega datos de ejemplo o resultados reales de tus consultas -->
                <tr>
                    <td>$0.00</td>
                    <td>$10,000.00</td>
                    <td>$500.00</td>
                    <td>10%</td>
                </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>


<div class="container mt-5 border p-4 bg-white">
<!-- Sección de Cálculo de Impuesto sobre la Renta -->
<div class="row">
    <div class="col-md-6">
        <h4>Cálculo de Impuesto sobre la Renta</h4>
        <form action="" method="post">
            <label for="mes_calculo">Seleccionar Mes:</label>
            <!-- Agrega tu combo para seleccionar el mes aquí -->
            <select name="mes_calculo" id="mes_calculo" class="form-control" required>
                <option value="enero">Enero</option>
                <!-- Agrega más opciones según sea necesario -->
            </select>

            <!-- Agrega campos adicionales según sea necesario -->

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
    </div>


<div class="col-md-6">
        <h4>Resultados del Cálculo</h4>
        <div class="row">
            <div class="col-md-6">
                <h5>Ingresos y Deducciones</h5>
                <table class="table">
                    <!-- Tabla para mostrar ingresos y deducciones -->
                    <thead>
                        <tr>
                            <th scope="col">Concepto</th>
                            <th scope="col">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Agrega datos de ejemplo o resultados reales de tus consultas -->
                        <tr>
                            <td>Ingresos Gravados</td>
                            <td>$10,000.00</td>
                        </tr>
                        <tr>
                            <td>Deducción</td>
                            <td>($1,000.00)</td>
                        </tr>
                        <!-- Agrega más filas según sea necesario -->
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
            <h5>Cálculos de ISR</h5>
                <table class="table">
                    <!-- Tabla para mostrar cálculos de ISR -->
                    <thead>
                        <tr>
                            <th scope="col">Concepto</th>
                            <th scope="col">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Agrega datos de ejemplo o resultados reales de tus consultas -->
                        <tr>
                            <td>Límite Inferior</td>
                            <td>$0.00</td>
                        </tr>
                        <tr>
                            <td>Base de Impuesto</td>
                            <td>$9,000.00</td>
                        </tr>
                        <tr>
                            <td>Tasa</td>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <td>Impuesto Marginal</td>
                            <td>$900.00</td>
                        </tr>
                        <tr>
                            <td>Cuota Fija</td>
                            <td>$500.00</td>
                        </tr>
                        <tr>
                            <td>Importe ISR</td>
                            <td>$1,400.00</td>
                        </tr>
                        <!-- Agrega más filas según sea necesario -->
                    </tbody>
                </table>
            </div>
        </div>
        <button type="button" class="btn btn-secondary">Editar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-success">Imprimir Reporte (XML)</button>
        </div>
        </div>
    </div>
    <!-- Agregar enlaces a Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
