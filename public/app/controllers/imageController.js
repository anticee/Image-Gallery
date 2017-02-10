/**
 * Created by Vasu on 9.5.2016.
 */
angular.module('kuvaApp').controller('imageController', ['$scope', '$http', 'Upload', function($scope, $http, Upload) {

    // Retrieve data for account
    var getImages = function() {
        $http({
            method: 'GET',
            url: '/www2016/public/api/image',
        }).then(function successCallback(response) {
            if(response.data == "not_auth") {
                alert("not authorized");
            } else {
                console.log("SUCCESS:" + response.data);
                $scope.Image = response.data;
            }
        }, function errorCallback(response) {
            console.log("ERROR: " + response);
        });
    };

    $scope.upload = function (file) {
        //TODO: check image name and description for illegal arguments(sql etc...).
        if(file != null && $scope.Image.name != null && $scope.Image.description != null
        && file.type.indexOf('image') !== -1) {
            Upload.upload({
                url: '/www2016/public/image/store',
                data: {
                    file: file,
                    name: $scope.Image.name,
                    description: $scope.Image.description,
                    extension: $scope.Image.extension
                }
            }).then(function (resp) {
                if(resp.data == "not_auth") {
                    alert(resp.data);
                } else if(resp.data == "bad_file") {
                    alert(resp.data);
                } else {
                    console.log('Success ' + resp.config.data.file.name + ' uploaded.');
                    getImages();
                }
            }, function (resp) {
                console.log('Error status: ' + resp.status);
                $scope.Image.errorMsg = "Error while uploading file";
            }, function (evt) {
                //var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                //console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
                //file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
        }
    };

    getImages();

}]);