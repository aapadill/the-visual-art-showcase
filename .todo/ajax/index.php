<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php 
        $config = parse_ini_file('config.php');
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $dbh = new PDO($dsn, 'ddd', 'dddd');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    
    if ($_POST) {
        var_dump($_POST);    
    }
    ?>
    <main role="main" class="container">
        <h1>Clientes</h1>
        <form id="frm_empleado" method="POST" action="index.php">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="firstName">Nombre(s)</label>
                <input type="text" class="form-control"
                    name="firstName" id="firstName" placeholder="Nombre(s)">
            </div>
            <div class="form-group col-md-5">
                <label for="lastName">Apellido(s)</label>
                <input type="text" class="form-control" 
                    name="lastName" id="lastName" placeholder="Apellido(s)">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="email">Correo</label>
                <input type="email" class="form-control" 
                name="email" id="email" placeholder="correo@classicmodelcars.com">
            </div>
            <div class="form-group col-md-5">
                <label for="extension">Extension</label>
                <input type="text" class="form-control" 
                name="extension" id="extension" placeholder="x0000" maxlength="10">
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-5">
                <label for="jobTitle">Cargo</label>
                <input type="text" class="form-control" name="jobTitle" id="jobTitle" placeholder="Cargo">
            </div>
            <div class="form-group col-md-5">
                <label for="reportsTo">Jefe </label>
                <select name="reportsTo" id="reportsTo" class="form-control">
                    <option value="">-- N/A --</option>                    
                </select>
            </div>
        </div>
        <div class="form-group col-md-5">
            <label for="officeCode"><i id="officeCodeLoading" class="fas fa-spinner fa-spin d-none">&nbsp;</i>Oficina</label>
            <select name="officeCode" id="officeCode" class="form-control">
                <option value="">-- Selecciona una opci&oacute;n --</option>
            </select>
        </div>                
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</body>
</html>