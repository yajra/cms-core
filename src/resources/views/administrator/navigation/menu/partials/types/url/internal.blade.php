<div class="box box-default">
	  <div class="box-header with-border">
			<h3 class="box-title font-s14">Internal URL Parameters</h3>
	  </div>
	  <div class="box-body">
          <label class="form-label-style block" for="url">URL
              @tooltip('Link for this menu.')
              @include('administrator.partials.icon-required')
          </label>
          <div class="input-group {!! $errors->has('url') ? 'has-error' : '' !!}">
              <span class="input-group-addon site-label">{{asset('/')}}</span>
              {!! form()->input('text', 'url', null, ['id'=>'url','class'=>'form-control','placeholder'=>'URL']) !!}
          </div>
          {!! $errors->first('url', '<span class="help-block" style="color:#dd4b39">:message</span>') !!}
      </div>
</div>