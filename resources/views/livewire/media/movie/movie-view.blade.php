<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

    <flux:button wire:click="indexMovie({{$id}})">Scan DIR</flux:button>

    <div>
        @if(count($paths) > 0)
            <form method="POST" wire:submit.prevent="addSelectedFiles">
                @if(session('slug'))
                    @csrf
                    <flux:button wire:click="addSelectedFiles">Add selected</flux:button>
                @endif

                @foreach($paths->SortByDesc('path') as $path)
                    <div class="p-8">
                        <flux:field>
                            <flux:checkbox label="Select all files" value="1"  />
                        </flux:field>
                    </div>

                        <div class="p-8">
                    @foreach($path->files->SortByDesc('filename') as $file)
                        <input
                            wire:model="file_id"
                               type="checkbox"
                               @if((isset($file->link)) && $file->id == $file->link->link_id) checked="checked" @endif
                               value="{{ $file->id }}"
                               name="file_id[]"
                               id="file_id[{{ $file->id }}]"
                               class="all_{{ $path->id }}"> -

                        <label for="file_id[{{ $file->id }}]">
                            @if (pathinfo($file->filename, PATHINFO_EXTENSION) == 'srt')
                                <b><i>(SUBTITLE FILE)</i></b>
                            @endif
                            {{ $file->filename }}
                                <flux:button wire:click="download({{$file->id}})">Download</flux:button>
                        </label>
                        <br />
                    @endforeach()
                        </div>

                @endforeach()
            </form>
        @endif
    </div>

</div>
