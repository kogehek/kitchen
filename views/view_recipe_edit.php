<script>
$(function() {
    $('#content').redactor({ 
        imageUpload: '/action',
        uploadImageFields: {
            action: "img"
        }
    });
});
</script>

	<textarea id="content" name="content"><?= $recipe->getRecipe() ?></textarea>

	<button onclick="sendFormEdit(<?= $recipe->getId()?>,<?= $user->getId()?>);">Send</button>