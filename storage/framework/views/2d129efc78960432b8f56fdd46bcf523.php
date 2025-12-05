<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title><?php echo e($title); ?></title>
    <style>
        .stars{
          position: relative;
          max-width: 100%;
          display: flex;
          flex-direction: row;
          justify-content: center;
        }
        .stars .star {
          flex: 1 1 auto;
          width: 100px;
        }
        .stars .star::before {
          content: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="100%" fill="gold" title="star"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" /></svg>');
        }

        .stars .cover {
          content: '';
          background: white;
          height: 100%;
          overflow: hidden;
          mix-blend-mode: color;
          position: absolute;
          top: 0;
          right: 0;
        }

        #range1 {
          -webkit-appearance: none;
          direction: rtl;
          appearance: none;
          background: transparent;
          width: 100%;
          cursor: pointer;
          outline: none;
          overflow: hidden;
        }
        #range1::-webkit-slider-thumb {
          -webkit-appearance: none;
          appearance: none;
          height: 0;
          width: 0;
          box-shadow: 99999px 0 0 99999px white;
        }
        #range1::-moz-range-thumb {
          height: 0;
          width: 0;
          box-shadow: 99999px 0 0 99999px white;
        }
        #range1::-ms-thumb {
          height: 0;
          width: 0;
          box-shadow: 99999px 0 0 99999px white;
        }
    </style>
</head>
<body>
  <?php if(Auth::guard('etudiants')->user()): ?>
    <?php echo $__env->make('partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php endif; ?>

    <main class="w-100 container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="w-100 container text-center mt-5 d-flex flex-column justify-content-center align-items-center border-2 rounded-3 shadow-lg p-5">
            <div class="row my-3">
                <?php echo $__env->make('partials.flashbag', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <?php echo e($slot); ?>

        </div>
    </main>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH C:\Users\saade\OneDrive\Desktop\Dev\Stage\Stage\resources\views/components/masterpage.blade.php ENDPATH**/ ?>