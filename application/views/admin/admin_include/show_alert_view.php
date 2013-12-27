<div class="row-fluid">
    <?php
    $alertInfo = $this->session->flashdata('info_message');
    if (!empty($alertInfo)) {
        ?>
        <div class="alert alert-info"><strong><?php echo $alertInfo; ?></strong></div>		 
    <?php
    }
    ?>
</div> 