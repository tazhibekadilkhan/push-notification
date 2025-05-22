<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 min-h-screen">

<nav class="bg-white shadow-md p-4 flex justify-between items-center">
    <div class="text-xl font-semibold">Профиль: <span id="user-name">Загрузка...</span></div>
    <button id="logout-btn" class="text-red-500 hover:underline">Выход</button>
</nav>

<div class="flex flex-col items-center justify-center mt-32">
    <h1 class="text-3xl font-bold mb-6">Подписка на пуш-уведомления</h1>
    <button id="subscribe-btn"
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
        Подписаться
    </button>
</div>

<script>
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = '/login';
    }

    async function loadUserProfile() {
        try {
            const response = await fetch('/api/v1/profile', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            });

            const data = await response.json();
            document.getElementById('user-name').textContent = data.data.name || 'Пользователь';
        } catch (err) {
            console.error('Ошибка авторизации:', err.message);
            // localStorage.removeItem('token');
            // window.location.href = '/login';
        }
    }

    loadUserProfile();

</script>

</body>
</html>
