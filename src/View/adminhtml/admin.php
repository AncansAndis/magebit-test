<?php

use Model\Emails\Emails;

/** @var Emails $emails */
/** @var Emails $providers */

?>

<div class="admin-page">
    <div>
        <p>Order by column</p>
        <form method="post" action="/?page=admin">
            <button type="submit" name="orderBy" value="date_created">Order by date</button>
            <button type="submit" name="orderBy" value="email">Order by name</button>
        </form>
    </div>
    <div>
        <p>Order by provider</p>
        <form method="post" action="/?page=admin">
            <?php foreach (array_unique($providers) as $provider): ?>
                <button name="filter" value="<?= $provider ?>"><?= $provider ?></button>
            <?php endforeach; ?>
        </form>
    </div>
    <div>
        <p>Order by input</p>
        <form method="post" action="/?page=admin">
            <input type="text" name="filter"/>
            <button type="submit">Find</button>
        </form>

    </div>
    <div>
        <p>Reset filters</p>
        <form method="post" action="/?page=admin"></form>
        <input type="hidden" name="reset">
        <button type="submit">Reset all</button>

    </div>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Submitted</th>
            <th>Email address</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($emails as $email) : ?>
            <tr>
                <td><?= $email->getId() ?></td>
                <td><?= $email->getDateCreated() ?></td>
                <td><?= $email->getEmail() ?></td>
                <td>
                    <form method="post" action="/?page=admin">
                        <button type="submit" name="remove" value="<?= $email->getId() ?>">Delete</button>
                    </form>
                    <input form="export-csv-form" type="checkbox" name="exportCSV[]" value="<?= $email->getId() ?>"/>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <form id="export-csv-form" method="post" action="/?page=admin">
        <button type="submit">Export to CSV selected!</button>
    </form>
</div>
