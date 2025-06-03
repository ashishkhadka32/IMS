<?php if (isset($_SESSION['alert'])): ?>
    <div id="alert-box" class="<?php echo $_SESSION['alert']['type'] === 'success' ? 'bg-green-100 border-green-500 text-green-700' : 'bg-red-100 border-red-500 text-red-700'; ?> border-l-4 p-4 mb-4 relative transition-opacity duration-500" role="alert">
        <p><?php echo htmlspecialchars($_SESSION['alert']['message']); ?></p>
        <button onclick="this.parentElement.remove()" class="absolute top-0 right-0 px-2 py-1 text-sm">×</button>
    </div>

    <script>
        // Hide the alert after 3 seconds
        setTimeout(function () {
            const alertBox = document.getElementById('alert-box');
            if (alertBox) {
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500); // Wait for fade out to finish
            }
        }, 3000);
    </script>
<?php endif; ?>
