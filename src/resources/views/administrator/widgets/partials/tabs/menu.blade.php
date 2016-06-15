<div class="content no-padding">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! $errors->has('assignment') ? 'has-error' : '' !!}">
                <label class="form-label-style" for="assignment">
                    {{trans('cms::widget.menu.assignment')}}
                </label>

                {{ form()->select('assignment', [
                    0 => trans('cms::widget.menu.assignments.all'),
                    1 => trans('cms::widget.menu.assignments.none'),
                    2 => trans('cms::widget.menu.assignments.selected')
                    ], null, ['class' => 'form-control']) }}
                {!! $errors->first('assignment', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                @forelse (\Yajra\CMS\Entities\Menu::root()->descendants()->get() as $menu)
                    <li class="list-group-item">
                        <input type="checkbox" id="{{$menu->id}}" value="{{$menu->id}}"
                               name="menu[]"
                               class="md-check" {!! in_array($menu->id, $widget->menus()->select('menus.id')->lists('id')->all()) ? 'checked' : '' !!}>
                        <label for="{{$menu->id}}">
                            {{$menu->present()->indentedTitle()}}
                            <small>(Alias: {{ $menu->present()->url() }})</small>
                        </label>
                    </li>
                @empty
                    <li class="list-group-item">
                        <p class="text-danger">{{trans('cms::widget.menu.empty')}}</p>
                        <p>
                            <span class="label label-info">Heads Up!</span>
                            {!! trans('cms::widget.menu.empty_content', ['link' => '<a href="'. route('administrator.navigation.index') .'">'.trans('cms::navigation.index.title').'</a>']) !!}
                        </p>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
