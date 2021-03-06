<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Listado</title>
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
            @if ($activos == 1)
                <h4>Listado alumnos activos</h4>
            @else
                <h4>Listado alumnos inactivos</h4>
            @endif
        </div>
        <div class="col-4" style="padding-left: 600px">
            <img src="{{ public_path('images/logo_wings.jpg') }}" alt="Wings" class="brand-image"
             style="opacity: .8; width: 80px; height: 80px">
            <br/>
            <span class="brand-text font-weight-light"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table style="width: 100%; padding-top: 30px">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Curso</th>
                </tr>
                    @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->id }}</td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->apellido }}</td>
                        <td>{{ $alumno->curso }}</td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>