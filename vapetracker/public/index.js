      // Your web app's Firebase configuration
      // For Firebase JS SDK v7.20.0 and later, measurementId is optional
      var firebaseConfig = {
          apiKey: "AIzaSyChbTyAehRWN2itKfTJqF8xGBdjMQtxxLw",
          authDomain: "vapetracker-b0693.firebaseapp.com",
          databaseURL: "https://vapetracker-b0693-default-rtdb.firebaseio.com",
          projectId: "vapetracker-b0693",
          storageBucket: "vapetracker-b0693.appspot.com",
          messagingSenderId: "717591103904",
          appId: "1:717591103904:web:51aa8ce5d5f67535437cc5",
          measurementId: "G-5F20CDEN69"
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
      firebase.analytics();

      const auth = firebase.auth();

      var user = firebase.auth().currentUser;

      firebase.auth().onAuthStateChanged(function(user) {
          if (user) {

              if (user != null) {

                  email = user.email;
                  photoUrl = user.photoURL;
                  emailVerified = user.emailVerified;
                  uid = user.uid; // The user's ID, unique to the Firebase project. Do NOT use
                  // this value to authenticate with your backend server, if
                  // you have one. Use User.getToken() instead.
                  document.getElementById("userEmail").innerHTML = "Email:" + email;
              }

          } else {

          }
      });


      //Active User (logged in user)

      var userEmail;
      var userPassword;

      function login() {

          // window.alert("Logged In!");
          this.userEmail = document.getElementById("email_field").value;
          this.userPassword = document.getElementById("password_field").value;


          const promise = auth.signInWithEmailAndPassword(userEmail, userPassword).then(function() {
              //redirect to another page  
              window.location.replace("./homepage.html");
          });
          promise.catch(e => alert(e.message));


      }



      function logout() {
          auth.signOut();
          auth.currentUse
          window.location.replace("./index.html");

      }

      //Not Active (logged out) user functions
      function signUp() {

          window.location.replace("./signup.html");

      }

      function join() {
          this.userEmail = document.getElementById("email_field").value;
          this.userPassword = document.getElementById("password_field").value;
          const promise = auth.createUserWithEmailAndPassword(userEmail, userPassword).then(function() {
              //redirect to another page  
              alert("Successfully Joined VapeTracker2.0")
              window.location.replace("./index.html");

          });
          promise.catch(e => alert(e.message));
      }

      function index() {
          window.location.replace("./index.html");
      }