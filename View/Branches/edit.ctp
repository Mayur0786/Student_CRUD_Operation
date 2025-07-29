<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg animate__animated animate__fadeInDown">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Edit Branch</h4>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create('Branch'); ?>

                <div class="mb-3">
                    <?php echo $this->Form->input('name', [
                        'label' => 'Branch Name',
                        'div' => false,
                        'class' => 'form-control',
                        'required' => true
                    ]); ?>
                </div>

                <div class="text-end">
                    <?php echo $this->Form->end(['label' => 'Update Branch', 'class' => 'btn btn-info']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
