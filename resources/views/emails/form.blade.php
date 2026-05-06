<h2>Новая заявка: {{ $type }}</h2>

<ul>
    @foreach($data as $key => $value)
        <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
    @endforeach
</ul>
