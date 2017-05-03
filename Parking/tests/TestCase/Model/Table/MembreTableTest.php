<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MembreTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MembreTable Test Case
 */
class MembreTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MembreTable
     */
    public $Membre;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.membre'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Membre') ? [] : ['className' => 'App\Model\Table\MembreTable'];
        $this->Membre = TableRegistry::get('Membre', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Membre);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
