@foreach($user->roles()->lists('name')->all() as $role)
<span class="badge badge-info">{!! $role !!}</span>&nbsp;
@endforeach
