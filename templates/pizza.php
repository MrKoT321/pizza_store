<?php
/**
 * @var App\Model\Pizza $pizza
 */
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>
        <?= $pizza->getPizzaName() ?>
    </title>
</head>

<body>
    <div>
        <h1>
            <?= htmlentities($pizza->getPizzaName()) ?>
        </h1>
        <h2>
            <?= htmlentities($pizza->getPizzaDescription()) ?>
        </h2>
        <p>
            <?= htmlentities($pizza->getPizzaCost()) ?>
        </p>
        <form action="<?= "/pizza/{$pizza->getPizzaId()}/delete" ?>" method="post">
            <button type="submit">Удалить пиццу из каталога</button>
        </form>
    </div>
</body>

</html>