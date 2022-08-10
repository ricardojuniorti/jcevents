<?php $__env->startSection('title', 'JC Events'); ?>

<?php $__env->startSection('content'); ?>

<div id="search-container" class="col-md-12">
  <?php if(!isset($_GET['search'])): ?>
    <h2>Em destaque</h2>
    <div data-slide="slide" class="slide">
      <div class="slide-items">
      <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($course->spotlight != null): ?>
          <img src="/img/events/<?php echo e($course->image); ?>" width="500" height="400" alt="Img 1">
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <nav class="slide-nav">
        <div class="slide-thumb"></div>
        <button class="slide-prev">Anterior</button>
        <button class="slide-next">Próximo</button>
      </nav>
    </div>
  <?php endif; ?>
  <?php if(isset($_GET['search'])): ?>
    <br><br>
  <?php endif; ?>
    <form action="/courses" method="GET" enctype="multipart/form-data">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
        </div>
        <input type="text" id="search" name="search" class="form-control" placeholder="Pressione enter para pesquisar cursos ... ">     
      </div>     
      <div>
        <label for="">Filtrar por:</label>
        <select class="form-select" aria-label="Default select example" onchange="direcionaParaEventos();">
          <option value="1" >Eventos</option>
          <option value="2" selected>Cursos</option>
        </select>
      </div>
    </form>
</div>

<div id="events-container" class="col-md-12">
    <?php if($search): ?>
    <h2>Aproximadamente: <?php echo e(count($courses)); ?> resultado(s) para: <?php echo e($search); ?></h2>
    <?php else: ?>
    <h2>Próximos Cursos</h2>
    <p class="subtitle">Veja os cursos atuais</p>
    <?php endif; ?>
    <div id="cards-container" class="row">
        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($course->active == true): ?>
          <div class="card col-md-3">
              <img src="/img/events/<?php echo e($course->image); ?>" alt="<?php echo e($course->title); ?>">
              <div class="card-body">
                  <p class="card-date">Carga horária: <?php echo e($course->duration); ?></p>
                  <h5 class="card-title"><?php echo e($course->title); ?></h5>
                  <p class="card-participants"><?php echo e(count($course->users)); ?> Participantes</p>
                  <a href="/course/<?php echo e($course->id); ?>" class="btn btn-primary">Saiba mais</a>
              </div>
          </div>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($courses) == 0 && $search): ?>
            <p>Não foi possível encontrar nenhum curso <?php echo e($search); ?>! <a href="/courses">Ver todos</a></p>
        <?php elseif(count($courses) == 0): ?>
            <p>Não cursos disponíveis</p>
        <?php endif; ?>
    </div>
</div>
<script>

class SlideStories {
  constructor(id) {
    this.slide = document.querySelector(`[data-slide="${id}"]`);
    this.active = 0;
    this.init();
  }

  activeSlide(index) {
    this.active = index;
    this.items.forEach((item) => item.classList.remove('active'));
    this.items[index].classList.add('active');
    this.thumbItems.forEach((item) => item.classList.remove('active'));
    this.thumbItems[index].classList.add('active');
    this.autoSlide();
  }

  prev() {
    if (this.active > 0) {
      this.activeSlide(this.active - 1);
    } else {
      this.activeSlide(this.items.length - 1);
    }
  }

  next() {
    if (this.active < this.items.length - 1) {
      this.activeSlide(this.active + 1);
    } else {
      this.activeSlide(0);
    }
  }

  addNavigation() {
    const nextBtn = this.slide.querySelector('.slide-next');
    const prevBtn = this.slide.querySelector('.slide-prev');
    nextBtn.addEventListener('click', this.next);
    prevBtn.addEventListener('click', this.prev);
  }

  addThumbItems() {
    this.items.forEach(() => (this.thumb.innerHTML += `<span></span>`));
    this.thumbItems = Array.from(this.thumb.children);
  }

  autoSlide() {
    clearTimeout(this.timeout);
    this.timeout = setTimeout(this.next, 5000);
  }

  init() {
    this.next = this.next.bind(this);
    this.prev = this.prev.bind(this);
    this.items = this.slide.querySelectorAll('.slide-items > *');
    this.thumb = this.slide.querySelector('.slide-thumb');
    this.addThumbItems();
    this.activeSlide(0);
    this.addNavigation();
  }
}

new SlideStories('slide');


function direcionaParaEventos() {
  window.location.href = '/';
}


</script>
<div class="paginacao">
    <?php if(!$search): ?>
        <?php echo e($courses->links()); ?>

    <?php endif; ?>
</div>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/course/welcome.blade.php ENDPATH**/ ?>