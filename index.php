<?php require "./header.php" ?>
<div class="d-flex flex-wrap">
    <?php
    include "./database.php";
    $pdo = connect();
    foreach ($pdo->query("SELECT * FROM `list` ORDER BY name") as $list) { ?>
        <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title" style="color: <?= $list['color'] ?>"><?= $list["name"] ?></h5>
                <p class="card-text">
                    <?php foreach ($pdo->query("SELECT * FROM `task` WHERE list_id = {$list['id']} ORDER BY title") as $task) { ?>
                        <input type="checkbox" <?= $task["completed"] ? "checked" : "" ?> onchange="window.location.href='./updateStatus.php?id=<?= $task['id'] ?>'">
                        <a href="./updateTask.php?id=<?= $task["id"] ?>" class="task_color"><?= $task["completed"] ? "<del>" : "" ?><?= $task["title"] ?><?= $task["completed"] ? "</del>" : "" ?></a>
                        <a class="text-danger" href="./deleteTask.php?id=<?= $task["id"] ?>"><img src="../TodoAppVanillia\trash.png" id="trash" width="20px"></a><br>
                    <?php } ?>
                    <center><a href="./createTask.php?id= <?= $list["id"] ?>" < class="btn btn-dark ms-5 ">+</a></center>
                </p>
                <a href="./updateList.php?id=<?= $list["id"] ?>" class="btn btn-dark mt-5">Modifier</a>
                <a href="./deleteList.php?id=<?= $list["id"] ?>" class="btn btn-dark mt-5 ms-5">Supprimer</a>
                </p>
            </div>
        </div>
    <?php } ?>
</div>
<?php require "./footer.php" ?>