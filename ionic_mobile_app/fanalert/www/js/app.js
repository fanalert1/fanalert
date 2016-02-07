// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
var app = angular.module('starter', ['ionic','ionic.service.core', 'ionic-material', 'starter.services']);

app.run(function ($ionicPlatform) {
    $ionicPlatform.ready(function () {
        // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
        // for form inputs)

        if (window.cordova && window.cordova.plugins.Keyboard) {
            cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
        }
        if (window.StatusBar) {
            StatusBar.styleDefault();
        }
           
           /*
            Ionic.io();
            var push = new Ionic.Push({
              "debug": true
            });
        
            push.register(function(token) {
              console.log("Device token:",token.token);
            });
        */
        
         //push code
           RequestService.hello();
            
            var io = Ionic.io();
            var push = new Ionic.Push({
              "onNotification": function(notification) {
                alert('Received push notification!');
              },
              "pluginConfig": {
                "android": {
                  "iconColor": "#0000FF"
                }
              }
            });
            var user = Ionic.User.current();
            
            if (!user.id) {
              user.id = Ionic.User.anonymousId();
            }
            
            // Just add some dummy data..
            user.set('name', 'Bala');
            user.set('bio', 'This is Bala');
            user.save();
           
            var callback = function(data) {
              push.addTokenToUser(user);
              user.save();
             // device_token=data.token;
              console.log("Device token:",data.token);
            
          //  RequestsService.register(data.token).then(function(response){
            //        alert('registered!');
             //    });
            };
            push.register(callback);

            //ends push code

        
    });
})

app.config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider

    .state('app', {
        url: '/app',
        abstract: true,
        templateUrl: 'templates/menu.html',
        controller: 'AppCtrl'
    })

    
    .state('app.movies', {
      url: '/movies',
      params: {
        'type':'all'
      },
      views: {
       'menuContent': {
          templateUrl: 'templates/movies.html',
          controller: 'MovieCtrl'
        }
      }
    })
    
    .state('app.upcoming_movies', {
      url: '/upcoming_movies',
      params: {
        'type':'upcoming'
      },
      views: {
       'menuContent': {
          templateUrl: 'templates/movies.html',
          controller: 'MovieCtrl'
        }
      }
    })
    
    .state('app.running_movies', {
      url: '/running_movies',
      params: {
        'type':'running'
      },
      views: {
       'menuContent': {
          templateUrl: 'templates/movies.html',
          controller: 'MovieCtrl'
        }
      }
    })
    
    
    .state('app.lists', {
        url: '/lists',
        views: {
            'menuContent': {
                templateUrl: 'templates/lists.html',
                controller: 'ListsCtrl'
            }
        }
    })

    .state('app.ink', {
        url: '/ink',
        views: {
            'menuContent': {
                templateUrl: 'templates/ink.html',
                controller: 'InkCtrl'
            }
        }
    })

    .state('app.motion', {
        url: '/motion',
        views: {
            'menuContent': {
                templateUrl: 'templates/motion.html',
                controller: 'MotionCtrl'
            }
        }
    })

    .state('app.components', {
        url: '/components',
        views: {
            'menuContent': {
                templateUrl: 'templates/components.html',
                controller: 'ComponentsCtrl'
            }
        }
    })

    .state('app.extensions', {
        url: '/extensions',
        views: {
            'menuContent': {
                templateUrl: 'templates/extensions.html',
                controller: 'ExtensionsCtrl'
            }
        }
    })
    ;

    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/app/movies');
});
