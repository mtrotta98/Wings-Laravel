<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Recibo</title>
  </head>
  <style>
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }

      th {
          text-align: left;
          background-color: #c8c8c8;
      }
  </style>
  <body>
    <div class="row">
        <div class="col-4">
            <h4>Recibo</h4>
        </div>
        <div class="col-4" style="padding-left: 600px">
            <img src="{{ public_path('images/logo_wings.jpg') }}" alt="Wings" class="brand-image"
             style="opacity: .8; width: 80px; height: 80px">
            <br/>
            <span class="brand-text font-weight-light"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-5" style="padding-top: 20px">
            <h6>{{ $remitente }}</h6>
            <h6>{{ $direccion }}</h6>
            <h6>{{ $telefono }}</h6>
        </div>
        <div class="col-5" style="padding-left: 580px; padding-top: 20px">
            <h6>Nro Recibo: {{ $cant }}</h6>
            <h6>Fecha: {{ date('Y-m-d') }}</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <h6>Nombre y Apellido: {{ $alumno->nombre }} {{ $alumno->apellido }}</h6>
            <h6>Dni: {{ $alumno->dni }}</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table style="width: 100%; padding-top: 30px">
                <tr>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Precio Total</th>
                </tr>
                <tr>
                    <td>Pago de cuota: {{ $cc->cuota }}</td>
                    <td>1</td>
                    <td>${{ $cc->monto }}</td>
                    <td>${{ $cc->monto }}</td>
                </tr>
            </table>
            <table style="width: 100%; padding-top: 10px; padding-left: 373px">
                <tr>
                    <td style="width: 177px">Total</td>
                    <td>${{ $cc->monto }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="padding-top: 400px; padding-left: 200px">
            <p style="font-size: 10">Los pagos deben realizarse del dia 1 al 10 de cada mes</p>
            <p style="font-size: 10">*Documento no valido como factura</p>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>