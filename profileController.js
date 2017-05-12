angular.module('Recognize').service('editAccount', function(){

    var self = this;

    this.userName = '';
    this.userEmail = '';
    this.userPhone = '';

    this.getUserName = function() {
        return self.userName;
    };

    this.getUserEmail = function() {
        return self.userEmail;
    };

    this.getUserPhone = function() {
        return self.userPhone;
    };

});





angular.module('Recognize').controller('profileController', ['$scope', '$http', function($scope, $http) {

    $scope.userName = editAccount.userName;
    $scope.userEmail = editAccount.userEmail;
    $scope.userPhone = editAccount.userPhone;

    $scope.edit1 = true;
    $scope.edit2 = true;
    $scope.edit3 = true;

    $scope.editUserName = function() {
        $scope.edit1 = false;
        $scope.userName = '';
    };

    $scope.editUserEmail = function() {
        $scope.edit2 = false;
        $scope.userEmail = '';
    };

    $scope.editUserPhone = function() {
        $scope.edit3 = false;
        $scope.userPhone = '';
    };

    $scope.$watch('userName', function() {
        editAccount.userName = $scope.userName;
    });

    $scope.$watch('userEmail', function() {
        editAccount.userEmail = $scope.userEmail;
    });

    $scope.$watch('userPhone', function() {
        editAccount.userPhone = $scope.userPhone;
    });

}]);

    
