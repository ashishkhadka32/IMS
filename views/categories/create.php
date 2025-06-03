<?php
include_once "views/components/header.php";
include_once "views/partials/alert.php";
?>
<div class="max-w-lg mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
    <h4 class="text-3xl font-bold text-gray-800 mb-6">Create Category</h4>
    <form method="POST" action="?action=categoryCreate">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Name</label>
            <input type="text" name="name" id="name"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>
        <div class="flex space-x-2 mt-4">
            <button type="submit" name="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Category</button>
            <a href="?action=categoryIndex" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
        </div>
    </form>
</div>
<?php
include_once "views/components/footer.php";
?>