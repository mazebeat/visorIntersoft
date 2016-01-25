<?php
include __DIR__ . '/bootstrap/start.php';
$_SESSION['BASE64'] = '';

if (!isset($_SESSION['LOGOEMPRESA'])) {
    $_SESSION['LOGOEMPRESA'] = LOGO_EMPRESA;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WebService Base64 Viewer</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        body {
            zoom: 95%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="logo" class="text-center">
                <h1 class="text-center"><img src="../public/images/<?php echo $_SESSION['LOGOEMPRESA']; ?>" alt="logo" class=""></h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <form class="form-horizontal" role="form" action="/" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <label for="primerNombreTomador">Primer Nombre: </label>
                                <input type="text" name="primerNombreTomador" id="primerNombreTomador" class="form-control input-sm" value="<?php InitProcess::valueField('primerNombreTomador') ?>">
                            </div>
                            <div class="col-xs-4">
                                <label for="direccionTomador">Dirección: </label>
                                <input type="text" name="direccionTomador" id="direccionTomador" class="form-control input-sm" value="<?php InitProcess::valueField('direccionTomador') ?>">
                            </div>
                            <div class="col-xs-4">
                                <label for="ciudadTomador">Ciudad: </label>
                                <input type="text" name="ciudadTomador" id="ciudadTomador" class="form-control input-sm" value="<?php InitProcess::valueField('ciudadTomador') ?>">
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="numeroCertificado">Número Certificado: </label>
                                <input type="text" name="numeroCertificado" id="numeroCertificado" class="form-control input-sm" value="<?php InitProcess::valueField('numeroCertificado') ?>">
                            </div>
                            <div class="col-xs-3">
                                <label for="numeroPoliza">Número Póliza: </label>
                                <input type="text" name="numeroPoliza" id="numeroPoliza" class="form-control input-sm" value="<?php InitProcess::valueField('numeroPoliza') ?>">
                            </div>
                            <div class="col-xs-3">
                                <label for="numeroFactura">Número Factura: </label>
                                <input type="text" name="numeroFactura" id="numeroFactura" class="form-control input-sm" value="<?php InitProcess::valueField('numeroFactura') ?>">
                            </div>
                            <div class="col-xs-3">
                                <label for="numeroRiesgo">Número Riesgo: </label>
                                <input type="text" name="numeroRiesgo" id="numeroRiesgo" class="form-control input-sm" value="<?php InitProcess::valueField('numeroRiesgo') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <label for="fechaExpedicion">Fecha Expedición: </label>
                                <input type="text" name="fechaExpedicion" id="fechaExpedicion" class="form-control input-sm" value="<?php InitProcess::valueField('fechaExpedicion') ?>">
                            </div>
                            <div class="col-xs-8">
                                <label for="tipoModificacion">Tipo de Modificación: </label>
                                <input type="text" name="tipoModificacion" id="tipoModificacion" class="form-control input-sm" value="<?php InitProcess::valueField('tipoModificacion') ?>">
                            </div>
                        </div>
                        <input type="submit" name="Submit" value="GENERAR" class="btn btn-default pull-right">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Submit'])) {

        $init = new InitProcess();
        $init->init();

        if ($_SESSION['BASE64'] != '') {
            ?>
            <div class="row">
                <div class="col-sm-8 col-offset-sm-8">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" allowtransparency="allowtransparency" frameborder="0" src="data:application/pdf;base64,<?php echo $_SESSION['BASE64'] ?>"></iframe>
                    </div>
                </div>
            </div>
            <?php
        }

        if ($_SESSION['ERROR'] != '') {
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Oh!</strong> <?php echo $_SESSION['ERROR']; ?>.
                    </div>
                </div>
            </div>
            <?php
        }
    } ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>