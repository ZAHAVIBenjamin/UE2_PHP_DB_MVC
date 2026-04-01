<?php include_once 'head.php'; ?>
<body>
    <?php include_once 'header.php'; ?>
    <main>
        <?php include_once 'menuGauche.php'; ?>
        
        <div id="content-container">
            <?php if (isset($_SESSION['flash'])): ?>
                <div class="alert alert-success" style="color: green; border: 1px solid green; padding: 10px; margin: 10px;">
                    <?= $_SESSION['flash']; ?>
                </div>
                <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger" style="color: red; border: 1px solid red; padding: 10px; margin: 10px;">
                    <?= $_SESSION['flash_error']; ?>
                </div>
                <?php unset($_SESSION['flash_error']); ?>
            <?php endif; ?>

            <?= $content ?>
        </div>
    </main>
    <?php include_once 'footer.php'; ?>
</body>
</html>