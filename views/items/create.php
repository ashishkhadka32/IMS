<?php
include_once "views/components/header.php";
include_once "views/partials/alert.php";
?>
<div class="max-w-lg mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
    <h4 class="text-3xl font-bold text-gray-800 mb-6">Create Item</h4>
    <form action="?action=create" method="post" enctype="multipart/form-data" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Name</label>
            <input type="text" name="name" id="name"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="price">Price</label>
            <input type="number" name="price" id="price"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="category">Category</label>
            <select name="category" id="category"
                class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>">
                        <?php echo $category['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Add Image <span class="text-red-500">*</span> </label>
            <input type="file" name="file" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="flex space-x-2">
            <button type="submit" name="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Product</button>
            <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
        </div>
    </form>
</div>

<?php
include_once "views/components/footer.php";
?>