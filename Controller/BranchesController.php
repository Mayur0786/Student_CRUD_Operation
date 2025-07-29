<?php
class BranchesController extends AppController {
    public $uses = ['Branch', 'Student'];


    // public function index() {
    //     $branches = $this->Branch->find('all');
    //     $this->set(compact('branches'));
    // }

    public function index() {
    $branches = $this->Branch->find('all');

    // Count students for each branch
    foreach ($branches as $key => $branch) {
        $branchId = $branch['Branch']['id'];
        $studentCount = $this->Student->find('count', [
            'conditions' => ['Student.branch_id' => $branchId]
        ]);
        $branches[$key]['Branch']['student_count'] = $studentCount;
    }

    $this->set(compact('branches'));
}



    public function add() {
        if ($this->request->is('post')) {
            // Check for existing branch name
            $existing = $this->Branch->find('first', [
                'conditions' => ['Branch.name' => $this->request->data['Branch']['name']]
            ]);

            if ($existing) {
                $this->Flash->error(__('Branch already exists.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Branch->create();
            if ($this->Branch->save($this->request->data)) {
                $this->Flash->success(__('Branch has been added.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Unable to add the branch.'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id || !$this->Branch->exists($id)) {
            throw new NotFoundException(__('Invalid branch'));
        }

        if ($this->request->is(['post', 'put'])) {
            // Check for existing branch name excluding current one
            $existing = $this->Branch->find('first', [
                'conditions' => [
                    'Branch.name' => $this->request->data['Branch']['name'],
                    'Branch.id !=' => $id
                ]
            ]);

            if ($existing) {
                $this->Flash->error(__('Branch already exists.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Branch->id = $id;
            if ($this->Branch->save($this->request->data)) {
                $this->Flash->success(__('Branch has been updated.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Unable to update the branch.'));
            }
        } else {
            $this->request->data = $this->Branch->findById($id);
        }
    }

    public function delete($id = null) {
        $this->request->allowMethod('post');

        if (!$this->Branch->exists($id)) {
            throw new NotFoundException(__('Invalid Branch'));
        }

        // Count how many students are associated with this branch
        $studentCount = $this->Student->find('count', [
            'conditions' => ['Student.branch_id' => $id]
        ]);

        // Delete branch (and related students if dependent is true)
        if ($this->Branch->delete($id)) {
            if ($studentCount > 0) {
                $this->Flash->success(__('Branch and its %d associated student(s) have been deleted successfully.', $studentCount));
            } else {
                $this->Flash->success(__('Branch has been deleted successfully.'));
            }
        } else {
            $this->Flash->error(__('Unable to delete the branch.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
?>
