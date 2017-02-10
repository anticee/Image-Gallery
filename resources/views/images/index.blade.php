@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-1" ng-controller="imageController">
        <div class="panel panel-default">
            <div class="panel-heading">Image</div>
            <div class="panel-body">
                @foreach ($image as $img)
                    <div id="window">
                        <img id="imageRes" class="img-responsive" src="{{'../images/' . $img->path . '.' . $img->extension}}" >
                    </div>

                    <!-- src="<%'../storage/app/' + row.path + '.' + row.extension%>" -->
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-heading">Info</div>
            <div class="panel-body">
                @foreach ($image as $img)
                    <p>Name: {{$img->name}}</p>
                    <p>Description: {{$img->description}}</p>
                    <p>Uploaded by: {{$username}}</p>
                    <p>Uploaded at: {{$img->created_at}}</p>

                    <?php if(\Illuminate\Support\Facades\Auth::user()->level() >= 2 || Auth::user()->allowed('image.delete', $img)) : ?>
                        <form action="{{ url('image/delete/'.$img->id) }}" method="POST">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}

                            <button type="submit" id="delete-image-{{ $img->id }}" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>Delete
                            </button>
                        </form>
                    <?php endif; ?>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row" ng-controller="commentController">
    <div class="col-md-8 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Comments</div>
            <div class="panel-body">
                <div class="row form-group">
                    <form name="commentForm" class="col-md-4">
                        {!! csrf_field() !!}
                        <textarea name="comment" ng-model="Comment.comment" placeholder="Your comment..." class="form-control" rows="5"></textarea>
                        <button class="btn-success" ng-click="upload()">Add Comment</button>
                    </form>
                </div>

                <div class="row col-md-4">
                    <div class="form-control" ng-repeat="row in comments track by $index" style="margin-bottom: 6px;height: 120px">
                        <p>User: <%row.name%></p>
                        <div class="">
                            <p>Comment: <%row.comment.comment%></p>
                        </div>
                        <div class="blank"></div>
                        <form name="deleteComment">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}

                            <button type="submit" ng-click="delete(row.comment.id)" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div

@endsection