<?php
$sumber = 'https://apiv3.apifootball.com?action=get_teams&APIkey=7119d97d02940f99ce4271e9189d2df4bb98f44487a0a5f0785161b42f5532d8&league_id=152';
$data = file_get_contents($sumber);
$konten = json_decode($data, true);
?>


<!DOCTYPE html>
<html>
  <head>
@@ -45,17 +38,13 @@
    <div class="d-flex justify-content-center">
      <div class="col-md-10 card-container">
        <div class="row justify-content-center">
          <?php foreach ($konten as $team) {
          ?>
          <div class="col-md-4 mb-3" style="width: 15rem;">
            <div class="card shadow-sm p-3 mb-5 bg-white rounded mx-auto " >
              <img src=" <?php echo $team ['team_badge'] ?>" class="card-img-mid" alt="...">
              <div class="card-body">
                <p class="card-text text-center"> <?php echo $team ['team_name'] ?></p>
              </div>
            </div>  
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Team</h5>
              <p class="card-text">Team disetiap negara-negara di spanyol </p>
              <a href="premierteam.php" class="btn btn-primary">Lihat lebih lanjut</a>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
    </div>