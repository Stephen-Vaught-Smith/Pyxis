angular.module('Recognize').controller('profileController', ['$scope', '$http', function($scope, $http) {

    $scope.awards = [];
    $scope.tempAwardsData = {};


    // function to get records from the database
    $scope.getRecords = function(){
        $http.get('users.php', {
            params:{
                'type':'view'
            }
        }).success(function(response){
            if(response.status == 'OK'){
                $scope.awards = response.records;
            }
        });
    };

    // function to edit user data
    $scope.editUser = function(user){
        $scope.tempUserData = {
            id:user.id,
            name:user.name,
            email:user.email,
            phone:user.phone,
            created:user.created
        };
        $scope.index = $scope.users.indexOf(user);
        $('.formData').slideDown();
    };


    // function to update user data
    $scope.updateUser = function(){
        $scope.saveUser('edit');
    };

    // function to display success message
    $scope.messageSuccess = function(msg){
        $('.alert-success > p').html(msg);
        $('.alert-success').show();
        $('.alert-success').delay(5000).slideUp(function(){
            $('.alert-success > p').html('');
        });
    };
    
    // function to display error message
    $scope.messageError = function(msg){
        $('.alert-danger > p').html(msg);
        $('.alert-danger').show();
        $('.alert-danger').delay(5000).slideUp(function(){
            $('.alert-danger > p').html('');
        });
    };