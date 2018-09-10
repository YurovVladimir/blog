<div class="card section-comments comment_block" data-comment_id="{{ $comment->id ?? 0}}">
    <div class="media-area card-body">
        <div class="media">
            <div class="avatar">
                <img class="media-object img-raised avatar avatar_a"
                     src="{{ $comment->user->avatar ?? '/img/default_avatar.jpg'}}">
            </div>
            <div class="media-body">
                <h5 class="media-heading user_name">
                    <font style="vertical-align: inherit;">{{ $comment->user->name ?? '' }}
                    </font>
                    <small class="text-muted created_at">
                        <font style="vertical-align: inherit;">
                            {{ isset($comment) ? $comment->created_at->diffForHumans() : '' }}
                        </font>
                    </small>
                </h5>
                <p class="comment_{{ $comment->id ?? 0}}">
                    <font style="vertical-align: inherit;">
                        {{ $comment->text ?? '' }}
                    </font>
                </p>
                <textarea style="display: none" id="comment_{{ $comment->id ?? 0 }}"
                          class="form-control">{{ $comment->text ?? ''}}</textarea>
                <div align="right">
                    <button type="submit"
                            class="btn btn-default btn-round save_comment"
                            data-comment_id="{{ $comment->id ?? 0}}"
                            style="display: none">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Редактировать комментарий
                    </button>
                </div>
            </div>
            @php $user = auth()->user()  @endphp
            @if($user && $user->id == ($comment->user_id ?? $user->id))
                <button class="btn btn-default btn-icon btn-round btn-sm delete_comment"
                        data-comment_id="{{ $comment->id ?? 0 }}"
                        style="position: absolute; top: 0; right: 5px">
                    <i class="fa fa-times"></i>
                </button>
            @endif
            @if($user && $user->id == ($comment->user_id ?? $user->id))
                <button class="btn btn-default btn-icon btn-round btn-sm edit_comment"
                        data-comment_id="{{ $comment->id ?? 0 }}"
                        style="position: absolute; top: 0; right: 38px">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>
            @endif
        </div>
        <div class="card-footer">
            <div class="color-default" style="position: absolute; bottom: 5px; right: 10px">
                <i class="now-ui-icons ui-2_favourite-28 liked" data-comment_id="{{ $comment->id ?? 0 }}"></i> {{  }}
            </div>
        </div>
    </div>
</div>

