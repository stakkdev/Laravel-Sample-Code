// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyCGY_21NSfHV8XxNw1WOqFbPoj-J3XepIk",
    authDomain: "commonpayhoo-8b56d.firebaseapp.com",
    databaseURL: "https://commonpayhoo-8b56d.firebaseio.com",
    projectId: "commonpayhoo-8b56d",
    storageBucket: "commonpayhoo-8b56d.appspot.com",
    messagingSenderId: "660122292211",
    appId: "1:660122292211:web:aef9894defadd71e32cc86"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.requestPermission().then(function() {
	console.log('Notification permission granted.');
	// TODO(developer): Retrieve an Instance ID token for use with FCM
	messaging.getToken().then(function(currentToken) {
        if (currentToken) {
          saveTokenInDatabase(currentToken);
          console.log(currentToken);
        } else {
          console.log('No Instance ID token available. Request permission to generate one.');
        }
    }).catch(function(err) {
        console.log('An error occurred while retrieving token. ', err);
    });
}).catch(function(err) {
	console.log('Unable to get permission to notify.', err);
});

function saveTokenInDatabase(currentToken) {
    $.ajax({
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {"device_token": currentToken},
        url: "admin/firebase",
        success: function(result){}
     });
}


messaging.onMessage((payload) => {
    console.log('Message received. ', payload);
  
    const notificationTitle = payload.data.title;
    const notificationOptions = {
        body: payload.data.body,
        icon: payload.data.icon,
        image: payload.data.image
    };
  
    return self.registration.showNotification(notificationTitle, notificationOptions);
});
