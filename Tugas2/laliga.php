<?php
$sumber = 'https://apiv3.apifootball.com?action=get_teams&APIkey=7119d97d02940f99ce4271e9189d2df4bb98f44487a0a5f0785161b42f5532d8&league_id=302';
$data = file_get_contents($sumber);
$konten = json_decode($data, true);
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TUGAS 2 - EAI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg" style="background-color: #afe1af;"">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">KC<span class="fw-bold">Football</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active text-white" aria-current="page" href="index.html">Leagues</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active text-white" href="klasemen2.php">Standings</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container">
      <div class="row">
        <div class="col text-center mt-3 mb-3">
          <h1>TEAMS</h1>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-center">
      <div class="col-md-10 card-container">
        <div class="row justify-content-center">
          <?php foreach ($konten as $negara) {
          ?>
          <div class="col-md-4 mb-3" style="width: 15rem;">
            <div class="card shadow-sm p-3 mb-5 bg-white rounded mx-auto " >
              <img src=" <?php echo $negara ['team_badge'] ?>" class="card-img-mid" alt="...">
              <div class="card-body">
                <p class="card-text text-center"> <?php echo $negara ['team_name'] ?></p>
              </div>
            </div>  
          </div>
          <?php }?>
        </div>
      </div>
    </div>
  
  </body>
</html>