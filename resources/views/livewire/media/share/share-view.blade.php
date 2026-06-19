<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div>
        <div class="p-8">
            <div>
                Files in this share:
                @if (count($link->items) > 0)
                    <br />FileCount: {{ count($link->items) }}
                    <p />(expires: {{ $link->expires_at }})<br />
                <hr />
                    <ol>
                        @foreach($link->items as $item)
                            @if ($item->deleted_at != null)
                                <li>File deleted, fix up in code - {{ $item->file->filename }}</li>
{{--                                <li> (DL: <b>{{ $file->downloads_count }}</b>) <a wire:click="removeLinkItem({{ $item->id }})">X</a> | {{ $file->file->filename }} Has been upgraded. Please <a href="/sharing/tv/refresh/media/{{ $file->path->show->id }}">REFRESH</a> show folder</li>--}}
                            @else
                                <li> (DL: <b>{{ $item->downloads_count }}</b>) <a class="cursor-pointer" wire:click="removeLinkItem({{ $item->id }})">X</a> | {{ $item->file->filename }}</li>
                            @endif
                        @endforeach
                    </ol>
                @endif
            </div>

        </div>

    </div>

</div>
