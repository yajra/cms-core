@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet"
      type="text/css">
<style>
    #ms-permissionsSelect {
        width: 100% !important;
    }

    .custom-header {
        border-radius: 0px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .search-input {
        width: 100% !important;
        margin-bottom: 5px;
        padding: 5px;
        outline: none;
    }

    .ms-optgroup-label {
        color: #236479 !important;
    }

    .permission-slug {

    }
</style>
@endpush

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title" style="font-size: 15px;">
            <i class="fa fa-tag"></i>
            {{trans('cms::permission.attached')}}
            {!! $errors->first('permissions', '<small class="help-inline text-red">:message</small>') !!}
        </h3>
    </div>
    <div class="box-body {{ hasError('permissions') }}">
        <div>
            <select multiple="multiple" id="permissionsSelect" name="permissions[]">
                @foreach($permissions->groupBy('resource')->chunk(2) as $chunks)
                    @foreach($chunks as $resource)
                        @foreach($resource->chunk(4) as $chunk)
                            <optgroup label='{{ $resource[0]->resource }} Resource'>
                                @foreach($chunk as $permission)
                                    <option value='{{$permission->id}}' {!! in_array($permission->id, $model->permissions()->select('permissions.id')->pluck('id')->all()) ? 'selected' : '' !!}>
                                        {{$permission->name}}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"
        type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.0/jquery.quicksearch.min.js"
        type="text/javascript"></script>
<script>
    $('#permissionsSelect').multiSelect({
        selectableHeader: "<input type='text' class='search-input block' autocomplete='off' placeholder='Quick seach...'>",
        selectionHeader: "<input type='text' class='search-input block' autocomplete='off' placeholder='Quick seach...'>",
        selectableFooter: "<a href='#' class='btn btn-danger block custom-header' id='selectAll'>select all</a>",
        selectionFooter: "<a href='#' class='btn btn-danger block custom-header' id='deselectAll'>deselect all</a>",
        afterInit: function (ms) {
            var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
        },
        afterSelect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        selectableOptgroup: true
    });
    $('#selectAll').click(function () {
        $('#agentSelect').multiSelect('select_all');
        return false;
    });
    $('#deselectAll').click(function () {
        $('#agentSelect').multiSelect('deselect_all');
        return false;
    });
</script>
@endpush
