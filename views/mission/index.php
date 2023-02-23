<?php $title = "missions"; ?>

<h1>Les Missions</h1>


<div class="row">
    <?php foreach ($params['missions'] as $mission): ?>

        <div class="col-md-4">
            <div class="card mb-3">
                <!--                <img src="..." class="card-img-top" alt="...">-->
                <div class="card-body">
                    <h4 class="card-title">Mission : <br><?= e($mission->getTitle()) ?></h4>
                    <div>
                        <?php foreach ($mission->getCountries() as $country): ?>
                            <p><span class="badge bg-success">
                                    <a href="/the_shadow_spies/countries/<?= $country->getId() ?>"
                                       class="text-white"><?= e($country->name) ?></a></span>
                            </p>
                        <?php endforeach; ?>
                    </div>
                    <p class="badge bg-info"><small>Créé le <?= $mission->getCreatedAt()->format('d/m/Y H:i') ?></small>
                    </p>
                    <p class="card-text">Extrait : <br><?= $mission->getExcerpt() ?></p>
                    <h5>Nom de code : <br><?= e($mission->getNickname()) ?></h5>
                    <div class="card-footer">
                        <p class="text-muted"><small>Fin de la mission prévu le
                                le <?= $mission->getClosedAt()->format('d/m/Y H:i') ?></small>
                        </p>
                    </div>

                    <p>
                        <a href="/the_shadow_spies/missions/<?= $mission->getId() ?>"
                           class="btn btn-primary">Voir détails</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
