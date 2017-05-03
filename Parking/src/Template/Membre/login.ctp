<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel">
        <h2 class="text-center">Connexion</h2>
        <?= $this->Form->create(); ?>
            <?= $this->Form->input('mail_membre'); ?>
            <?= $this->Form->input('psw_membre', array('type' => 'password')); ?>
            <?= $this->Form->submit('login', array('class' => 'button')); ?>
        <?= $this->Form->end(); ?>
    </div>
</div>