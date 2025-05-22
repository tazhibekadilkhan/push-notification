<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-md rounded p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Вход в систему</h2>

    <form id="login-form">
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium mb-1">Email</label>
            <input type="email" id="email" name="email" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium mb-1">Пароль</label>
            <input type="password" id="password" name="password" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div id="error-message" class="text-red-500 text-sm mb-4 hidden"></div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Войти
        </button>

        <p class="mt-4 text-center text-sm">
            Создать аккаунт
            <a href="/register" class="text-blue-500 hover:underline">Регистрация</a>
        </p>
    </form>
</div>

<script>
    const form = document.getElementById('login-form');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const email = form.email.value;
        const password = form.password.value;

        try {
            const response = await fetch('/api/v1/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email, password }),
            });

            const data = await response.json();

            if (data.error) {
                errorMessage.textContent = data.error || 'Ошибка авторизации';
                errorMessage.classList.remove('hidden');
                return;
            }

            console.log(data.data);
            localStorage.setItem('token', data.data.authorization.access_token);
            window.location.href = '/';
        } catch (err) {
            errorMessage.textContent = 'Ошибка сети';
            errorMessage.classList.remove('hidden');
        }
    });
</script>
</body>
</html>
