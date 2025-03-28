<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="/katalog/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="form-container" style="max-width: 400px;">
            <h1 class="text-center">Admin Login</h1>

            <?php if (isset($error)): ?>
                <div class="error-message" style="color: var(--danger); padding: var(--space-sm); 
                     background-color: #ffebee; border-radius: var(--rounded); margin-bottom: var(--space-md); 
                     text-align: center;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/katalog/login-action" class="mt-4">
                <div class="form-group">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>