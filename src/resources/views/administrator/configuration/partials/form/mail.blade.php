<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.mail.driver')}}
                @tooltip('cms::config.mail.driver-info')
            </label>
            {!! form()->select('env', [
                    'smtp'          => 'SMTP',
                    'mail'          => 'Mail',
                    'sendmail'      => 'Sendmail',
                    'mailgun'       => 'Mailgun',
                    'mandrill'      => 'Mandrill',
                    'ses'           => 'Amazon SES',
                    'sparkpost'     => 'Sparkpost',
                    'log'           => 'Log',
                    'preview'       => 'Preview',
                ], config("mail.driver"),[
                    'class'     => 'form-control',
                    'v-model'   => 'mail.driver'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.mail.host')}}
                @tooltip('cms::config.mail.host-info')
            </label>
            <input type="text" v-model="mail.host" class="form-control">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.mail.port')}}
                @tooltip('cms::config.mail.port-info')
            </label>
            <input type="text" v-model="mail.port" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.mail.encryption')}}
                @tooltip('cms::config.mail.encryption-info')
            </label>
            <input type="text" v-model="mail.encryption" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.mail.username')}}
                @tooltip('cms::config.mail.username-info')
            </label>
            <input type="text" v-model="mail.username" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.mail.username')}}
                @tooltip('cms::config.mail.username-info')
            </label>
            <input type="password" v-model="mail.password" class="form-control">
        </div>
    </div>
</div>
