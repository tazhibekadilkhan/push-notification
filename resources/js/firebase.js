// resources/js/firebase.js
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

const firebaseConfig = {
    authDomain: "tredo-3cc05.firebaseapp.com",
    storageBucket: "tredo-3cc05.firebasestorage.app",
    apiKey: "AIzaSyDZn1ox7S1PJuk4j7lzYphh3CEIDwLJ1iw",
    projectId: "tredo-3cc05",
    messagingSenderId: "160881085974",
    appId: "1:160881085974:web:0047cc96719ba70040af37",
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

export { messaging, getToken, onMessage };
