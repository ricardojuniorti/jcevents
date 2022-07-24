<?php

use Illuminate\Support\Facades\DB;

?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
    
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title><?php echo $__env->yieldContent('title'); ?></title>

      <!-- Fonte do Google -->
      <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

      <!-- CSS Bootstrap -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
      <!-- CSS Slider -->
      <link rel="stylesheet" href="/css/slider.css">
       
      <!-- CSS ICONS --> 
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
      
      <!-- CSS da aplicação -->
      <link rel="stylesheet" href="/css/styles.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.2/chosen.css" rel="stylesheet"/>
      
      <script src="/js/scripts.js"></script>
      
      <!-- jquery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.2/chosen.jquery.min.js"></script>

      <!-- API Chart - documentacao: https://developers-dot-devsite-v2-prod.appspot.com/chart/interactive/docs/gallery/map -->
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
      
    </head>
    <body>
      <header>
        <!-- Menu principal -->
        <div class="menu">
          <ul class="menu-list">
            <li id="logo"><a href="/"><img src="/img/jcevents.png" alt=""></a></li>
            <li class="sublinhado"><a href="/" >Principal</a></li>
            <?php if(auth()->guard()->check()): ?>
            <li class="sublinhado"><a href="#">Eventos</a>
              <ul class="sub-menu">
              <?php if(auth()->user()->user_profile_id != 1): ?>
                <li class="sublinhado"><a href="/event/createEvent">Novo Evento</a></li>
                <li class="sublinhado"><a href="/dashboard">Meus Eventos</a></li>
              <?php endif; ?>
                <li class="sublinhado"><a href="/event/myEvent">Eventos que participo</a></li>
              </ul>
            </li>
            <li class="sublinhado"><a href="#">Cursos</a>
              <ul class="sub-menu">
              <?php if(auth()->user()->user_profile_id != 1): ?>
                <li class="sublinhado"><a href="/course/createCourse">Novo Curso</a></li>
                <li class="sublinhado"><a href="/course/show">Meus Cursos</a></li>
              <?php endif; ?>
                <li class="sublinhado"><a href="/mycourses">Cursos que participo</a></li>
              </ul>
            </li>
            <li class="sublinhado"><a href="#">Conta</a>
              <ul class="sub-menu">
                <li class="sublinhado"><a href="/user/profile"><i class="bi bi-person">Configurações da conta</i></a></li>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(auth()->guard()->guest()): ?>
            <li class="cadastros"><a href="/login">Entrar</a>
            </li>
            <li class="cadastros"><a href="/register">Cadastrar</a>
            </li>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->user_profile_id == 3): ?>
              <li class="sublinhado"><a href="#">Relatórios</a>
                <ul class="sub-menu">
                  <li class="sublinhado"><a href="/report/eventTime">Painel de relatórios</a></li>     
                </ul>
              </li>
              <li class="sublinhado"><a href="#">Administração</a>
                <ul class="sub-menu">             
                  <li class="sublinhado"><a href="/eventCategory/show"><i class="bi bi-gear">Gerenciar Categorias</i></a></li>
                  <li class="sublinhado"><a href="/user/show"><i class="bi bi-gear">Gerenciar usuários</i></a></li>
                  <li class="sublinhado"><a href="/userProfile/show"><i class="bi bi-gear">Gerenciar Perfis de usuários</i></a></li>
                  <li class="sublinhado"><a href="/itemEvent/show"><i class="bi bi-gear">Itens de eventos</i></a></li>
                </ul>
              </li>
            <?php endif; ?>
            <br>
            <li class="sublinhado" id="autenticado">
              <form action="/logout" method="POST">
              <?php echo csrf_field(); ?>
                  
              <p><?php  
                  if(auth()->user()->name){

                    $idPerfil = auth()->user()->user_profile_id;
                    $nome = auth()->user()->name;
                    $registro = DB::select('SELECT * FROM user_profile where id = ' . $idPerfil );

                ?> 
                    <i class="bi bi-person-circle"><b><?php echo e($nome); ?></b></i>
              <?php
                  }
                  ?>
              </p>
                 <a href="/logout" class="nav-link" onclick="event.preventDefault();this.closest('form').submit();"><h6><?php echo e($registro[0]->description); ?>  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;  <i class="bi bi-box-arrow-right">Sair</h6></i></a>
              </form>  
            </li>
            <?php endif; ?>
          </ul>
        </div>

        <!------------------------------------ Menu Mobile ----------------------------------------------------------->

        <nav id="nav"> 
          <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
            <span id="hamburger"></span>
          </button>
          <ul id="menu" role="menu">
          <li><a href="/"><i class="bi bi-house-door-fill"></i></a>
            <?php if(auth()->guard()->check()): ?>
            <li><a href="#"><b>Eventos</b></a>
              <ul class="sub-menu">
              <?php if(auth()->user()->user_profile_id != 1): ?>
                <li><a href="/event/createEvent">Novo Evento</a></li>
                <li><a href="/dashboard">Meus Eventos</a></li>
                <li><a href="/event/myEvent">Eventos que participo</a></li>
              <?php endif; ?>
              </ul>
            </li>
            <br> 
            <li><a href="#"><b>Cursos</b></a>
              <ul class="sub-menu">
              <?php if(auth()->user()->user_profile_id != 1): ?>
                <li><a href="/course/createCourse">Novo Curso</a></li>
                <li><a href="/course/show">Meus Cursos</a></li>
              <?php endif; ?>
                <li><a href="/mycourses">Cursos que participo</a></li>
              </ul>
            </li>
            <br>
            <li><a href="#"><b>Conta</b></a>
              <ul class="sub-menu">
                <li><a href="/user/profile">Configurações da conta</a></li>
              </ul>
            </li>
            <br>
            <?php endif; ?>
            <?php if(auth()->guard()->guest()): ?>
            <li><a href="/login"><b>Entrar</b></a>
            </li>
            <li><a href="/register"><b>Cadastrar</b></a>
            </li>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->user_profile_id ==3): ?>
              <li class="sublinhado"><a href="#"><b>Relatórios</b></a>
                <ul class="sub-menu">
                  <li class="sublinhado"><a href="/report/eventTime">Painel de relatórios</a></li>
                </ul>
              </li>           
              <br>  
              <li class="sublinhado"><a href="#"><b>Administração</b></a>
                <ul class="sub-menu">
                  <li class="sublinhado"><a href="/eventCategory/show">Gerenciar Categorias</a></li>
                  <li class="sublinhado"><a href="/user/show">Gerenciar Usuários</a></li>
                  <li class="sublinhado"><a href="/userProfile/show">Gerenciar Perfis de Usuários</a></li>
                  <li class="sublinhado"><a href="/itemEvent/show">Itens de eventos</a></li>
                </ul>
              </li>
            <?php endif; ?>
            <li>
              <form action="/logout" method="POST">
                <?php echo csrf_field(); ?>
                <a href="/logout" class="nav-link" onclick="event.preventDefault();this.closest('form').submit();"><b>Sair</b></a>
              </form>
            </li>
            <?php endif; ?>
          </ul>
        </nav>
      </header>
      <script src="/js/menu_mobile.js"></script>
      <main>
        <div class="container-fluid">
          <div class="row">
            <?php echo $__env->yieldContent('content'); ?>
          </div>
        </div>
      </main>
      <footer>
        <p><a href="/"><i class="bi bi-house-door-fill"></i></a>  JC Events &copy; 2022</p>
      </footer>
      <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    </body>
</html>

<?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/layouts/main.blade.php ENDPATH**/ ?>