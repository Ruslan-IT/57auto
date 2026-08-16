<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новая заявка</title>
</head>

<body>

<h2>Новая заявка по автомобилю</h2>

<hr>

<h3>Клиент</h3>

<p>
    <strong>Имя:</strong>
    {{ $data['name'] }}
</p>

<p>
    <strong>Email:</strong>
    {{ $data['email'] }}
</p>

<p>
    <strong>Телефон:</strong>
    {{ $data['phone'] }}
</p>

@if(!empty($data['message']))
    <p>
        <strong>Сообщение:</strong><br>
        {{ $data['message'] }}
    </p>
@endif

<hr>

<h3>Автомобиль</h3>

<p>
    <strong>Автомобиль:</strong>
    {{ $data['car'] }}
</p>

<p>
    <strong>Год:</strong>
    {{ $data['year'] }}
</p>

<p>
    <strong>Лот:</strong>
    {{ $data['lot'] }}
</p>

<p>
    <strong>ID автомобиля:</strong>
    {{ $data['car_id'] }}
</p>

<hr>

<p>
    <strong>Заявка №:</strong>
    {{ $submission->id }}
</p>

<p>
    <strong>Дата:</strong>
    {{ $submission->created_at }}
</p>

@if(!empty($data['car_url']))
    <p>
        <strong>Страница :</strong><br>

        <a href="{{ $data['car_url'] }}">
            Открыть
        </a>
    </p>
@endif

</body>
</html>
