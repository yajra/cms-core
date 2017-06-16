@foreach($user->roles()->pluck('name')->all() as $role)
    <span class="badge badge-info">{!! $role !!}</span>
@endforeach
