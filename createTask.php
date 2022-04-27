<?php
require "./header.php";
if ($_POST) {
    include "./database.php";
    $pdo = connect();

    $title = $_POST["title"];

    $sql = "INSERT INTO `task` (title, completed, list_id) VALUES (:title, :completed, :list_id)";
    $req = $pdo->prepare($sql);
    $req->bindParam(":title", $title, PDO::PARAM_STR);
    $req->bindValue(":completed", 0, PDO::PARAM_INT);
    $req->bindParam(":list_id", $_GET["id"], PDO::PARAM_INT);
    $req->execute();

    echo "<script>window.location.href='index.php'</script>";
    // header("Location: index.php");
}

?>

<form method="post" classe="container">
    <label for="title" class="form-label ms-3">Nom</label>
    <input type="text" name="title" id="title" class="form-control" placeholder="Nom de la tâche">
    <input type="submit" value="Créer" class="btn btn-dark mt-3 ms-3">
</form>
<?php require "./footer.php" ?>