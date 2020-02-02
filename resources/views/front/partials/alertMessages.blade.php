<?php
    $messages = [
        'successMessage' => 'success',
        'errorMessage' => 'danger',
        'infoMessage' => 'info'
    ];

    foreach ($messages as $key => $value) {

        if (Session::has($key)) {
            echo '<div class="alert alert-' . $value . ' top-margin">' . Session::get($key) . '</div>';
        }

    }
?>
