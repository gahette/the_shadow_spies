<h1>Les Missions</h1>

<?php

foreach ($params['missions'] as $mission): ?>
<div class="card mb-3">
    <div class="card-body">
        <h2><?= $mission->title ?></h2>
        <small><?= $mission->created_at ?></small>
        <p><?= $mission->description ?></p>
        <h3><?= $mission->nickname ?></h3>
        <small><?= $mission->closed_at ?></small>
        <p class="mt-3"><a href="/the_shadow_spies/missions/<?= $mission->id ?>" class="btn btn-primary">Lire plus</a></p>
    </div>
</div>

<?php endforeach; ?>
