<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Station</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="antialiased">
  <h1>{{ $station->name }}</h1>

  <main class="m-5 d-flex">
    <div style="width: 25%;">
      <p>{{ $station->3d_gps }}</p>
    </div>
    <div class="m-5 d-flex flex-wrap justify-content-center align-items-center">
      <img class="card-img-top" src="{{ $station->image }}" alt="Card image cap">
    </div>
    <a href="galaxy.php">Back</a>
  </main>

  <main class="mY-5 my-suto d-flex">
    <h1>{{ $station->name }}</h1>

    <div class="container">
      <div class="row">
        <div class="col m-5">
          <p>3D GPS: {{ $station->3d_gps }}</p>
        </div>
        <div class="col m-5">
          <img class="card-img-top" src="{{ $station->image }}" alt="Card image cap">
        </div>
      </div>
      <div class="row">
        <a href="galaxy.php">Back</a>
      </div>
    </div>
  </main>

</body>

</html>