<h1><?= e($params['mission']->getTitle()) ?></h1>


<div>
    <?php foreach ($params['mission']->getCountries() as $country): ?>
        <p><span class="badge bg-info"><?= $country->name ?></span></p>
    <?php endforeach; ?>
</div>
<p><small>Début de la mission le <?= $params['mission']->getCreatedAt()->format('d/m/Y H:i') ?></small></p>
<p><?= nl2br(e($params['mission']->getDescription())) ?></p>
<h3><?= e($params['mission']->getNickname()) ?></h3>
<small>Fin de la mission prévu le <?= $params['mission']->getClosedAt()->format('d/m/Y H:i') ?></small>
<p class="mt-3"><a href="/the_shadow_spies/missions" class="btn btn-secondary">Retourner aux missions</a></p>