


 angular.module('starter.services',[])
    .factory('RequestService', function($http){
        
      //  this.registerDevice = function($http, $q, $ionicLoading)
     //   {
    
        function register(device_token)
        {
         //console.log("hello");
          var base_url = 'http://firefeed-androbala.c9users.io/api';
         
          $http.post(base_url + '/register', {'device_token': device_token})
                .success(function(response){

                    //$ionicLoading.hide();
                    //deferred.resolve(response);
                    
                    console.log("registered:"+device_token);
                })
                .error(function(data){
                    //deferred.reject();
                    console.log(" registration failed");
                });
         
        }
        
        return {
            register: register
        };
        
        
    });

 
    /*
    
    angular.module('starter.services',[])
    .service('RequestsService', ['$http', '$q', '$ionicLoading',  RequestsService]);

    function RequestsService($http, $q, $ionicLoading){

        var base_url = 'http://firefeed-androbala.c9users.io/api';

        function register(device_token){

            var deferred = $q.defer();
            $ionicLoading.show();

            $http.post(base_url + '/register', {'device_token': device_token})
                .success(function(response){

                    $ionicLoading.hide();
                    deferred.resolve(response);

                })
                .error(function(data){
                    deferred.reject();
                });


            return deferred.promise;

        };


        
    }

*/