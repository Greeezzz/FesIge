<div>
    <div class="container mx-auto p-4">
        <div class="flex flex-col md:flex-row md:space-x-4">
            <!-- Sidebar Section -->
            <div class="w-full md:w-1/3 mb-4 md:mb-0">
                <div class="bg-white shadow-md p-6 rounded-lg">
                    <h1 class="text-2xl font-semibold"><?php echo e(Auth()->user()->name); ?></h1>
                    <hr class="my-4">
                    <button class="bg-gradient-to-r from-purple-400 to-purple-600 text-white px-4 py-2 rounded w-full" wire:click='batal'>Status saya</button>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $semuamemberkecualisaya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button class="mt-2 w-full px-4 py-2 rounded <?php echo e($member->id == $memberterpilih ? 'bg-gradient-to-r from-purple-400 to-purple-600 text-white' : 'border border-purple-500 text-purple-500'); ?>" wire:click='pilihMember(<?php echo e($member->id); ?>)'>
                            <?php echo e($member->name); ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>

            <!-- Main Content Section -->
            <div class="w-full md:w-2/3">
                <!--[if BLOCK]><![endif]--><?php if($ceritabaru): ?>
                    <button class="bg-gradient-to-r from-purple-400 to-purple-600 text-white px-4 py-2 rounded mb-4 w-full" wire:click='batal'>Batal</button>
                <?php else: ?>
                    <button class="bg-gradient-to-r from-purple-400 to-purple-600 text-white px-4 py-2 rounded mb-4 w-full" wire:click='buatCeritaBaru'>Tambah Story</button>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <i class="fas fa-sync fa-spin" wire:loading></i>

                <!--[if BLOCK]><![endif]--><?php if($ceritabaru): ?>
                    <div class="bg-white shadow-md p-6 rounded-lg mb-6">
                        <h2 class="font-bold text-xl mb-4">Buat Cerita Baru</h2>
                        <form wire:submit='simpanCerita'>
                            <div class="mb-4">
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                                <input type="text" class="form-input mt-1 block w-full border border-gray-300 rounded" id="judul" wire:model='judul'>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                                    <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="mb-4">
                                <label for="cerita" class="block text-sm font-medium text-gray-700">Cerita</label>
                                <textarea class="form-textarea mt-1 block w-full border border-gray-300 rounded" id="cerita" wire:model='cerita'></textarea>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['cerita'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                                    <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="mb-4">
                                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                                <input type="file" class="form-input mt-1 block w-full border border-gray-300 rounded" id="gambar" wire:model='gambar'>
                            </div>
                            <button type="submit" class="bg-gradient-to-r from-purple-400 to-purple-600 text-white px-4 py-2 rounded">Simpan</button>
                        </form>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!-- Story List -->
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $semuacerita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white shadow-lg rounded-lg mb-6 p-6">
                        <h3 class="font-bold text-xl mb-2"><?php echo e($c->judul); ?></h3>
                        <div class="mb-4">
                            <img src="<?php echo e(asset('storage/gambar/' . $c->foto)); ?>" alt="gmbr" class="w-full h-auto max-h-80 object-contain rounded-lg">
                        </div>
                        <p class="text-gray-700 leading-relaxed truncate"><?php echo e($c->isi); ?></p>
                        <hr class="my-4">
                        <div class="flex items-center space-x-2">
                            <input type="text" class="form-input w-full border border-gray-300 rounded" placeholder="Komentar Anda" wire:model='komentar' wire:keydown.enter="simpanKomentar(<?php echo e($c->id); ?>)">
                            <button class="bg-gradient-to-r from-purple-400 to-purple-600 text-white px-4 py-2 rounded" wire:click='simpanKomentar(<?php echo e($c->id); ?>)'>Kirim</button>
                        </div>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['komentar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="mt-4 space-y-2">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $c->komentars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div><b><?php echo e($k->user->name); ?></b>: <?php echo e($k->isi); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\sosmedchelodewi1\resources\views/livewire/story.blade.php ENDPATH**/ ?>