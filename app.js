// define application
angular.module('Recognize', ['ngRoute']);

angular.module('Recognize', ['ngRoute']).config(function ($routeProvider) {
    
    $routeProvider

    .when('/', {
        templateUrl: 'pages/main.html',
        controller: 'userController'
    })

    .when('/createAccount', {
        templateUrl: 'pages/createAccount.html',
        controller: 'createAccountController'
    })

    .when('/viewPastAwards', {
    	templateUrl: 'pages/table.html',
    	controller: 'userController'
    })

    .when('/userProfile', {
        templateUrl: 'pages/userProfile.html',
        controller: 'profileController'
    })
});
