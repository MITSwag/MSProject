var config = {
        apiKey: "AIzaSyDH0vwzO9Ob3GoeYU_-W_PfjOAtbv4V2R0",
        authDomain: "misilearning.firebaseapp.com",
        databaseURL: "https://misilearning.firebaseio.com",
        projectId: "misilearning",
        storageBucket: "misilearning.appspot.com",
        messagingSenderId: "290441985709"
      };
      firebase.initializeApp(config);
        alert("test");
function formSwitch() {
                var login = document.getElementById('login-form');
                var register = document.getElementById('register-form');
                if (login.style.display === 'none') {
                    register.style.display = 'none';
                    login.style.display = 'block';
                } else {
                    login.style.display = 'none';
                    register.style.display = 'block';
                }
            }
            //Need to deal with error messages later
            function login() {
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    return;
                })
                window.location.href = "dashboard.html";
            }
            function register() {
                if (document.getElementById("create-password").value === document.getElementById("confirm-password").value) {
                    var email = document.getElementById("create-email").value;
                    var password = document.getElementById("create-password").value;
                } else {
                    alert("does not match");
                    return;
                }
                firebase.auth().createUserWithEmailAndPassword(email, password).catch(function(error) {
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    alert("error");
                    return;
                })
                alert("Test");
            }
