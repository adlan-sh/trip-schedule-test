<?php $this->layout('layout', ['title' => 'Курьеры']) ?>

<div class="container w-50">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Имя</th>
            <th scope="col">Отчество</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($couriers as $courier): ?>
            <tr>
                <th scope="row"><?= $courier->id ?></th>
                <td><?= $courier->lastname ?></td>
                <td><?= $courier->firstname ?></td>
                <td><?= $courier->middlename ?></td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
</div>
