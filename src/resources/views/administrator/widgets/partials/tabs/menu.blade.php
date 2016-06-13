<div class="content no-padding">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! $errors->has('assignment') ? 'has-error' : '' !!}">
                <label class="form-label-style" for="assignment">Widget Assignment</label>

                {{ form()->select('assignment', [0 => 'On all pages', 1 => 'No pages', 2 => 'Only on the pages selected'], null, ['class' => 'form-control']) }}
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
                        {{$menu->present()->indentedTitle()}} <small>(Alias: {{ $menu->present()->url() }})</small>
                    </label>
                </li>
            @empty
                <li class="list-group-item">
                    <p class="text-danger">You don't have any menu!</p>
                    <p>
                        <span class="label label-info">Heads Up!</span>
                        You can create menu items inside the <a href="{{ route('administrator.navigation.index') }}">navigation</a> component.
                    </p>
                </li>
            @endforelse
            </ul>
        </div>
    </div>
</div>