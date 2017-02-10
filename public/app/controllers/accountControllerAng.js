/**
 * Created by Vasu on 9.5.2016.
 */
angular.module('kuvaApp').controller('accountControllerAng', ['$scope', '$http', function($scope, $http) {

    // Retrieve data for account
    $http({
        method: 'GET',
        url: '/www2016/public/api/AccountOptionsAng'
    }).then(function successCallback(response) {
        //console.log(response.data);
        $scope.Account = response.data;
    }, function errorCallback(response) {
        console.log("ERROR: " + response);
    });

    $scope.updateAccount = function() {
        $http({
            method: 'POST',
            url: '/www2016/public/AccountOptionsAng/update',
            data: $.param($scope.Account),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            console.log(response.data);
            $scope.AccountFormMessage = response.data.message;
        }, function errorCallback(response) {
            console.log("ERROR: " + response);
        });
    }
}]);