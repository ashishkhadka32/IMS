<?php include_once "views/components/header.php"; ?>
<?php include_once "views/partials/alert.php"; ?>

<div class="max-w-lg mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
    <h4 class="text-3xl font-bold text-gray-800 mb-6">Edit Category</h4>
    <form action="?action=categoryUpdate&id=<?php echo htmlspecialchars($category['id']); ?>" method="post">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($category['name']); ?>"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <div>
            <button type="submit"
                class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-200">
                Update
            </button>
        </div>
    </form>
</div>