angular.module('Recognize').controller('awardController', ['$scope', '$http', function($scope, $http) {

    $scope.awards = [];
    $scope.tempAwardsData = {};


    // function to get records from the database
    $scope.getRecords = function(){
        $http.get('awards.php', {
            params:{
                'type':'view'
            }
        }).success(function(response){
            if(response.status == 'OK'){
                $scope.awards = response.records;
            }
        });
    };

    // function to insert or update user data to the database
    $scope.saveAward = function(type){
        var data = $.param({
            'data':$scope.tempAwardsData,
            'type':type
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post("awards.php", data, config).success(function(response){
            if(response.status == 'OK'){
                if(type == 'edit'){
                    $scope.awards[$scope.index].id = $scope.tempAwardsData.id;
                    $scope.awards[$scope.index].name = $scope.tempAwardsData.name;
                    $scope.awards[$scope.index].email = $scope.tempAwardsData.email;
                    $scope.awards[$scope.index].phone = $scope.tempAwardsData.phone;
                    $scope.awards[$scope.index].created = $scope.tempAwardsData.created;
                }else{
                    $scope.awards.push({
                        id:response.data.id,
                        name:response.data.name,
                        email:response.data.email,
                        phone:response.data.phone,
                        created:response.data.created
                    });
                    
                }
                $scope.awardForm.$setPristine();
                $scope.tempAwardsData = {};
                $('.formData').slideUp();
                $scope.messageSuccess(response.msg);
            }else{
                $scope.messageError(response.msg);
            }
        });
    };

    $scope.addAward = function(){
        $scope.saveAward('add');
    };

    $scope.editAward = function(award){
        $scope.tempAwardsData = {
            id:award.id,
            name:award.name,
            email:award.email,
            phone:award.phone,
            created:award.created
        };
        $scope.index = $scope.awards.indexOf(award);
        $('.formData').slideDown();
    };

    $scope.updateAward = function(){
        $scope.saveAward('edit');
    };

    
    $scope.deleteAward = function(award){
        var conf = confirm('Are you sure to delete the award?');
        if(conf === true){
            var data = $.param({
                'id': awards.id,
                'type':'delete'    
            });
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }    
            };
            $http.post("awards.php",data,config).success(function(response){
                if(response.status == 'OK'){
                    var index = $scope.awards.indexOf(award);
                    $scope.awards.splice(index,1);
                    $scope.messageSuccess(response.msg);
                }else{
                    $scope.messageError(response.msg);
                }
            });
        }
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

}]);



