<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg animate__animated animate__zoomIn">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Year List</h4>
                <?php echo $this->Html->link('Add Year', ['action' => 'add'], ['class' => 'btn btn-light btn-sm']); ?>
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
                        <?php if (!empty($years)) : ?>
                            <?php foreach ($years as $index => $year): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= h($year['Year']['name']) ?></td>
                                    <td><?= date('d M Y', strtotime($year['Year']['created'])) ?></td>
                                    <td>
                                        <?= $this->Html->link('Edit', ['controller' => 'years', 'action' => 'edit', $year['Year']['id']], ['class' => 'btn btn-warning btn-sm']); ?>
                                        <?php
$studentCount = $year['Year']['student_count'];
$confirmMsg = $studentCount > 0
    ? "There are $studentCount students in this year. Deleting this year will also delete all associated students. Are you sure you want to proceed?"
    : "Are you sure you want to delete this year?";
echo $this->Form->postLink(
    'Delete',
    ['controller' => 'years', 'action' => 'delete', $year['Year']['id']],
    ['class' => 'btn btn-danger btn-sm', 'confirm' => $confirmMsg]
);
?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">No years found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
