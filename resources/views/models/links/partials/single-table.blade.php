<tr>
    <td>
        <div>
            <a href="{{ route('links.show', [$link]) }}">
                {{ $link->title }}
            </a>
            @if($link->is_private)
                <span>
                <x-icon.lock class="me-1" title="@lang('link.private')"/>
                <span class="visually-hidden">@lang('link.private')</span>
            </span>
            @endif
        </div>
        @if($link->tags->count() > 0)
            <div class="mt-1">
                <label class="small mb-0">@lang('tag.tags'):</label>
                @foreach($link->tags as $tag)
                    <a href="{{ route('tags.show', [$tag]) }}" class="btn btn-xs btn-light">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </td>
    <td>
        <a href="{{ $link->url }}" {!! linkTarget() !!}>
            {{ $link->shortUrl() }}
        </a>
    </td>
    <td class="text-muted">
        <small>{!! $link->addedAt() !!}</small>
    </td>
    @if(!isset($hide_edit))
        <td class="text-right">
            <div class="btn-group btn-group-xs">
                @auth()
                    <a href="{{ route('links.edit', [$link]) }}" class="btn btn-outline-secondary">
                        <x-icon.edit/>
                        <span class="visually-hidden">@lang('link.edit')</span>
                    </a>
                @endauth
                <button type="submit" form="link-delete-{{ $link->id }}" title="@lang('link.delete')"
                    class="btn btn-outline-secondary">
                    <x-icon.trash/>
                    <span class="visually-hidden">@lang('link.delete')</span>
                </button>
            </div>
            <form id="link-delete-{{ $link->id }}" method="POST" class="d-none"
                action="{{ route('links.destroy', [$link]) }}">
                @method('DELETE')
                @csrf
                <input type="hidden" name="link_id" value="{{ $link->id }}">
            </form>
        </td>
    @endif
</tr>
