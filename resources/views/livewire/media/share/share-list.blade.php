<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <form wire:submit.prevent="createShare"></form>
            <flux:input type="text" wire:model="title" placeholder="Give your share a name" />
            <flux:button wire:click="submitForm">Submit</flux:button>
            <flux:button wire:click="createShare" variant="primary" >Create new share</flux:button>
            </form>
        </div>
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h3>Recent movies</h3>
            <ul>
                <li>Movie title 1</li>
                <li>Movie title 2</li>
                <li>Movie title 13</li>
            </ul>
        </div>
        <div class="overflow-y:auto relative aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-media.current-share />
        </div>
    </div>
    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">


        <div class="w-full" xmlns:flux="http://www.w3.org/1999/html">
            <div class="flex justify-between mb-3">
                <h1 class="test-3xl font-bold">Shares</h1>
            </div>

            <div class="w-full">

                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr class="border-b">
                        <td class="px-3 py-3">Title</td>
                        <td class="px-3 py-3">File count</td>
                        <td class="px-3 py-3">Slug</td>
                        <td class="px-3 py-3">Pass</td>
                        <td class="px-3 py-3">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($shares->isNotEmpty())
                        @foreach($shares as $m)
                            <tr>
                                <td class="px-3 py-3">{{ $m->title }}</td>
                                <td class="px-3 py-3">{{ $m->items->count() }}</td>
                                <td class="px-3 py-3">
                                    <input type="hidden" id="share-url-{{ $m->id }}" value="https://trisflix.com/link/{{ $m->slug }}">
                                    <button class="copy-btn cursor-pointer" data-clipboard-target="#share-url-{{ $m->id }}">
                                        {{ $m->slug }}
                                    </button>
                                </td>
                                <td class="px-3 py-3">
                                    <input type="hidden" id="share-pass-{{ $m->id }}" value="{{ $m->pass }}">
                                    <button class="copy-btn cursor-pointer" data-clipboard-target="#share-pass-{{ $m->id }}">
                                        {{ $m->slug }}
                                    </button>
                                </td>
                                <td class="px-3 py-3">
                                    @if($m->id != session('link_id'))
                                        <flux:button variant="subtle" icon="x-circle" class="xs" wire:click="setShareActive({{$m->id}})" />
                                    @else
                                        <flux:button variant="primary" icon="check-circle" class="xs  opacity-50 cursor-not-allowed bg-emerald-400" />
                                    @endif
                                    <flux:button icon="eye" class="xs" wire:click="viewFiles({{$m->id}})" />
                                    <flux:button icon="trash" class="xs" variant="danger" wire:confirm="Are you sure you want to delete this share?" wire:click="deleteShare({{$m->id}})" />
                                </td>
                            </tr>
                        @endforeach
                    @else
                        There are no shares
                    @endif
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $shares->links() }}
                </div>

            </div>

        </div>



    </div>
</div>
