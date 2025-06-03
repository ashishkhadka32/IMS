<?php
include_once "views/components/header.php";
include_once "views/partials/alert.php";
?>
<div class="max-w-4xl mx-auto mt-8">
    <h4 class="text-xl font-bold mb-4">Inventory Categories List</h4>
    <a href="?action=categoryCreate" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Add New Category</a>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2">SN</th>
                <th class="border border-gray-300 p-2">Name</th>
                <th class="border border-gray-300 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)): ?>
                <?php
                $count = 1;
                foreach ($categories as $category): ?>
                    <tr>
                        <td class="border border-gray-300 p-2"><?php echo $count++; ?></td>
                        <td class="border border-gray-300 p-2"><?php echo htmlspecialchars($category['name']); ?></td>
                        <td class="border border-gray-300 p-2">
                            <a href="?action=categoryUpdate&id=<?php echo htmlspecialchars($category['id']); ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <a href="?action=categoryDelete&id=<?php echo htmlspecialchars($category['id']); ?>" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="border border-gray-300 p-2 text-center">No categories found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php
include_once "views/components/footer.php";
?>