// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.18.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object

firebase.initializeApp({
    apiKey: "AIzaSyCGY_21NSfHV8XxNw1WOqFbPoj-J3XepIk",
    authDomain: "commonpayhoo-8b56d.firebaseapp.com",
    databaseURL: "https://commonpayhoo-8b56d.firebaseio.com",
    projectId: "commonpayhoo-8b56d",
    storageBucket: "commonpayhoo-8b56d.appspot.com",
    messagingSenderId: "660122292211",
    appId: "1:660122292211:web:aef9894defadd71e32cc86"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = 'Background Message Title';
    const notificationOptions = {
      body: 'Background Message body.',
      icon: '/firebase-logo.png'
    };
  
    return self.registration.showNotification(notificationTitle, notificationOptions);
});
