<?php

declare(strict_types=1);

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AppearanceController;
use App\Http\Controllers\AvailableSlotController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ScheduleBatchController;
use App\Http\Controllers\TenantTextController;
use App\Http\Controllers\TransbankController;
use App\Http\Controllers\App\ProfileController;
use App\Http\Controllers\App\UserController;
use App\Http\Controllers\Tenant\AppointmentApiController;
use App\Http\Controllers\Tenant\AppointmentController;
use App\Http\Controllers\Tenant\RoleController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    'tenant.enabled',
])->group(function () {
    // Página "Inicio"
    Route::get('/', function () {
        return view(tenantView('index'));
    })->name('tenants.default.index');

    // Página "Servicios"
    Route::get('/services', function () {
        return view(tenantView('services'));
    })->middleware('check.tenant.page.enabled:services');

    // Página "Contacto"
    Route::get('/contact', function () {
        return view(tenantView('contact'));
    })->middleware('check.tenant.page.enabled:contact')->name('tenant.contact');

    // Página "Tips"
    Route::get('/tips', function () {
        return view(tenantView('tips'));
    })->middleware('check.tenant.page.enabled:tips');

    // Página "Nosotros"
    Route::get('/about', function () {
        return view(tenantView('about'));
    })->middleware('check.tenant.page.enabled:about');

    // Página "Chatbot"
    Route::post('/chatbot', [ChatbotController::class, 'chat']);

    // API para mostrar solo horarios no agendados al cliente
    Route::get('/api/client-slots', [AvailableSlotController::class, 'clientSlots']);
    Route::post('/api/apply-batch', [ScheduleBatchController::class, 'applyBatch']);
    Route::get('/api/batch-preview', [ScheduleBatchController::class, 'previewBatch']);

    Route::get('/communes-by-region/{region}', function ($regionId) {
        return \App\Models\Commune::where('region_id', $regionId)
            ->orderBy('name')
            ->get(['id', 'name']);
    })->name('communes.byRegion');

    // Rutas solo para usuarios que han iniciado sesión
    Route::middleware(['auth'])->group(function () {
        // Sistema de Agendamiento
        Route::middleware(['check.tenant.page.enabled:agenda'])->group(function () {
            // Agenda
            Route::get('/agenda', [AgendaController::class, 'index'])->name('tenant.agenda.index');
            Route::post('/agenda', [AgendaController::class, 'store'])->name('tenant.agenda.store');

            // Citas Agendadas
            Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
            Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');

            // Confirmación de Cita
            Route::get('/agenda/confirmar', [AgendaController::class, 'confirm'])->name('tenant.agenda.confirm');

            // Cuestionario Pre-Agendamiento
            Route::middleware(['check.tenant.page.enabled:questionnaire'])->group(function () {
                Route::get('/agenda/questionnaire', [AgendaController::class, 'showQuestionnaire'])->name('tenant.agenda.questionnaire');
                Route::post('/agenda/questionnaire', [AgendaController::class, 'processQuestionnaire'])->name('tenant.agenda.questionnaire.process');
                Route::get('/agenda/questionnaire/thanks', function () {
                    return view('tenants.default.agenda.questionnaire_thanks');
                })->name('tenant.agenda.questionnaire.thanks');
            });
        });

        // Perfil de Usuario
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Gestión de Archivos
        Route::resource('files', FileController::class);
        Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');
        Route::get('/files/{file}/preview', [FileController::class, 'preview'])->name('files.preview');
        Route::post('/files/{file}/share', [FileController::class, 'share'])->name('files.share');
        Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

        // Archivos Compartidos
        Route::get('/shared-files', [FileController::class, 'sharedFiles'])->name('files.shared.files');
        Route::get('/shared-files/{user}', [FileController::class, 'sharedByUser'])->name('files.shared.byUser');

        // Carrito
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::patch('/update/{item}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/item/{id}', [CartController::class, 'remove'])->name('cart.remove.item');

        // Planes
        Route::get('/plans', [ProductController::class, 'plans'])->name('products.plans');

        // Casos
        Route::prefix('cases')->group(function () {
            Route::get('/', [CaseController::class, 'index'])->name('cases.index');
            Route::get('/create', [CaseController::class, 'create'])->name('cases.create');
            Route::post('/', [CaseController::class, 'store'])->name('cases.store');
            Route::get('/{case}/edit', [CaseController::class, 'edit'])->name('cases.edit');
            Route::put('/{case}', [CaseController::class, 'update'])->name('cases.update');
            Route::delete('/{case}', [CaseController::class, 'destroy'])->name('cases.destroy');
        });

        // Transbank
        Route::post('/pagar', [TransbankController::class, 'createTransaction'])->name('transbank.create');
        Route::match(['GET', 'POST'], '/webpay/response', [TransbankController::class, 'response'])->name('transbank.response');
        Route::post('/agenda/initiate-payment', [AgendaController::class, 'initiatePayment'])
            ->name('tenant.agenda.initiatePayment');

        Route::get('checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');

        // Checkout
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

        Route::get('/webpay/cancelled', [TransbankController::class, 'cancelled'])
            ->name('transbank.cancelled');
    });

    // Rutas exclusivas para Administrador
    Route::middleware(['auth', 'role:Admin'])->group(function () {
        // API para calendario de citas agendadas
        Route::get('/api/appointments', [AppointmentApiController::class, 'index'])->name('appointments.api.index');

        // Gestión de Textos
        Route::put('/tenant/texts/update', [TenantTextController::class, 'update'])->name('tenant.texts.update');
        Route::get('/panel/textos', [TenantTextController::class, 'edit'])->name('tenant.texts.edit');

        // Panel de Control
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Gestión de Agenda
        Route::resource('available-slots', AvailableSlotController::class)->only(['index', 'store', 'destroy']);
        Route::get('/available-slots/{id}/reservations', [AvailableSlotController::class, 'reservations'])->name('available-slots.reservations');
        Route::get('/available-slots/{slot}/edit', [AvailableSlotController::class, 'edit'])->name('available-slots.edit');
        Route::put('/available-slots/{slot}', [AvailableSlotController::class, 'update'])->name('available-slots.update');

        // Cargas de Horarios
        Route::get('/schedule-batches/create', [ScheduleBatchController::class, 'create'])->name('schedule-batches.create');
        Route::post('/schedule-batches', [ScheduleBatchController::class, 'store'])->name('schedule-batches.store');
        Route::get('/schedule-batches/{id}/edit', [ScheduleBatchController::class, 'edit'])->name('schedule-batches.edit');
        Route::delete('/schedule-batches/{id}', [ScheduleBatchController::class, 'destroy'])->name('schedule-batches.destroy');
        Route::put('/schedule-batches/{id}', [ScheduleBatchController::class, 'update'])->name('schedule-batches.update');

        // Gestión de Apariencia
        Route::get('/appearance', [AppearanceController::class, 'index'])->name('appearance');
        Route::post('/appearance', [AppearanceController::class, 'update'])->name('appearance.update');

        // Gestión de Usuarios
        Route::resource('users', UserController::class);

        // Gestión de Roles
        Route::resource('roles', RoleController::class);

        // Gestión de Productos
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Calendario de Disponibilidad
        Route::get('/admin/disponibilidad/calendario', function () {
            return view('tenants.default.available-slots.calendar');
        })->middleware('role:Admin')->name('admin.disponibilidad.calendario');
    });

    require __DIR__ . '/tenant-auth.php';
});
