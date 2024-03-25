<?php
$sumber = 'https://apiv3.apifootball.com?action=get_standings&APIkey=7119d97d02940f99ce4271e9189d2df4bb98f44487a0a5f0785161b42f5532d8&league_id=152';
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
              <a class="nav-link active text-white" href="klasemen.php">Standings</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- content -->
    <div class="container">
      <div class="row">
        <div class="col text-center mt-3 mb-3">
          <h1>STANDINGS</h1>
        </div>
      </div>
    </div>
    
    <div class="row justify-content-center">
      <div class="col-md-8">
        <table class="table table-hover">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-center">Pos</th>
              <th scope="col" class="text-center">Team</th>
              <th scope="col" class="text-center">M</th>
              <th scope="col" class="text-center">W</th>
              <th scope="col" class="text-center">D</th>
              <th scope="col" class="text-center">L</th>
              <th scope="col" class="text-center">GF</th>
              <th scope="col" class="text-center">GA</th>
              <th scope="col" class="text-center">Pts</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php foreach ($konten as $team) { ?>
            <tr>
              <th scope="row" class="text-center"><?= $team['overall_league_position']?></th>
              <td>
                <img src="<?= $team['team_badge']?>" alt="Team Badge"  style="width: 25px; height: auto;">
                <?= $team['team_name']?>
              </td>
              <td class="text-center"><?= $team['overall_league_payed']?></td>
              <td class="text-center"><?= $team['overall_league_W']?></td>
              <td class="text-center"><?= $team['overall_league_D']?></td>
              <td class="text-center"><?= $team['overall_league_L']?></td>
              <td class="text-center"><?= $team['overall_league_GF']?></td>
              <td class="text-center"><?= $team['overall_league_GA']?></td>
              <td class="text-center"><?= $team['overall_league_PTS']?></td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  
  </body>
</html>