@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                        <div id="comments">
            @if ( ! $comments->isEmpty() )
                @foreach ($comments as $comment)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    @foreach ($users as $user)
                                        @if ($user->id == $comment->uid)
                                            {{ $user->email }}
                                        @endif
                                    @endforeach                                    
                                </div>
                                <div class="col-md-6 text-right">
                                    <span class="badge">{{ $comment->created_at }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-11 text-left">
                                    {{ $comment->text }}
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            @endif
            </div>

            <div class="text-center">
                {!! $comments->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
