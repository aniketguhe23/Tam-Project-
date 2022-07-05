import { Component, OnInit } from '@angular/core';
import { initializeApp, FirebaseApp } from 'firebase/app';
import { getMessaging, getToken, onMessage } from 'firebase/messaging';
import { onBackgroundMessage } from 'firebase/messaging/sw';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent implements OnInit {
  title = 'notification-demo';

  app: any;

  ngOnInit() {
    const firebaseConfig = {
      apiKey: 'AIzaSyB7BbL7lFMR-HcfuHkaNZirlL3qGKVqNCs',
      authDomain: 'notification-demo-vinod.firebaseapp.com',
      projectId: 'notification-demo-vinod',
      storageBucket: 'notification-demo-vinod.appspot.com',
      messagingSenderId: '307336349765',
      appId: '1:307336349765:web:80e2cac1a608b2cd06bb2c',
    };

    // Initialize Firebase
    this.app = initializeApp(firebaseConfig);
  }

  showNotification() {
    const notification = new Notification('To do list', { body: 'body comes here' });
  }

  registerForNotification() {
    console.log('Requesting permission...');

    let that = this;

    Notification.requestPermission().then((permission) => {
      if (permission === 'granted') {
        console.log('Notification permission granted.');
        // this.registerServiceWorker();
        that.getNotificationToken();
      } else {
        console.log('Notification permission: ', permission);
      }
    });
  }

  registerServiceWorker() {
    if ('serviceWorker' in navigator) {
      let that = this;
      navigator.serviceWorker
        .register('./firebase-messaging-sw.js')
        .then(function (registration) {
          console.log('Registration successful, scope is:', registration.scope);
          that.getNotificationToken();
        });
    }
  }

  getNotificationToken() {
    // console.log('getNotificationToken');
    const messaging = getMessaging();
    getToken(messaging, {
      vapidKey:
        'BIXg9eo7OG48hjD7v8ccfpl_60dhjEyZDI5a71iARYNPd1ggiwbIfIAmo-EJYHhJTpNvrfGNuIgPwY7-jEJCj5c',
    })
      .then((currentToken) => {
        if (currentToken) {
          // Send the token to your server and update the UI if necessary
          // ...

          console.log('currentToken: "' + currentToken + '"');


          // onBackgroundMessage(messaging, (payload) => {
          //   console.log(
          //     '[firebase-messaging-sw.js] Received background message ',
          //     payload
          //   );
          //   // Customize notification here
          //   const notificationTitle = 'Background Message Title';
          //   const notificationOptions = {
          //     body: 'Background Message body.',
          //     icon: '/firebase-logo.png',
          //   };

          //   // self.registration.showNotification(
          //   //   notificationTitle,
          //   //   notificationOptions
          //   // );
          // });
        } else {
          // Show permission request UI
          console.log(
            'No registration token available. Request permission to generate one.'
          );
          // ...
        }
      })
      .catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        // ...
      });


      onMessage(messaging, (payload) => {
        console.log('Message received. ', payload);
      });
  }
}
