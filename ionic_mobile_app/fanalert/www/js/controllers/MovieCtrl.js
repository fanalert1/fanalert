app.controller('MovieCtrl', function($scope, $stateParams, $http, RequestService) {
  
  
  $scope.movies = [];
  $scope.title = "";
  
  if($stateParams.type=="all")
  {
  // RequestService.hello();
  $http.get('http://firefeed-androbala.c9users.io/api/movies').
        success(function(data) {
          
          $scope.movies = data;
          $scope.title = "All Movies";
           
           //console.log(data);
        });

  }
  
  
  if($stateParams.type=="upcoming")
  {
   
  $http.get('http://firefeed-androbala.c9users.io/api/movies/upcoming').
        success(function(data) {
          
          $scope.movies = data;
          $scope.title = "Upcoming Movies";
           
           //console.log(data);
        });

  }
  
  
  if($stateParams.type=="running")
  {
   
  $http.get('http://firefeed-androbala.c9users.io/api/movies/running').
        success(function(data) {
          
          $scope.movies = data;
          $scope.title = "Running Movies";
           
           //console.log(data);
        });

  }
  
});