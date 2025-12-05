<nav class="navbar navbar-expand-sm navbar-light bg-light ps-3 pe-3 w-100" style="position: fixed; top: 0; left: 0; right: 0;z-index: 1000;max-height: 50px;">
  <a class="navbar-brand" href="<?php echo e(route('admin.show')); ?>">
    <img class="img h-100" src="<?php echo e(asset('storage/logo.png')); ?>" alt="Logo" style="max-height: 50px; object-fit: cover;">
  </a>
  <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo e(route('admin.show')); ?>">Accueil</a>
      </li>
    </ul>
    <?php if(Auth::guard('admin')->user()): ?>
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" style="margin-right: 80px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo e(Auth::guard('admin')->user()->role); ?>

        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="<?php echo e(route('login.logout')); ?>">Deconnexion</a>
        </div>
      </div>
    <?php endif; ?>
    
  </div>
</nav>
<?php /**PATH C:\Users\lekou\OneDrive\Desktop\Stage\Stage\resources\views/partials/navAdmin.blade.php ENDPATH**/ ?>