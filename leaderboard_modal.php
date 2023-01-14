<?php include_once('dbconfig.php') ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Leaderboards</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Username</th>
                <th>Clickcounts</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM users ORDER BY clickcounts DESC LIMIT 5";
                $result = mysqli_query($conn, $sql);
                $ranking = 1;
                $rowCount = mysqli_num_rows($result);
                $counter = 0;
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td> <i class='fas fa-trophy trophy-color-".$ranking."'></i> ".$ranking."</td>
                            <td>".$row['username']."</td>
                            <td>".$row['clickcounts']."</td>
                        </tr>";
                    $counter++;
                    if($counter == $rowCount) {
                        echo "<tr><td colspan='3'>---Your Current Record---</td></tr>";
                    }
                    $ranking++;
                }
            ?>
        </tbody>
    <?php
    $username = $_SESSION['username'];
    $query = "SELECT clickcounts,username FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $current_user_data = mysqli_fetch_assoc($result);
    $current_click_count = $current_user_data['clickcounts'];
    $current_username = $current_user_data['username'];
    $query = "SELECT COUNT(*) as rank FROM users WHERE clickcounts > $current_click_count";
    $result = mysqli_query($conn, $query);
    $rank = mysqli_fetch_assoc($result)['rank'] + 1;
    echo "<tr>
        <td class='rank rank-".$rank."'><i class='fas fa-trophy trophy-color-".$ranking."'></i> ".$rank."</td>
        <td class='rank rank-".$rank."'>".$current_username."</td>
        <td class='rank rank-".$rank."'>".$current_click_count."</td>
    </tr>";
?>
    </table>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>