<?php





    $stmt = $econn->prepare("DELETE FROM notification WHERE type_id = :gt");

    $stmt->bindParam(":gt", $_POST['notId']);
    $stmt->execute();

?>
