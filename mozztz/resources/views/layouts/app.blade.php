<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Добавьте ссылки на ваши стили CSS и скрипты JavaScript здесь -->
</head>
<body>
<header>
    <!-- Шапка вашего сайта -->
</header>

<nav>
    <!-- Навигационное меню -->
</nav>

<main>
    @yield('content')
</main>

<footer>
    <!-- Подвал вашего сайта -->
</footer>
</body>
</html>

