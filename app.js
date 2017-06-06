angular.module('Recognize', []);
angular.module('app', ['signature']);

angular.module('app').controller('AppCtrl', function($scope) {
    $scope.boundingBox = {
        width: 490,
        height: 300
    };
});
