<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg animate__animated animate__fadeInDown">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Academic Year</h4>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create('Year'); ?>

                <div class="mb-3">
                    <?php echo $this->Form->input('name', [
                        'label' => 'Year Name (e.g., First Year)',
                        'div' => false,
                        'class' => 'form-control',
                        'required' => true,
                        'placeholder' => 'First Year'
                    ]); ?>
                </div>

                <div class="text-end">
                    <?php echo $this->Form->end([
                        'label' => 'Update Year',
                        'class' => 'btn btn-success'
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
