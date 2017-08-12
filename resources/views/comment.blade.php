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
                                <div class="col-md-1 text-right">
                                    @if ( $comment->uid == Auth::user()->id )
                                        <button data-id="{{ $comment->id }}" class="btn btn-danger remove">
                                            <i class="fa fa-trash" aria-hidden="true"></i>          
                                        </button> 
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            @endif
            </div>

            <form class="form-horizontal" id="create_comment" method="POST" action="{{ route('comment') }}">
                <textarea class="form-control" rows="4" name="text"></textarea>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <input type="submit" class="btn btn-primary" value="Отправить">
                    </div>
                </div>
                {{ csrf_field() }}
            </form>

            <script type="text/javascript">
                $(document).ready(function() {
                    var email = '{{ Auth::user()->email }}';
                    $('#create_comment').submit(function(e) {
                        e.preventDefault();
                        $.post({
                            url: $(this).attr('action'),
                            type: $(this).attr('method'),
                            data: $(this).serialize(),
                            dataType: 'json',
                            success: function(data) {
                                if (data['created_at']) {
                                    var comment = '<div class="panel panel-default"><div class="panel-heading"><div class="row"><div class="col-md-6 text-left">'+email+'</div><div class="col-md-6 text-right"><span class="badge">'+data['created_at']+'</span></div></div></div><div class="panel-body"><div class="row"><div class="col-md-11 text-left">'+data['text']+'</div><div class="col-md-1 text-right"><button data-id="'+data['id']+'" class="btn btn-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></button></div></div></div></div>';

                                    $(comment).appendTo($('#comments'));

                                    $('textarea[name="text"]').val('');
                                }
                                                              
                            },
                        });
                    })

                    $(document).on('click', '.remove', function() {
                        var data_id = $(this).attr('data-id');

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "{{ route('delete') }}/"+data_id,
                            type: 'post',
                            success: function(data) {
                                console.log(data);
                                if (data['result'] == 'success')
                                {
                                    var prnt = $(this).parents('.panel');
                                    var ind = prnt.index();
                                    $('.panel').eq(ind).remove();
                                }
                            },
                        });
    
                    })
                });
            </script>
        </div>
    </div>
</div>

@endsection
