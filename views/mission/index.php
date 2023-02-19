<h1>Les Missions</h1>


<div class="row">
    <?php

    foreach ($params['missions'] as $mission): ?>

        <div class="col-md-4">
            <div class="card mb-3">
                <!--                <img src="..." class="card-img-top" alt="...">-->
                <div class="card-body">
                    <h4 class="card-title">Mission : <br><?= e($mission->getTitle()) ?></h4>
                    <div>
                        <?php foreach ($mission->getCountries() as $country): ?>
                            <p><span class="badge bg-info"><?= $country->name ?></span></p>
                        <?php endforeach; ?>
                    </div>
                    <p class="badge bg-info"><small>Créé le <?= $mission->getCreatedAt()->format('d/m/Y h:m') ?></small>
                    </p>
                    <p class="card-text">Extrait : <br><?= $mission->getExcerpt() ?></p>
                    <h5>Nom de code : <br><?= e($mission->getNickname()) ?></h5>
                    <div class="card-footer">
                        <p class="text-muted"><small>Cloturé
                                le <?= $mission->getClosedAt()->format('d/m/Y h:m') ?></small>
                        </p>
                    </div>

                    <p>
                        <a href="/the_shadow_spies/missions/<?= $mission->getId() ?>"
                           class="btn btn-primary">Lire plus</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
