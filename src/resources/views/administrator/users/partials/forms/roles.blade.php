<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Attach Roles</h3>
	  </div>
	  <div class="panel-body">
          <div class="row {!! $errors->has('roles') ? 'has-error' : '' !!}">
              <div class="col-md-12">
                  {!! form()->select('roles[]', $roles->lists('name', 'id') , $selectedRoles , ['id'=>'role-multi-select','class' => 'form-control', 'multiple']) !!}
                  {!! $errors->first('roles', '<span class="help-block font-red-pink">:message</span>') !!}
              </div>
          </div>
          <br>
          <p class="quoted">
              <strong>Note:</strong> <br>User will inherit all the permissions of the roles they are assigned to.
          </p>
	  </div>
</div>