<input type="hidden" v-model="mail.config" value="mail">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Email Driver
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
                ], $configuration->key("mail.driver"),[
                    'class'     => 'form-control select2',
                    'v-model'   => 'mail.driver',
                    'config'    => 'mail.driver'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Host
                @tooltip('Here you may provide the host address of the SMTP server used by your applications. A default option is provided that is compatible with the Mailgun mail service which will provide reliable deliveries.')
            </label>
            {!! form()->input('text', 'host', $configuration->key("mail.host"),[
                'id'            => 'mail_host',
                'class'         => 'form-control',
                'placeholder'   => 'Enter Email Host Here',
                'v-model'       => 'mail.host'
            ]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Port
                @tooltip('This is the SMTP port used by your application to deliver e-mails to users of the application. Like the host we have set this value to stay compatible with the Mailgun e-mail application by default.')
            </label>
            {!! form()->input('text', 'port', $configuration->key("mail.port"), [
                'id'            => 'mail_port',
                'class'         => 'form-control',
                'placeholder'   => 'Enter Email Port Here',
                'v-model'       => 'mail.port'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Encryption
                @tooltip('Here you may specify the encryption protocol that should be used when the application send e-mail messages. A sensible default using the transport layer security protocol should provide great security.')
            </label>
            {!! form()->input('text', 'encryption', $configuration->key("mail.encryption"), [
                'id'            => 'mail_host',
                'class'         => 'form-control',
                'placeholder'   => 'Enter Encryption Protocol Here',
                'v-model'       => 'mail.encryption'
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Email Username
                @tooltip('If your SMTP server requires a username for authentication, you should set it here. This will get used to authenticate with your server on connection. You may also set the "password" value below this one.')
            </label>
            {!! form()->input('text', 'username', $configuration->key("mail.username"), [
                'id'            => 'mail_username',
                'class'         => 'form-control',
                'placeholder'   => 'Enter Email Username Here',
                'v-model'       => 'mail.username'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Email Password
                @tooltip('Here you may set the password required by your SMTP server to send out messages from your application. This will be given to the server on connection so that the application will be able to send messages.')
            </label>
            {!! form()->input('text', 'password', '', [
                'id'            => 'mail_host',
                'class'         => 'form-control',
                'placeholder'   => 'Enter Email Password Here',
                'v-model'       => 'mail.password'
            ]) !!}
        </div>
    </div>
</div>