<!DOCTYPE html>
<html>
    <head>
        <title>Users List</title>
    </head>
    <body>
        <h1>Users</h1>
        <ul>
            <?php foreach ($users as $user): ?>
            <li><?= esc($user['name']); ?>
                -
                <?= esc($user['email']); ?></li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>