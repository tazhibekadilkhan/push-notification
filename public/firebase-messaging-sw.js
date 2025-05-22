importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js');

firebase.initializeApp({
    authDomain: "tredo-3cc05.firebaseapp.com",
    storageBucket: "tredo-3cc05.firebasestorage.app",
    apiKey: "AIzaSyDZn1ox7S1PJuk4j7lzYphh3CEIDwLJ1iw",
    projectId: "tredo-3cc05",
    messagingSenderId: "160881085974",
    appId: "1:160881085974:web:0047cc96719ba70040af37",
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: '/firebase-logo.png'
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
