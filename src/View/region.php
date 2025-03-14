<?php $this->layout('layout', ['title' => 'Регионы']) ?>

<div class="container w-50">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Наименование</th>
            <th scope="col">Длительность (в днях)</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($regions as $region): ?>
            <tr>
                <th scope="row"><?= $region->id ?></th>
                <td><?= $region->name ?></td>
                <td><?= $region->days ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
