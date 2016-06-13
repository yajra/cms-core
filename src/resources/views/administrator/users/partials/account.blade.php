<div class="row">
    <div class="col-sm-3">
        <img src="{{ $user->present()->avatar() }}" alt="{{ $user->present()->name }}" class="thumbnail img-responsive">
    </div>
    <div class="col-sm-9">
        <table class="table table-bordered table-striped">
            <tr>
                <th><i class="fa fa-user"></i> Name</th>
                <td>{{ $user->present()->name }}</td>
            </tr>
            <tr>
                <th><i class="fa fa-envelope"></i> E-mail</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th><i class="fa fa-calendar"></i> Member since</th>
                <td>{{ $user->created_at->diffForHumans() }}</td>
            </tr>
            <tr>
                <th><i class="fa fa-calendar"></i> Last updated</th>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
            </tr>
        </table>
    </div>
</div>
