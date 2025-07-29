<?php
class StudentsController extends AppController {

    public $uses = ['Student', 'Branch', 'Year'];
    public $components = ['Paginator', 'Flash', 'Session'];

    public function index() {
        $conditions = [];

        // If form is submitted
        if ($this->request->is('post')) {
            $branchId = h($this->request->data['branch_id']);
            $yearId = h($this->request->data['year_id']);

            if (!empty($branchId)) {
                $conditions['Student.branch_id'] = $branchId;
                $this->Session->write('Filter.branch_id', $branchId);
            } else {
                $this->Session->delete('Filter.branch_id');
            }

            if (!empty($yearId)) {
                $conditions['Student.year_id'] = $yearId;
                $this->Session->write('Filter.year_id', $yearId);
            } else {
                $this->Session->delete('Filter.year_id');
            }

        } else {
            // Apply session filters
            $branchId = $this->Session->read('Filter.branch_id');
            $yearId = $this->Session->read('Filter.year_id');

            if (!empty($branchId)) {
                $conditions['Student.branch_id'] = $branchId;
            }

            if (!empty($yearId)) {
                $conditions['Student.year_id'] = $yearId;
            }
        }

        $this->Paginator->settings = [
            'conditions' => $conditions,
            'contain' => ['Branch', 'Year'],
            'limit' => 10,
            'order' => ['Student.created' => 'desc']
        ];
        $students = $this->Paginator->paginate('Student');

        $branches = $this->Branch->find('list');
        $years = $this->Year->find('list');

        $this->set(compact('students', 'branches', 'years', 'branchId', 'yearId'));
    }

    public function clearFilter() {
        $this->Session->delete('Filter');
        return $this->redirect(['action' => 'index']);
    }


    public function add() {
        if ($this->request->is('post')) {
            // Check for duplicate student (name + branch + year)
            $existing = $this->Student->find('first', [
                'conditions' => [
                    'Student.name' => $this->request->data['Student']['name'],
                    'Student.branch_id' => $this->request->data['Student']['branch_id'],
                    'Student.year_id' => $this->request->data['Student']['year_id']
                ]
            ]);

            if ($existing) {
                $this->Flash->error(__('Student with the same name already exists in the selected branch and year.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Student->create();
            if ($this->Student->save($this->request->data)) {
                $this->Flash->success(__('Student has been added successfully.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Unable to add the student. Please try again.'));
            }
        }

        $branches = $this->Branch->find('list');
        $years = $this->Year->find('list');

        $this->set(compact('branches', 'years'));
    }

    public function edit($id = null) {
        if (!$id || !$this->Student->exists($id)) {
            throw new NotFoundException(__('Invalid student'));
        }

        if ($this->request->is(['post', 'put'])) {
            // Check for duplicate (excluding current record)
            $existing = $this->Student->find('first', [
                'conditions' => [
                    'Student.name' => $this->request->data['Student']['name'],
                    'Student.branch_id' => $this->request->data['Student']['branch_id'],
                    'Student.year_id' => $this->request->data['Student']['year_id'],
                    'Student.id !=' => $id
                ]
            ]);

            if ($existing) {
                $this->Flash->error(__('Student with the same name already exists in the selected branch and year.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Student->id = $id;
            if ($this->Student->save($this->request->data)) {
                $this->Flash->success(__('Student has been updated successfully.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Unable to update the student.'));
            }
        } else {
            $this->request->data = $this->Student->findById($id);
        }

        $branches = $this->Branch->find('list');
        $years = $this->Year->find('list');
        $this->set(compact('branches', 'years'));
    }

    public function delete($id = null) {
        $this->request->allowMethod('post');

        if (!$this->Student->exists($id)) {
            throw new NotFoundException(__('Invalid student'));
        }

        if ($this->Student->delete($id)) {
            $this->Flash->success(__('Student deleted successfully.'));
        } else {
            $this->Flash->error(__('Unable to delete the student.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
?>
