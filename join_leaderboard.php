<?php
  $username = $_POST['username'];
  $query = "SELECT * FROM users ORDER BY clickcounts DESC";
  $result = mysqli_query($conn, $query);
  $ranking = 0;
  while($row = mysqli_fetch_assoc($result)){
    $ranking++;
    if($row['username'] == $username){
      break;
    }
  }
  echo json_encode(array("ranking" => $ranking));
?>
