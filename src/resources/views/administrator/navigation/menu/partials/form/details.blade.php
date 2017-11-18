<div class="row">
    <div class="col-md-8">
        <div class="form-group {{ hasError('title') }}">
            <label class="form-label-style block" for="title">Menu Title
                @tooltip('The title of menu that will display in menu.')
            </label>
            {!! form()->input('text', 'title', null, ['id'=>'title','class'=>'form-control','placeholder'=>'Enter title here']) !!}
            @error('title')
        </div>

        <div id="menu-item-container">
            <div class="input-group">
                <input type="hidden"
                       v-model="extension.id"
                       name="extension_id"
                       value="{{ old('extension_id', $menu->extension->id) }}"/>
                <input type="text"
                       title="Menu Type"
                       class="form-control"
                       name="extension_name"
                       v-model="extension.name"
                       value="{{ old('extension_name', $menu->extension->name) }}"
                       readonly/>
                <div class="input-group-btn">
                    <button data-toggle="modal" data-target="#menu-items-modal" class="btn btn-primary btn-flat"
                            type="button">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;Select Menu Type
                    </button>
                </div>
            </div>

            <hr>

            <div id="menu-item-selected-container"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ hasError('parent_id') }}">
            <label for="parent_id" class="form-label-style block">
                Parent
                @tooltip('Parent menu item.')
            </label>
            {!! form()->select('parent_id', $menu->getParentsList(), null, ['class' => 'select2 form-control']) !!}
            @error('parent_id')
        </div>

        <div class="form-group {{ hasError('target') }}">
            <label class="form-label-style block" for="target">
                On Click, Open in:
                @tooltip('Target browser window when the menu item is selected.')
            </label>
            {!! form()->select('target', ['0' => 'Parent','1' => 'New Window'], null,['class'=> 'select2 form-control']) !!}
            @error('target')
        </div>
        <div class="form-group {{ hasError('order') }}">
            <label class="form-label-style block" for="order">
                Order
                @tooltip('Display order of the menu.')
            </label>
            {!! form()->text('order',null , ['class' => 'form-control']) !!}
            @error('order')
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ hasError('authenticated') }}">
                    <label class="form-label-style" for="authenticated">
                        Authenticated
                        @tooltip('Requires authentication to access the menu.')
                    </label>
                    <br>
                    {!! form()->checkbox('authenticated', $value = 1, $checked = null, ['name' =>'authenticated','id'=>'authenticated','class'=>'form-control bootstrap-checkbox']) !!}
                    @error('authenticated')
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ hasError('published') }}">
                    <label class="form-label-style" for="published">
                        Published
                        @tooltip('Set publication status.')
                    </label>
                    <br>
                    {!! form()->checkbox('published', $value = 1, $checked = null, ['name' =>'published','id'=>'published','class'=>'form-control bootstrap-checkbox']) !!}
                    @error('published')
                </div>
            </div>
        </div>
    </div>
</div>
