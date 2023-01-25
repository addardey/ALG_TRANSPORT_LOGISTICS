<?php
if (isset($this->js)) {
    foreach ($this->js as $js) {
        echo '<script src="' . URL . $js . '"></script>';
    }
}
?>
</body>
</html>