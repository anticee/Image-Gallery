@extends('layouts.app')
@section('content')
    <div class="container" ng-controller="accountControllerAng">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update user info</div>
                    <div class="panel-body">
                        <form class="form-horizontal" ng-submit="updateAccount()" name="AccountUpdateForm">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" ng-model="Account.email" value="<%Account.email%>" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="<%Account.name%>" ng-model="Account.name" required="">
                                </div>
                            </div>


                            <div class="col-md-6 control-label">
                                <div ng-show="AccountUpdateForm.$submitted">
                                    <span style="color:red" ng-show="AccountFormMessage"><%AccountFormMessage%></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
