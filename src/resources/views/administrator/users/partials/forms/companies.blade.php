<div class="box">
    <div class="panel-heading with-border">
        <h3 class="box-title">Companies</h3>
    </div>
    <div class="panel-body">
        <div class="form-group {!! $errors->has('companies') ? 'has-error' : '' !!}">
            <div class="col-md-12">
                {!! form()->select('companies[]', $companies , $selectedCompanies , ['class' => 'form-control dual-listbox', 'multiple']) !!}
            </div>
        </div>
    </div>
</div>
