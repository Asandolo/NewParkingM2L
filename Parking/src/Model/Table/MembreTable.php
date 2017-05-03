<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Membre Model
 *
 * @method \App\Model\Entity\Membre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Membre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Membre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Membre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Membre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Membre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Membre findOrCreate($search, callable $callback = null, $options = [])
 */
class MembreTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('membre');
        $this->setDisplayField('id_membre');
        $this->setPrimaryKey('id_membre');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_membre')
            ->allowEmpty('id_membre', 'create');

        $validator
            ->allowEmpty('mail_membre');

        $validator
            ->allowEmpty('psw_membre');

        $validator
            ->allowEmpty('civilite_membre');

        $validator
            ->allowEmpty('nom_membre');

        $validator
            ->allowEmpty('prenom_membre');

        $validator
            ->date('date_naiss_membre')
            ->allowEmpty('date_naiss_membre');

        $validator
            ->allowEmpty('adRue_membre');

        $validator
            ->allowEmpty('adCP_membre');

        $validator
            ->allowEmpty('adVille_membre');

        $validator
            ->integer('rang')
            ->allowEmpty('rang');

        $validator
            ->boolean('valide_membre')
            ->allowEmpty('valide_membre');

        $validator
            ->boolean('admin_membre')
            ->allowEmpty('admin_membre');

        return $validator;
    }
}
