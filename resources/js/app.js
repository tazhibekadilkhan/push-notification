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

            await navigator.serviceWorker.ready;

            const token = await getToken(messaging, {
                vapidKey: "BFV65DFs9kkBktyigV0wgDTbbEo6sc-x5wUYUutTJMyqYbkpN6o7S29A3yBFkvrFTLXQFwmZshrAr6ZzzxJTSsw",
                serviceWorkerRegistration: registration,
            });

            if (token) {
                await fetch('/api/v1/devices/register', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    },
                    body: JSON.stringify({
                        token: token
                    })
                }).then(async response => {
                    if (!response.ok) {
                        const data = await response.json();
                        if (data.errors && data.errors.token) {
                            alert(data.errors.token[0]);
                        } else if (data.message) {
                            alert(data.message);
                        } else {
                            alert('Ошибка при регистрации устройства.');
                        }
                    } else {
                        alert('✅ Уведомления включены');
                    }
                }).catch(error => {
                    console.error('Ошибка сети или сервера:', error);
                    alert('❌ Ошибка при выполнении запроса');
                });
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
