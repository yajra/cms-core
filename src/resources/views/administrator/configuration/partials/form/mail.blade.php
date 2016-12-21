<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Email Driver
                @tooltip('Laravel supports both SMTP and PHPs "mail" function as drivers for the sending of e-mail. You may specify which one youre using throughout your application here. By default, Laravel is setup for SMTP mail.')
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
                Host
                @tooltip('Here you may provide the host address of the SMTP server used by your applications. A default option is provided that is compatible with the Mailgun mail service which will provide reliable deliveries.')
            </label>
            <input type="text" v-model="mail.host" class="form-control">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">Port
                @tooltip('This is the SMTP port used by your application to deliver e-mails to users of the application. Like the host we have set this value to stay compatible with the Mailgun e-mail application by default.')
            </label>
            <input type="text" v-model="mail.port" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Encryption
                @tooltip('Here you may specify the encryption protocol that should be used when the application send e-mail messages. A sensible default using the transport layer security protocol should provide great security.')
            </label>
            <input type="text" v-model="mail.encryption" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Email Username
                @tooltip('If your SMTP server requires a username for authentication, you should set it here. This will get used to authenticate with your server on connection. You may also set the "password" value below this one.')
            </label>
            <input type="text" v-model="mail.username" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Email Password
                @tooltip('Here you may set the password required by your SMTP server to send out messages from your application. This will be given to the server on connection so that the application will be able to send messages.')
            </label>
            <input type="password" v-model="mail.password" class="form-control">
        </div>
    </div>
</div>
