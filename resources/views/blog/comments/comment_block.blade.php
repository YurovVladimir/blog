<div class="card comment_block" data-comment_id="{{ $comment->id ?? 0}}">
    <div class="card-body" >
        <div class="row">
            <div class="col-md-2 text-center">
                <img src="{{ $comment->user->avatar ?? '/img/default_avatar.jpg'}}"
                     class="avatar"/>
                <p class="text-secondary text-center">
                    {{ isset($comment) ? $comment->created_at->diffForHumans() : '' }}
                </p>

            </div>
            <div class="col-md-10">
                <p>
                    <a class="float-left">
                        <strong>
                            {{ $comment->user->name ?? '' }}
                        </strong>
                    </a>
                </p>
                <div class="clearfix"></div>
                <p class="comment_{{ $comment->id ?? 0}}">
                    {{ $comment->text ?? '' }}
                </p>
                <textarea style="display: none" id="comment_{{ $comment->id ?? 0 }}"
                          class="form-control">{{ $comment->text ?? ''}}</textarea>
                <div align="right">
                    <button type="submit"
                            class="btn btn-dark btn-sm save_comment"
                            data-comment_id="{{ $comment->id ?? 0}}"
                            style="display: none"> Редактировать комментарий
                    </button>
                </div>
            </div>
            @php $user = auth()->user()  @endphp
            @if($user && $user->id == ($comment->user_id ?? $user->id))
                <button class="delete_comment" data-comment_id="{{ $comment->id ?? 0 }}"
                        style="position: absolute; top: 0; right: 5px">
                    <i class="fa fa-times"></i>
                </button>
            @endif
            @if($user && $user->id == ($comment->user_id ?? $user->id))
                <button class="edit_comment" data-comment_id="{{ $comment->id ?? 0 }}"
                        style="position: absolute; top: 0; right: 35px">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>
            @endif
        </div>
    </div>
</div>