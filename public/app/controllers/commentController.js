angular.module('kuvaApp').controller('commentController', ['$scope', '$http', '$location', function($scope, $http, $location) {

    $scope.comments = [];
    var image_id = $location.absUrl().split('/').pop();
    $scope.upload = function () {
        //TODO: check comment for sql injection etc..
        $http({
            method: 'POST',
            url: '/www2016/public/comment/store/' + image_id,
            data: {
                comment: $scope.Comment.comment,
            }
        }).then(function successCallback(response) {
            if(response.data == "not_auth") {
                alert("not authorized");
            } else {
                console.log("Success:" + response.data);
                $scope.comments.push({
                    comment: response.data[0],
                    name: response.data[1].name,
                });
            }
        }, function errorCallback(response) {
            console.log("Error:" + response.data);
        });
    };

   var getComments = function() {
        console.log(image_id);
        $http({
            method: 'GET',
            url: '/www2016/public/comment/' + image_id,
            data: {
                image_id: image_id
            }
        }).then(function successCallback(response) {
            console.log("SUCCESS:" + response.data);
            if(response.data.length != null) {
                for (var i = 0; i < response.data.length; i++) {
                    for (var j = 0; j < response.data[i].length; j++) {
                        //console.log(response.data[j][i]);
                        $scope.comments.push({
                            comment: response.data[i][j].comment,
                            name: response.data[i][j].username
                        });
                    }
                }
            }
        }, function errorCallback(response) {
            console.log("ERROR: " + response);
        });
    };


    $scope.delete = function(id) {
        console.log(id);
        $http({
            method: 'DELETE',
            url: '/www2016/public/comment/delete/' + id
        }).then(function successCallback(response) {
            if(response.data == "not_auth") {
                alert("not authorized");
            } else {
                var index = 0, i = 0, flag = true;
                console.log("length: " + $scope.comments.length);
                angular.forEach($scope.comments, function(elem) {
                    if(flag) {
                        if (elem.comment.id == response.data.id) {
                            index = elem.comment.id;
                            flag = false;
                        }
                        i++;
                    }
                });
                index = i-1;
                console.log("index: " + index);
                $scope.comments.splice(index, 1);
            }
        }, function errorCallback(response) {
            console.log("ERROR: " + response);
        });
    };

    getComments();
}]);