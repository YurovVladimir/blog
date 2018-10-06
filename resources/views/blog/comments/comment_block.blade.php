<style>
    a:hover {
        text-decoration: none !important;
    }
</style>

<div class="card section-comments comment_block" data-comment_id="{{ $comment->id ?? 0}}">
    <div class="media-area card-body">
        <div class="media">
            <a class="pull-left nav-link" href="{{ isset($comment) ? route('users.show', ['id' => $comment->user->id]) : '' }}">
                <div class="avatar">
                    <img class="media-object img-raised avatar avatar_a" alt="64x64"
                         src="{{isset($comment->user->avatar) ? Storage::url($comment->user->avatar) : '/img/default_avatar.jpg'}}">
                </div>
            </a>
            <div class="media-body">

                <h5 class="media-heading user_name">
                    <a href="{{ isset($comment) ? route('users.show', ['id' => $comment->user->id]) : '' }}">
                        <font style="vertical-align: inherit;">{{ $comment->user->name ?? auth()->user()->name ?? '' }}
                        </font>
                    </a>
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
                <div align="center">
                    <button type="submit"
                            class="btn btn-warning btn-round save_comment"
                            data-comment_id="{{ $comment->id ?? 0}}"
                            style="display: none">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Редактировать комментарий
                    </button>
                </div>
            </div>
            @php $user = auth()->user()  @endphp
            @if($user && $user->id == ($comment->user_id ?? $user->id))
                <button class="btn btn-dark btn-simple btn-icon btn-sm text-dark delete_comment"
                        data-comment_id="{{ $comment->id ?? 0 }}"
                        style="position: absolute; top: 0; right: 7px">
                    <i class="fa fa-times"></i>
                </button>
            @endif
            @if($user && $user->id == ($comment->user_id ?? $user->id))
                <button class="btn btn-dark btn-simple btn-icon btn-sm text-dark edit_comment"
                        data-comment_id="{{ $comment->id ?? 0 }}"
                        style="position: absolute; top: 0; right: 42px">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>
            @endif
        </div>
        <div class="card-footer">
            <div style="position: absolute; bottom: 5px; right: 9px">
                <button class="btn btn-dark btn-simple btn-sm text-dark liked"
                        data-comment_id="{{ $comment->id ?? 0 }}">
                    <i class="fa @if(auth()->user() && isset($comment) && $comment->likes->where('user_id', \auth()->user()->id)->where('is_liked', true)->count()) text-danger fa-heart
                @else text-default fa-heart-o @endif" aria-hidden="false"></i>
                    <span class="count">{{ isset($comment) ? $comment->likes->where('is_liked', true)->count() : '' }}</span>
                </button>
            </div>
        </div>
    </div>
</div>

