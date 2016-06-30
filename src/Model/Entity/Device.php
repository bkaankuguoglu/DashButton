<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Device Entity.
 *
 * @property int $id
 * @property string $name
 * @property int $particle_number
 * @property string $phone
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $particle_long
 */
class Device extends Entity
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
        'id' => false,
    ];
}
