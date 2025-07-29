<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg animate__animated animate__slideInDown">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Edit Student</h4>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create('Student', ['class' => 'needs-validation', 'novalidate' => true]); ?>

                <div class="mb-3">
                    <?php echo $this->Form->input('name', [
                        'label' => 'Full Name',
                        'div' => false,
                        'class' => 'form-control',
                        'required' => true
                    ]); ?>
                </div>

                <div class="mb-3">
                    <?php echo $this->Form->input('branch_id', [
                        'label' => 'Branch',
                        'type' => 'select',
                        'options' => $branches,
                        'empty' => 'Select Branch',
                        'div' => false,
                        'class' => 'form-select',
                        'required' => true
                    ]); ?>
                </div>

                <div class="mb-3">
                    <?php echo $this->Form->input('year_id', [
                        'label' => 'Academic Year',
                        'type' => 'select',
                        'options' => $years,
                        'empty' => 'Select Year',
                        'div' => false,
                        'class' => 'form-select',
                        'required' => true
                    ]); ?>
                </div>

                <div class="text-end">
                    <?php echo $this->Form->end(['label' => 'Update Student', 'class' => 'btn btn-success']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
