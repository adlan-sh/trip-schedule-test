<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<head>
    <title><?=$this->e($title)?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?= $this->section('css')?>
</head>
<body>
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="<?= $this->e(App\Config\Route::COURIER) ?>" class="nav-link">Курьеры</a></li>
            <li class="nav-item"><a href="<?= $this->e(App\Config\Route::REGION) ?>" class="nav-link">Регионы</a></li>
            <li class="nav-item"><a href="<?= $this->e(App\Config\Route::SCHEDULE) ?>" class="nav-link">Расписание</a></li>
            <li class="nav-item"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">Добавить поездку</button></li>
        </ul>
    </header>
    <?= $this->section('content')?>

    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Новая поездка</h5>
                    <button type="button" class="btn-close closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= $this->e(App\Config\Route::ADD_SCHEDULE) ?>" method="POST">
                        <div class="mb-3">
                            <label for="region" class="col-form-label">Регион:</label>
                            <select class="form-control" id="region" required></select>
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="col-form-label">Дата выезда из Москвы:</label>
                            <input type="date" class="form-control" id="startDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="courier" class="col-form-label">Курьер:</label>
                            <select class="form-control" id="courier" required></select>
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="col-form-label">Дата прибытия:</label>
                            <input type="text" class="form-control" id="endDate" required disabled>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeBtn" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="addNewTrip()">Добавить</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
    <?= $this->section('js')?>
</body>
</html>
