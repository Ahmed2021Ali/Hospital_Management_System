<div>
    @if (session()->has('message'))
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endif
    @if($showTable == true)
        @include('livewire.group-services.show_groups')
    @else
        @include('livewire.group-services.add_group')
    @endif
</div>
