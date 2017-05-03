<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Membre Controller
 *
 * @property \App\Model\Table\MembreTable $Membre
 */
class MembreController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $membre = $this->paginate($this->Membre);

        $this->set(compact('membre'));
        $this->set('_serialize', ['membre']);
    }

    /**
     * View method
     *
     * @param string|null $id Membre id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $membre = $this->Membre->get($id, [
            'contain' => []
        ]);

        $this->set('membre', $membre);
        $this->set('_serialize', ['membre']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $membre = $this->Membre->newEntity();
        if ($this->request->is('post')) {
            $membre = $this->Membre->patchEntity($membre, $this->request->getData());
            if ($this->Membre->save($membre)) {
                $this->Flash->success(__('The membre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The membre could not be saved. Please, try again.'));
        }
        $this->set(compact('membre'));
        $this->set('_serialize', ['membre']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Membre id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $membre = $this->Membre->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $membre = $this->Membre->patchEntity($membre, $this->request->getData());
            if ($this->Membre->save($membre)) {
                $this->Flash->success(__('The membre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The membre could not be saved. Please, try again.'));
        }
        $this->set(compact('membre'));
        $this->set('_serialize', ['membre']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Membre id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $membre = $this->Membre->get($id);
        if ($this->Membre->delete($membre)) {
            $this->Flash->success(__('The membre has been deleted.'));
        } else {
            $this->Flash->error(__('The membre could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    // Lofin
    public function login(){
        
    }
}
