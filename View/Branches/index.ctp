<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg animate__animated animate__zoomIn">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Branch List</h4>
                <?php echo $this->Html->link('Add Branch', ['action' => 'add'], ['class' => 'btn btn-light btn-sm']); ?>
            </div>

            <div class="card-body">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($branches)) : ?>
                            <?php foreach ($branches as $index => $branch): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= h($branch['Branch']['name']) ?></td>
                                    <td><?= date('d M Y', strtotime($branch['Branch']['created'])) ?></td>
                                    <td>
                                        <?= $this->Html->link('Edit', ['controller' => 'branches', 'action' => 'edit', $branch['Branch']['id']], ['class' => 'btn btn-warning btn-sm']); ?>
                                        <?php
$studentCount = $branch['Branch']['student_count'];
$confirmMsg = $studentCount > 0
    ? "There are $studentCount students in this branch. Deleting this branch will also delete all associated students. Are you sure you want to proceed?"
    : "Are you sure you want to delete this branch?";
echo $this->Form->postLink(
    'Delete',
    ['controller' => 'branches', 'action' => 'delete', $branch['Branch']['id']],
    ['class' => 'btn btn-danger btn-sm', 'confirm' => $confirmMsg]
);
?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">No branches found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
