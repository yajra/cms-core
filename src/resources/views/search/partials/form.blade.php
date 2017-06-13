<form action="" method="get" role="form" class="form-inline">
    <legend>{{trans('cms::search.title')}}</legend>

    <div class="form-group">
        <label for="q"></label>
        <input type="text" class="form-control" name="q" id="q" value="{{request('q')}}"
               placeholder="{{trans('cms::search.placeholder')}}">
    </div>

    <button type="submit" class="btn btn-primary">{{trans('cms::button.submit')}}</button>
</form>
