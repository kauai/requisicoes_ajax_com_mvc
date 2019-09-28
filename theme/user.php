<article class="users_user">
    <h3><?= $user->first_name . ' ' . $user->last_name?></h3>
    <a href="#" class="remove" data-id="<?= $user->id ?>" data-action="<?= $router->route("form.delete") ?>">Deletar</a>
</article>