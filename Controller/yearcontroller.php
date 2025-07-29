<?php
class YearsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function add() {
        if ($this->request->is('post')) {
            $this->Year->create();
            if ($this->Year->save($this->request->data)) {
                $this->Flash->success('Year saved.');
                return $this->redirect(['action' => 'add']);
            }
        }
    }
}
?>