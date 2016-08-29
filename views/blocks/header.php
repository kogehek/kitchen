<div class="flex-container-menu">
	<? if ($user->isLogged()) { ?>
		<a href="/" class="menu-flex">Kitchen</a>
		<a href="/favorits" class="menu-flex">Favorits</a>
		<a href="/profile<?= $user->getId() ?>" class="menu-flex block-last" >
		<i class="fa fa-user"></i> <?= $user->getName() ?>
	</a>
	<form action="/action" method="post">

		<input type="hidden" name="action" value="logout">
		<button type="submit" class="menu-flex block-last b-btn" value="logout"><i class="fa fa-sign-out"></i> Logout</button>
	</form>

	<? } else { ?> 
		<a href="/registration" class="menu-flex block-last" ><i class="fa fa-user"></i> Registration</a>
	<? } ?>
</div>