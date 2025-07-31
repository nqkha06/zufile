@if(session('plan_expired_warning'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <strong>Plan Expired!</strong> {{ session('plan_expired_warning') }}
        <a href="{{ route('plans.index') }}" class="alert-link ms-2">Renew Now</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('plan_expiring_warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-clock me-2"></i>
        <strong>Plan Expiring Soon!</strong> {{ session('plan_expiring_warning') }}
        <a href="{{ route('plans.index') }}" class="alert-link ms-2">Renew Now</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(auth()->check() && auth()->user()->currentPlan && auth()->user()->getStorageUsagePercentage() > 90)
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="bi bi-hdd me-2"></i>
        <strong>Storage Almost Full!</strong> You're using {{ number_format(auth()->user()->getStorageUsagePercentage(), 1) }}% of your storage.
        <a href="{{ route('plans.index') }}" class="alert-link ms-2">Upgrade Plan</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="bi bi-info-circle me-2"></i>
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
