<form action="{!! route('admin.search') !!}" method="get" class="sidebar-form" autocomplete="off">
    <div class="input-group">
        <input type="text" name="q" value="{!! Input::get('q') !!}" class="form-control" placeholder="Search..."/>
        <span class="input-group-btn">
            <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
    </div>
</form>
