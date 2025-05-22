<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Регистрация</h2>

    <form id="register-form">
        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold" for="name">Имя</label>
            <input id="name" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold" for="email">Email</label>
            <input id="email" type="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold" for="password">Пароль</label>
            <input id="password" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-6">
            <label class="block mb-1 text-sm font-semibold" for="password_confirmation">Подтвердите пароль</label>
            <input id="password_confirmation" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <ul id="error-list" class="mb-4 text-sm text-red-600 space-y-1"></ul>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
            Зарегистрироваться
        </button>

        <p class="mt-4 text-center text-sm">
            Уже есть аккаунт?
            <a href="/login" class="text-blue-500 hover:underline">Войти</a>
        </p>
    </form>
</div>

<script>
    document.getElementById('register-form').addEventListener('submit', async function (e) {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        if (password !== passwordConfirmation) {
            alert('Пароли не совпадают');
            return;
        }

        try {
            const response = await fetch('/api/v1/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ name, email, password, password_confirmation: passwordConfirmation }),
            });

            const data = await response.json();
            const errorList = document.getElementById('error-list');
            errorList.innerHTML = '';

            if (!response.ok) {
                if (data.errors) {
                    for (const field in data.errors) {
                        data.errors[field].forEach(message => {
                            const li = document.createElement('li');
                            li.textContent = message;
                            errorList.appendChild(li);
                        });
                    }
                } else {
                    const li = document.createElement('li');
                    li.textContent = data.message || 'Ошибка регистрации';
                    errorList.appendChild(li);
                }
                return;
            }

            alert('Успешно');
            window.location.href = '/login';
        } catch (err) {

        }
    });
</script>

</body>
</html>
