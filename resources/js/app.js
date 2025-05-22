import './bootstrap';
import {messaging, getToken, onMessage} from './firebase';

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('logout-btn').addEventListener('click', () => {
        localStorage.removeItem('token');
        window.location.href = '/login';
    });

    const button = document.getElementById('subscribe-btn');

    button.addEventListener('click', async () => {
        try {
            const permission = await Notification.requestPermission();
            if (permission !== 'granted') {
                alert('Вы не разрешили уведомления');
                return;
            }

            const registration = await navigator.serviceWorker.register('/firebase-messaging-sw.js');

            const token = await getToken(messaging, {
                vapidKey: "BETFcN_YV9T3VUSrjI9HWbVPpFNCq5oLX-e4AM7bYU6dVlYx_mtObb8xL7TMApwnJkmlFcQWWKaB6kq5SZEtP9c",
                serviceWorkerRegistration: registration,
            });

            if (token) {
                console.log("FCM Token:", token);

                // Отправка на сервер
                await fetch('/api/v1/devices/register', {
                    method: 'POST', headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`, 'Content-Type': 'application/json',
                    }
                });

                alert('✅ Уведомления включены');
            } else {
                alert('❌ Не удалось получить токен');
            }
        } catch (error) {
            console.error('Ошибка при регистрации:', error);
            alert('❌ Ошибка при включении уведомлений');
        }
    });

    onMessage(messaging, (payload) => {
        console.log("Получено сообщение:", payload);
    });
});
