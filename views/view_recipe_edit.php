<script>
$(function() {
    $('#content').redactor({ 
        imageUpload: '/actions/uploadImg.php'
    });
});
</script>

	<textarea id="content" name="content"><?= $recipe->getRecipe() ?></textarea>

	<button onclick="sendFormEdit(<?= $recipe->getId()?>,<?= $user->getId()?>);">Send</button>