<?php include 'views/components/header.php'; ?>
<nav class="primary-bg p-4 shadow-lg">
    <div class="max-w-6xl mx-auto flex justify-between items-center">

        <a href="index.php" class="text-white text-2xl font-extrabold tracking-wide hover:opacity-90 transition">
            📦 Inventory System
        </a>
    
        <div class="space-x-6">
            <a href="index.php" class="text-white text-lg font-medium hover:text-yellow-300 transition">
                Dashboard
            </a>
            <a href="?action=category/index" class="text-white text-lg font-medium hover:text-yellow-300 transition">
                Categories
            </a>
            <?php if(isset($_SESSION['email'])){

                ?>
                <a href="?action=auth/logout" class="text-white text-lg font-medium hover:text-yellow-300 transition">
                    Logout
                </a>
                <?php
            }
            ?>
           
        </div>
    </div>
</nav>


