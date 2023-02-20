<h1><?= e($params['country']->getName()) ?></h1>


<?php foreach ($params['country']->getMissions() as $mission): ?>
    <div class="card mb-3">
        <div class="card-body">
            <a href="/the_shadow_spies/missions/<?= $mission->getId() ?>"><?= $mission->title ?></a>
        </div>
    </div>
<?php endforeach; ?>

<p class="mt-3"><a href="/the_shadow_spies/missions" class="btn btn-secondary">Retourner aux missions</a></p>
