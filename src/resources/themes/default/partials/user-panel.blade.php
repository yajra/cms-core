<div class="user-panel">
    <div class="pull-left image">
        {{ html()->image(
            currentUser()->present()->avatar ,
            'alt',
            array( 'class' => 'img-circle', 'style' => "" ))
        }}
    </div>
    <div class="pull-left info">
        <p>{{ currentUser()->present()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> {{ currentUser()->email }}</a>
    </div>
</div>
