<?php



function warning_e($message) {
    echo <<<EOH
    <div class="alert alert-warning" role="alert">
        $message
    </div>
EOH;
    return null;
}

