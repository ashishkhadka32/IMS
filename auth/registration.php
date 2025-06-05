<?php
session_start();
include '../views/components/header.php';
include_once '../views/partials/alert.php';
?>
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <form action="../index.php?action=auth/registration" method="post" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Registration</h1>
        <div class="border p-2 w-full">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="w-full border p-2 rounded" required>
        </div>
        <div class="border p-2 w-full">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="w-full border p-2 rounded" required>
        </div>
        <div class="border p-2 w-full">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="w-full border p-2 rounded" required>
        </div>
        <div class="col-span-2 text-center mt-4 mx-auto">
            <button class="bg-blue-500 text-white px-4 py-2 rounded mb-2" name="register">Register</button><br>
            <span>Already have an account? <a href="login.php" class="text-blue-500">Login</a></span>
            <p class="text-red-700 px-4 py-2 rounded mb-4 text-center">
                <?= isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; unset($_SESSION['msg']); ?>
            </p>
        </div>
    </form>
</div>

<?php
include '../views/components/footer.php';
?>
