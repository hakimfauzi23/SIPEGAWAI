<?php $user = Auth::user(); ?>
<div class="sidebar-user">
    <div class="category-content">
        <div class="media">
            @php $path =Storage::url('images/'.$user->path); @endphp
            <a href="#" class="media-left"><img src="{{ url($path) }}"
                    onerror="this.onerror=null; this.src='{{ URL::to('/admin/assets/images/brands/user.jpeg') }}'"
                    class="img-circle img-sm" alt=""></a>
            <div class="media-body">

                <span class="media-heading text-semibold"> {{ $user->nama }}</span>
                <div class="text-size-mini text-muted text-uppercase">
                    <i class="icon-key text-size-small "></i> <em>&nbsp;{{ $user->role->name }}</em>
                </div>
            </div>

        </div>
    </div>
</div>
