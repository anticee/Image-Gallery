@extends('layouts.app')

@section('content')
<div class="container" ng-controller="imageController">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add Image</div>
                <div class="panel-body">

                    <form class="form-horizontal" name="form">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-1">Name</label>
                            <input class="col-md-4" type="text" name="name" ng-model="Image.name" required="">
                        </div>

                        <div class="row form-group">
                            <input class="col-md-4" type="file" ngf-select ng-model="picFile" name="picFile"
                                   accept="image/*" required>

                            <img ngf-thumbnail="picFile" class="img-thumbnail col-md-offset-1" width="124px" height="124px">
                        </div>

                        <!-- <div class="form-group" ng-show="picFile.progress >= 0">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                 aria-valuemin="0" aria-valuemax="100" ng-style="{width: picFile.progress + '%'}" ng-bind="picFile.progress + '%'">

                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="col-md-2">Description</label>
                            <input class="col-md-4" type="text" name="description" ng-model="Image.description" required="">
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <button
                                        ng-click="upload(picFile)">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Images</div>

                <div class="panel-body">

                    <div class="form-group">
                        <div class="col-md-4" ng-repeat="row in Image track by $index">
                            <a href="<%'image/' + row.id%>">
                                <img ng-src="<%'images/' + row.path + '.' + row.extension%>" style="margin-bottom: 12px"
                                 class="img-rounded" alt="image boi" width="120px" height="120px" top="12px"/>

                                <label class="text-info">  <%row.name%> </label>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
