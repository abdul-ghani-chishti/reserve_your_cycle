importScripts("https://www.gstatic.com/firebasejs/10.1.0/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/10.1.0/firebase-messaging-compat.js");

firebase.initializeApp({
    apiKey: "AIzaSyBL8YQagNC6Olp-OJqVrswOqnK1Ku83mFU",
    authDomain: "reserve-cycle.firebaseapp.com",
    projectId: "reserve-cycle",
    storageBucket: "reserve-cycle.firebasestorage.app",
    messagingSenderId: "48529419941",
    appId: "1:48529419941:web:dedffae850f4a8087de74c",
    measurementId: "G-QKMM3G87QR"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    console.log("Received background message ", payload);
    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
        icon: "/firebase-logo.png"
    });
});
