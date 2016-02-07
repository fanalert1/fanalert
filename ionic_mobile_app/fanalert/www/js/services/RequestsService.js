


 angular.module('starter.services',[])
    .service('RequestService', function(){
        
      //  this.registerDevice = function($http, $q, $ionicLoading)
     //   {
    
        function hello()
        {
        console.log("hello");
        }
        
        return {
            register: hello
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