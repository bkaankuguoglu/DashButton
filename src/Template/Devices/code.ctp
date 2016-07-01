<!DOCTYPE html>
<!-- AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
<!-- Firebase -->
<script src="https://www.gstatic.com/firebasejs/3.0.3/firebase.js"></script>
<!-- AngularFire -->
<script src="https://cdn.firebase.com/libs/angularfire/2.0.1/angularfire.min.js"></script>
<html lang="en">
  <body>
    <p id="demo">Push the button...</p>
    <div ng-app="MyModule" ng-controller="MyController"></div>
    <script>
    //------- Initialize Firebase ---------------
    var config = {
      apiKey: "AIzaSyBkz8HHi5kjIKNLzv_Ew4k64CkbZ3GAZfI",
      authDomain: "dashbutton-12ce9.firebaseapp.com",
      databaseURL: "https://dashbutton-12ce9.firebaseio.com",
      storageBucket: "dashbutton-12ce9.appspot.com",
    };
    firebase.initializeApp(config);
    var codeRef = firebase.database().ref('code/');

    //------- Application Module ----------------
    var app = angular.module('MyModule', []);
    document.getElementById("demo").innerHTML = "";
    app.controller("MyController", ["$scope", function($scope) {
      codeRef.on('child_added', function(data) {
        console.log(data.val());
        document.getElementById("demo").innerHTML += data.val();
        window.scrollBy(0,50); // scroll to make sure bottom is always visible
      });
    }]);
    </script>
  </body>
</html>
