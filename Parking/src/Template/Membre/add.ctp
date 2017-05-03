<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Membre'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="membre form large-9 medium-8 columns content">
    <?= $this->Form->create($membre) ?>
    <fieldset>
        <legend><?= __('Add Membre') ?></legend>
        <?php
            echo $this->Form->control('mail_membre');
            echo $this->Form->control('psw_membre');
            echo $this->Form->control('civilite_membre');
            echo $this->Form->control('nom_membre');
            echo $this->Form->control('prenom_membre');
            echo $this->Form->control('date_naiss_membre', ['empty' => true]);
            echo $this->Form->control('adRue_membre');
            echo $this->Form->control('adCP_membre');
            echo $this->Form->control('adVille_membre');
            echo $this->Form->control('rang');
            echo $this->Form->control('valide_membre');
            echo $this->Form->control('admin_membre');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
