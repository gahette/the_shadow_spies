<h1>Administration des missions</h1>

<?php if (isset($_GET['success'])): ?>
<div class="alert alert-success">Vous êtes connecté !</div>
<?php endif; ?>

<a href="/the_shadow_spies/admin/missions/create" class="btn btn-success my-3">Créer une nouvelle mission</a>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">titre</th>
        <th scope="col">description</th>
        <th scope="col">nom de code</th>
        <th scope="col">publié le</th>
        <th scope="col">fin prévu le</th>
        <th scope="col">Pays</th>
        <th scope="col">Actions</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($params['missions'] as $mission): ?>
        <tr>
            <th scope="row"><?= $mission->getId() ?></th>
            <td><?= e($mission->getTitle()) ?></td>
            <td><?= $mission->getExcerpt() ?></td>
            <td><?= e($mission->getNickname()) ?></td>
            <td><?= $mission->getCreatedAt()->format('d/m/Y H:i') ?></td>
            <td><?= $mission->getClosedAt()->format('d/m/Y H:i') ?></td>
            <td>
                <?php foreach ($mission->getCountries() as $k => $country):
                    if ($k > 0):
                        echo ', ';
                    endif;
                    ?>
                    <?= ucfirst(strtolower(e($country->name))) ?>
                <?php endforeach; ?>
            </td>

            <td>
                <a href="/the_shadow_spies/admin/missions/edit/<?= $mission->getId() ?>" class="btn btn-warning">Modifier</a>
                <form action="/the_shadow_spies/admin/missions/delete/<?= $mission->getId() ?>" method="post"
                      class="d-inline">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
