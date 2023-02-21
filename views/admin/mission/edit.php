<h1>Modifier <?= e($params['mission']->getTitle()) ?></h1>


<form action="/the_shadow_spies/admin/missions/edit/<?= $params['mission']->getId() ?>" method="POST">
    <div class="form-group mb-3">
        <label for="title">Titre de la mission</label>
        <input type="text" class="form-control" name="title" id="title" value="
        <?= e($params['mission']->getTitle()) ?>">
    </div>
    <div class="form-group mb-3">
        <label for="description">Description de la mission</label>
        <textarea name="description" id="description" cols="200" rows="8"
                  class="form-control"><?= e($params['mission']->getDescription()) ?></textarea>
    </div>
    <div class="form-group mb-3">
        <label for="nickname">Nom de code de la mission
            <input type="text" class="form-control" name="nickname" id="nickname" value="
        <?= e($params['mission']->getNickname()) ?>"></label>
    </div>
    <div class="form-group mb-3">
        <label for="created_at" class="me-5">Date de création de la mission
            <input type="datetime-local" class="form-control" name="created_at" id="created_at" value="
        <?= e($params['mission']->getCreatedAt()) ?>"></label>

        <label for="closed_at" class="me-5">Date de fin de la mission
            <input type="datetime-local" class="form-control" name="closed_at" id="closed_at" value="
        <?= e($params['mission']->getClosedAt()) ?>"></label>
    </div>
    <div class="form-group mb-3">
        <label for="countries">Théatre de la mission</label>
        <select class="form-select" multiple aria-label="multiple select example" id="countries" name="countries[]">
            <option selected>Open this select menu</option>
            <?php foreach ($params['countries'] as $country): ?>
                <option value="<?= $country->getId() ?>"
                    <?php foreach ($params['mission']->getCountries() as $missionCountry) {
                        echo ($country->getId() === $missionCountry->getId()) ? 'selected' : '';
                    }
                    ?>
                ><?= $country->getName() ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mb-3">Enregistrer les modifications</button>
</form>