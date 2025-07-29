<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg animate__animated animate__fadeInUp">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Student List</h4>
                <?php echo $this->Html->link('Add Student', ['action' => 'add'], ['class' => 'btn btn-light btn-sm']); ?>
            </div>

            <div class="card-body">
                <!-- Filter Form -->
                <?php echo $this->Form->create(null, ['type' => 'post', 'class' => 'row g-3 mb-4']); ?>

                <div class="col-md-5">
                    <?php echo $this->Form->input('branch_id', [
                        'label' => false,
                        'type' => 'select',
                        'options' => $branches,
                        'empty' => 'Filter by Branch',
                        'div' => false,
                        'class' => 'form-select',
                        'default' => isset($branchId) ? $branchId : null
                    ]); ?>
                </div>

                <div class="col-md-5">
                    <?php echo $this->Form->input('year_id', [
                        'label' => false,
                        'type' => 'select',
                        'options' => $years,
                        'empty' => 'Filter by Year',
                        'div' => false,
                        'class' => 'form-select',
                        'default' => isset($yearId) ? $yearId : null
                    ]); ?>
                </div>

                <div class="col-md-2 d-flex justify-content-end">
                    <?php echo $this->Form->submit('Apply Filter', ['class' => 'btn btn-primary w-100']); ?>
                </div>

                <?php echo $this->Form->end(); ?>

                <!-- Clear Filter Button -->
                <div class="text-end mb-3">
                    <?php echo $this->Html->link('Clear Filter', ['action' => 'clearFilter'], ['class' => 'btn btn-secondary btn-sm']); ?>
                </div>

                <!-- Table -->
                <div class="table-responsive animate__animated animate__zoomIn">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Branch</th>
                                <th>Year</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($students)) : ?>
                                <?php foreach ($students as $index => $student): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo h($student['Student']['name']); ?></td>
                                        <td><?php echo h($student['Branch']['name']); ?></td>
                                        <td><?php echo h($student['Year']['name']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($student['Student']['created'])); ?></td>
                                        <td>
                                            <?= $this->Html->link('Edit', ['action' => 'edit', $student['Student']['id']], ['class' => 'btn btn-warning btn-sm']); ?>
                                            <?= $this->Form->postLink(
                                                'Delete',
                                                ['action' => 'delete', $student['Student']['id']],
                                                ['class' => 'btn btn-danger btn-sm', 'confirm' => 'Are you sure you want to delete this student?']
                                            ); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No students found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    <?php echo $this->Paginator->prev('«', ['class' => 'btn btn-outline-secondary btn-sm me-2'], null, ['class' => 'd-none']); ?>
                    <?php echo $this->Paginator->numbers(['class' => 'pagination pagination-sm']); ?>
                    <?php echo $this->Paginator->next('»', ['class' => 'btn btn-outline-secondary btn-sm ms-2'], null, ['class' => 'd-none']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
