<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Membre'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="membre index large-9 medium-8 columns content">
    <h3><?= __('Membre') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mail_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('psw_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('civilite_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_naiss_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adRue_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adCP_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adVille_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rang') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valide_membre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('admin_membre') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($membre as $membre): ?>
            <tr>
                <td><?= $this->Number->format($membre->id_membre) ?></td>
                <td><?= h($membre->mail_membre) ?></td>
                <td><?= h($membre->psw_membre) ?></td>
                <td><?= h($membre->civilite_membre) ?></td>
                <td><?= h($membre->nom_membre) ?></td>
                <td><?= h($membre->prenom_membre) ?></td>
                <td><?= h($membre->date_naiss_membre) ?></td>
                <td><?= h($membre->adRue_membre) ?></td>
                <td><?= h($membre->adCP_membre) ?></td>
                <td><?= h($membre->adVille_membre) ?></td>
                <td><?= $this->Number->format($membre->rang) ?></td>
                <td><?= h($membre->valide_membre) ?></td>
                <td><?= h($membre->admin_membre) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $membre->id_membre]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $membre->id_membre]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $membre->id_membre], ['confirm' => __('Are you sure you want to delete # {0}?', $membre->id_membre)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
