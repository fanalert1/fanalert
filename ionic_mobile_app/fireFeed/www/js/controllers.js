angular.module('starter.controllers', [])

//our app code

.controller('MovieCtrl', function($scope,$http) {
  
  
  $scope.movies = [];
   
  $http.get('http://firefeed-androbala.c9users.io/api/movies').
        success(function(data) {
          
          $scope.movies = data;
           
           //console.log(data);
        });


  
  
})


//ends our code






.controller('DashCtrl', function($scope) {})

.controller('ChatsCtrl', function($scope, Chats) {
  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  //
  //$scope.$on('$ionicView.enter', function(e) {
  //});

  $scope.chats = Chats.all();
  $scope.remove = function(chat) {
    Chats.remove(chat);
  };
})

.controller('ChatDetailCtrl', function($scope, $stateParams, Chats) {
  $scope.chat = Chats.get($stateParams.chatId);
})

.controller('AccountCtrl', function($scope) {
  $scope.settings = {
    enableFriends: true
  };
});
