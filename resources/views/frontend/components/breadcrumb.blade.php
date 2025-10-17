  {{-- À placer où tu veux dans tes vues, par exemple juste avant @yield('content') --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-white rounded shadow-sm px-3 py-2 align-items-center">
            <li class="breadcrumb-item">
                <a href="{{ url()->previous() }}" class="text-dark text-decoration-none"><i class="bi bi-arrow-left"></i> Retour</a>
            </li>
            <li class="breadcrumb-item active fw-bold text-lowercase" aria-current="page">
                {{ Str::lower(trim($__env->yieldContent('title'))) }}
            </li>
        </ol>
    </nav>