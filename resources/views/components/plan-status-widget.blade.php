@if(auth()->check())
    @php
        $user = auth()->user();
        $currentPlan = $user->currentPlan;
    @endphp

    @if($currentPlan)
        <div class="plan-status-widget">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    @if($currentPlan->isExpired())
                        <div class="badge bg-danger">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Expired
                        </div>
                    @elseif($currentPlan->isExpiringSoon())
                        <div class="badge bg-warning">
                            <i class="bi bi-clock me-1"></i>
                            {{ $currentPlan->getDaysUntilExpiration() }}d left
                        </div>
                    @else
                        <div class="badge bg-success">
                            <i class="bi bi-check-circle me-1"></i>
                            Active
                        </div>
                    @endif
                </div>

                <div class="flex-grow-1">
                    <small class="text-muted d-block">{{ $currentPlan->plan->name }}</small>
                    @if($currentPlan->expires_at)
                        <small class="text-muted">Expires: {{ $currentPlan->expires_at->format('M d, Y') }}</small>
                    @endif
                </div>

                <div class="ms-2">
                    <div class="progress" style="width: 50px; height: 6px;">
                        <div class="progress-bar bg-{{ $user->getStorageUsagePercentage() > 90 ? 'danger' : ($user->getStorageUsagePercentage() > 75 ? 'warning' : 'success') }}"
                             style="width: {{ $user->getStorageUsagePercentage() }}%"></div>
                    </div>
                    <small class="text-muted">{{ number_format($user->getStorageUsagePercentage(), 0) }}% used</small>
                </div>

                <div class="ms-2">
                    <a href="{{ route('plans.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-gear"></i>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="plan-status-widget">
            <div class="d-flex align-items-center">
                <div class="badge bg-secondary me-2">
                    <i class="bi bi-info-circle me-1"></i>
                    No Plan
                </div>
                <small class="text-muted me-2">Get started with a plan</small>
                <a href="{{ route('plans.index') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus me-1"></i>
                    Choose Plan
                </a>
            </div>
        </div>
    @endif

    <style>
        .plan-status-widget {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 15px;
        }
        .plan-status-widget .progress {
            border-radius: 3px;
        }
        .plan-status-widget .badge {
            font-size: 0.7rem;
        }
    </style>
@endif
