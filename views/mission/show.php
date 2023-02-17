<h1><?= e($params['mission']->getTitle()) ?></h1>
<p><small><?= $params['mission']->getCreatedAt()->format('d/m/Y h:m:i') ?></small></p>
<p><?= nl2br(e($params['mission']->getDescription())) ?></p>
<h3><?= e($params['mission']->getNickname()) ?></h3>
<small><?= $params['mission']->getClosedAt()->format('d/m/Y h:m:i') ?></small>
<p class="mt-3"><a href="/the_shadow_spies/missions" class="btn btn-secondary">Retourner en arrière</a></p>