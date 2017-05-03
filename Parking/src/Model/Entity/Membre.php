<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Membre Entity
 *
 * @property int $id_membre
 * @property string $mail_membre
 * @property string $psw_membre
 * @property string $civilite_membre
 * @property string $nom_membre
 * @property string $prenom_membre
 * @property \Cake\I18n\Time $date_naiss_membre
 * @property string $adRue_membre
 * @property string $adCP_membre
 * @property string $adVille_membre
 * @property int $rang
 * @property bool $valide_membre
 * @property bool $admin_membre
 */
class Membre extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id_membre' => false
    ];

    protected function _setpsw_membre($psw){
        return md5($psw);
    }   
}
