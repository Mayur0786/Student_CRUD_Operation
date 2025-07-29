<?php
class YearsController extends AppController {
    public $uses = ['Year', 'Student'];
    public $components = ['Flash']; // Ensure Flash component is loaded

    public function index() {
    $years = $this->Year->find('all');

    // Count students for each year
    foreach ($years as $key => $year) {
        $yearId = $year['Year']['id'];
        $studentCount = $this->Student->find('count', [
            'conditions' => ['Student.year_id' => $yearId]
        ]);
        $years[$key]['Year']['student_count'] = $studentCount;
    }

    $this->set(compact('years'));
}


    public function add() {
        if ($this->request->is('post')) {
            // Check for duplicate year name
            $existing = $this->Year->find('first', [
                'conditions' => ['Year.name' => $this->request->data['Year']['name']]
            ]);

            if ($existing) {
                $this->Flash->error(__('Year already exists.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Year->create();
            try {
                if ($this->Year->save($this->request->data)) {
                    $this->Flash->success(__('Year has been added.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Unable to save year. Please try again.'));
                }
            } catch (PDOException $e) {
                if ($e->getCode() === '45000') {
                    $this->Flash->error(__('Invalid year name. Only letters and spaces are allowed.'));
                } else {
                    $this->Flash->error(__('An unexpected error occurred. Please try again.'));
                }
            }
        }
    }

    public function edit($id = null) {
        if (!$id || !$this->Year->exists($id)) {
            throw new NotFoundException(__('Invalid year'));
        }

        if ($this->request->is(array('post', 'put'))) {
            // Check for duplicate year name excluding current ID
            $existing = $this->Year->find('first', [
                'conditions' => [
                    'Year.name' => $this->request->data['Year']['name'],
                    'Year.id !=' => $id
                ]
            ]);

            if ($existing) {
                $this->Flash->error(__('Year already exists.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Year->id = $id;
            if ($this->Year->save($this->request->data)) {
                $this->Flash->success(__('Year has been updated.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Unable to update the year.'));
            }
        } else {
            $this->request->data = $this->Year->findById($id);
        }
    }

    public function delete($id = null) {
        $this->request->allowMethod('post');

        if (!$this->Year->exists($id)) {
            throw new NotFoundException(__('Invalid year'));
        }

        // Count how many students are associated with this year
        $studentCount = $this->Student->find('count', [
            'conditions' => ['Student.year_id' => $id]
        ]);

        // Delete year (and related students if dependent is true)
       if ($this->Year->delete($id)) {
            if ($studentCount > 0) {
                $this->Flash->success(__('Year and its %d associated student(s) have been deleted successfully.', $studentCount));
            } else {
                $this->Flash->success(__('Year has been deleted successfully.'));
            }
        } else {
            $this->Flash->error(__('Unable to delete the year.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
?>
