<form action="{!! url('administrator/search') !!}" method="get" class="search-form" autocomplete="off">
    <div class='input-group'>
        <input type="text" name="q" value="{!! request()->get('q') !!}" class='form-control' placeholder="Search"/>
        <div class="input-group-btn">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
