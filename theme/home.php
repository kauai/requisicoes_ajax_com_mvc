<?php $v->layout("_theme", ["title" => "Usuários"]); ?>

<div class="create">
    <div class="form_ajax" style="display: none"></div>
    <?php // dump( $router->route('form.create')); ?>
    <form class="form" name="gallery" action="<?= $router->route('form.create')?>" method="post"
          enctype="multipart/form-data">
        <label>
            <input type="text" name="first_name" placeholder="Nome:"/>
        </label>
        <label>
            <input type="text" name="last_name" placeholder="Sobrenome:"/>
        </label>
        <label>
            <input type="email" name="email" placeholder="Email:"/>
        </label>
        <button>Cadastrar Usuário</button>
    </form>
</div>

<section class="users">
    <?php 
        if(!empty($users)):
        foreach($users as $item): 
          $v->insert("user",["user" => $item]);
       endforeach; 
      endif;
    ?>
</section>

<?php $v->start('js')?>
   <script src="<?= url('/theme/assets/js/script.js') ?>"></script>
<?php $v->end()?>
