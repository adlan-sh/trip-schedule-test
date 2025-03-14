<?php $this->layout('layout', ['title' => 'Расписание']) ?>

<div class="container w-50">
    <form class="d-flex gap-4 align-items-center" method="GET" action="<?= $this->e(App\Config\Route::SCHEDULE) ?>">
        <div class="mb-3">
            <label for="startDateFilter" class="col-form-label">Начальная дата:</label>
            <input type="date" class="form-control" id="startDateFilter" name="startDateFilter" value="<?= $_GET['startDateFilter'] ?? '' ?>">
        </div>
        <div class="mb-3">
            <label for="endDateFilter" class="col-form-label">Конечная дата:</label>
            <input type="date" class="form-control" id="endDateFilter" name="endDateFilter" value="<?= $_GET['endDateFilter'] ?? '' ?>">
        </div>
        <div class="mb-3 align-self-end">
            <button type="submit" class="btn btn-primary">Применить</button>
        </div>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Регион</th>
            <th scope="col">Дата выезда из Москвы</th>
            <th scope="col">ФИО курьера</th>
            <th scope="col">Дата прибытия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($trips as $trip): ?>
            <tr>
                <th scope="row"><?= $trip->id ?></th>
                <td><?= $trip->name ?></td>
                <td><?= (new DateTimeImmutable($trip->startdate))->format('d-m-Y') ?></td>
                <td><?= $trip->lastname ?> <?= $trip->firstname ?> <?= $trip->middlename ?></td>
                <td><?= (new DateTimeImmutable($trip->enddate))->format('d-m-Y') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>