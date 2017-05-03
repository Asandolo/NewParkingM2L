<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Membre'), ['action' => 'edit', $membre->id_membre]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Membre'), ['action' => 'delete', $membre->id_membre], ['confirm' => __('Are you sure you want to delete # {0}?', $membre->id_membre)]) ?> </li>
        <li><?= $this->Html->link(__('List Membre'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Membre'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="membre view large-9 medium-8 columns content">
    <h3><?= h($membre->id_membre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Mail Membre') ?></th>
            <td><?= h($membre->mail_membre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Psw Membre') ?></th>
            <td><?= h($membre->psw_membre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Civilite Membre') ?></th>
            <td><?= h($membre->civilite_membre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom Membre') ?></th>
            <td><?= h($membre->nom_membre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prenom Membre') ?></th>
            <td><?= h($membre->prenom_membre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AdRue Membre') ?></th>
            <td><?= h($membre->adRue_membre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AdCP Membre') ?></th>
            <td><?= h($membre->adCP_membre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AdVille Membre') ?></th>
            <td><?= h($membre->adVille_membre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Membre') ?></th>
            <td><?= $this->Number->format($membre->id_membre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rang') ?></th>
            <td><?= $this->Number->format($membre->rang) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Naiss Membre') ?></th>
            <td><?= h($membre->date_naiss_membre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valide Membre') ?></th>
            <td><?= $membre->valide_membre ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Membre') ?></th>
            <td><?= $membre->admin_membre ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
