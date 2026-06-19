<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <flux:button wire:click="updateTv" variant="primary" >Scan for new Shows</flux:button>
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
                <h1 class="test-3xl font-bold">TV Shows</h1>
            </div>

            <div></div>

            <div class="flex w-xl mb-3">
                <flux:input wire:model.live.debounce.350ms="search" placeholder="Search" class="me-2" />
            </div>

            <div class="w-full">

                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr class="border-b">
                        <td class="px-3 py-3">Name</td>
                        <td class="px-3 py-3">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($tvs->isNotEmpty())
                        @foreach($tvs as $tv)
                            <tr>
                                <td class="px-3 py-3">{{ $tv->title }}</td>
                                <td class="px-3 py-3">
                                    <flux:button icon="eye" wire:navigate href="{{ route('tv.view', $tv->id) }}" />
                                    @if(session('slug'))
                                        <flux:button icon="arrow-left-end-on-rectangle" wire:click="addToShare({{ $tv->id }})" />
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        There are no movies
                    @endif
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $tvs->links() }}
                </div>

            </div>

        </div>



    </div>
</div>
