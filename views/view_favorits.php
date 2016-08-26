
<div class="my-flex-container">
	
	<? foreach ($recipes as $recipe) {?>
		<div class="my-flex-block">
			<div class="my-flex-block-padding">
				<div class="my-flex-block-content">
					<img class="card-img"src="img/cardwork/<?= $recipe->getId() ?>.jpg">
					<a href="/work<?= $recipe->getId()?>">
						<div class="block-content">
							<?= $recipe->getName() ?>
						</div>
						<div class="block-content-time">
							<i class="fa fa-clock-o" > <?= $recipe->getTime() ?></i>
						</div>
							<div class="block-content-favorits">
								<i class="fa fa-star-o" ><?= $recipe->getCountFavorits() ?></i>
							</div>

					</a>
					<div class="block-buttons">
						<div>
							<a href="/profile<?= $recipe->getUserId() ?>">
								<div><?= $recipe->getName() ?></div>
							</a>
						</div>
						<div class="favorits block-button button-favorits" data-id="<?= $recipe->getId() ?> " >
							<div  class="block-button-in<?= $recipe->isLiked($user->getId()) ? '-check' : '-home' ?>"></div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	<? } ?>
	
	



</div>

<div class="user-background"></div>