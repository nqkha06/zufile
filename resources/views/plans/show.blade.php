@extends('layouts.member_2')

@section('title', $plan->name . ' Plan')

@push('styles')
<style>
    .plan-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        margin-bottom: 2rem;
    }
    .feature-card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .feature-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    .price-display {
        font-size: 3rem;
        font-weight: bold;
    }
    .comparison-table th {
        background: #f8f9fa;
        border: none;
        font-weight: 600;
    }
    .comparison-table td {
        border: 1px solid #dee2e6;
        vertical-align: middle;
    }
    .upgrade-card {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border: none;
    }
    .duration-option {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .duration-option:hover {
        border-color: #007bff;
        background-color: #f8f9ff;
    }
    .duration-option.selected {
        border-color: #007bff;
        background-color: #e3f2fd;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Plan Hero Section -->
    <div class="plan-hero p-5 text-center">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 mb-3">{{ $plan->name }}</h1>
                <p class="lead mb-0">
                    @if($plan->isFree())
                        Perfect for getting started with basic file sharing
                    @else
                        Enhanced features for power users and professionals
                    @endif
                </p>
            </div>
            <div class="col-md-4">
                <div class="price-display">
                    @if($plan->isFree())
                        <span class="text-success">Free</span>
                    @else
                        <small style="font-size: 1rem;">$</small>{{ number_format($plan->price, 0) }}
                        <small style="font-size: 1rem;">/month</small>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Plan Features -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="bi bi-list-check me-2"></i>
                        Plan Features
                    </h5>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="feature-card card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-hdd-fill display-4 text-primary mb-3"></i>
                                    <h6>Storage Limit</h6>
                                    <p class="text-muted mb-0">{{ $plan->formatted_storage_limit }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="feature-card card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-file-earmark-arrow-up-fill display-4 text-success mb-3"></i>
                                    <h6>Max File Size</h6>
                                    <p class="text-muted mb-0">{{ $plan->formatted_file_size_limit }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="feature-card card h-100">
                                <div class="card-body text-center">
                                    @if($plan->file_keep_forever)
                                        <i class="bi bi-infinity display-4 text-warning mb-3"></i>
                                        <h6>File Retention</h6>
                                        <p class="text-muted mb-0">Keep Forever</p>
                                    @else
                                        <i class="bi bi-calendar-check display-4 text-info mb-3"></i>
                                        <h6>File Retention</h6>
                                        <p class="text-muted mb-0">{{ $plan->file_keep_days }} Days</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="feature-card card h-100">
                                <div class="card-body text-center">
                                    @if($plan->ads_reduced)
                                        <i class="bi bi-shield-check-fill display-4 text-success mb-3"></i>
                                        <h6>Advertising</h6>
                                        <p class="text-muted mb-0">Reduced Ads</p>
                                    @else
                                        <i class="bi bi-eye-fill display-4 text-secondary mb-3"></i>
                                        <h6>Advertising</h6>
                                        <p class="text-muted mb-0">Standard Ads</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current vs Target Plan Comparison -->
            @if($user->currentPlan && $user->currentPlan->plan_id != $plan->id)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="bi bi-arrow-left-right me-2"></i>
                            Plan Comparison
                        </h5>

                        <div class="table-responsive">
                            <table class="table comparison-table">
                                <thead>
                                    <tr>
                                        <th>Feature</th>
                                        <th class="text-center">Current: {{ $user->currentPlan->plan->name }}</th>
                                        <th class="text-center">Target: {{ $plan->name }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Price</strong></td>
                                        <td class="text-center">
                                            @if($user->currentPlan->plan->isFree())
                                                <span class="badge bg-success">Free</span>
                                            @else
                                                ${{ number_format($user->currentPlan->plan->price, 2) }}/month
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($plan->isFree())
                                                <span class="badge bg-success">Free</span>
                                            @else
                                                ${{ number_format($plan->price, 2) }}/month
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Storage</strong></td>
                                        <td class="text-center">{{ $user->currentPlan->plan->formatted_storage_limit }}</td>
                                        <td class="text-center">
                                            {{ $plan->formatted_storage_limit }}
                                            @if($plan->storage_limit > $user->currentPlan->plan->storage_limit)
                                                <i class="bi bi-arrow-up text-success ms-1"></i>
                                            @elseif($plan->storage_limit < $user->currentPlan->plan->storage_limit)
                                                <i class="bi bi-arrow-down text-danger ms-1"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Max File Size</strong></td>
                                        <td class="text-center">{{ $user->currentPlan->plan->formatted_file_size_limit }}</td>
                                        <td class="text-center">
                                            {{ $plan->formatted_file_size_limit }}
                                            @if($plan->file_size_limit > $user->currentPlan->plan->file_size_limit)
                                                <i class="bi bi-arrow-up text-success ms-1"></i>
                                            @elseif($plan->file_size_limit < $user->currentPlan->plan->file_size_limit)
                                                <i class="bi bi-arrow-down text-danger ms-1"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>File Retention</strong></td>
                                        <td class="text-center">
                                            {{ $user->currentPlan->plan->file_keep_forever ? 'Forever' : $user->currentPlan->plan->file_keep_days . ' days' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $plan->file_keep_forever ? 'Forever' : $plan->file_keep_days . ' days' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Action Panel -->
        <div class="col-lg-4">
            @if($canChange['can_change'])
                @if(!$plan->isFree())
                    <div class="card upgrade-card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                @if($canChange['type'] ?? 'upgrade' == 'upgrade')
                                    <i class="bi bi-arrow-up me-2"></i>
                                    Upgrade Plan
                                @else
                                    <i class="bi bi-arrow-down me-2"></i>
                                    Switch Plan
                                @endif
                            </h5>

                            <form action="{{ route('plans.upgrade', $plan) }}" method="POST" id="upgradeForm">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Choose Duration:</label>

                                    <div class="duration-option mb-2" data-duration="30" data-price="{{ $plan->price }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>1 Month</strong>
                                                <br>
                                                <small>Most Popular</small>
                                            </div>
                                            <div class="text-end">
                                                <strong>${{ number_format($plan->price, 2) }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="duration-option mb-2" data-duration="90" data-price="{{ $plan->price * 3 }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>3 Months</strong>
                                                <br>
                                                <small>Save 0%</small>
                                            </div>
                                            <div class="text-end">
                                                <strong>${{ number_format($plan->price * 3, 2) }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="duration-option mb-3" data-duration="365" data-price="{{ $plan->price * 10 }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>1 Year</strong>
                                                <br>
                                                <small class="text-warning">Save 17%!</small>
                                            </div>
                                            <div class="text-end">
                                                <strong>${{ number_format($plan->price * 10, 2) }}</strong>
                                                <br>
                                                <small class="text-decoration-line-through">${{ number_format($plan->price * 12, 2) }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="duration" id="selectedDuration" value="30">
                                </div>

                                <button type="submit" class="btn btn-light w-100">
                                    <i class="bi bi-credit-card me-1"></i>
                                    Proceed to Payment
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Free Plan Action -->
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <i class="bi bi-gift display-4 text-success mb-3"></i>
                            <h5>Switch to Free Plan</h5>
                            <p class="text-muted">Downgrade to our free plan with basic features.</p>

                            <form action="{{ route('plans.downgrade') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-success w-100"
                                        onclick="return confirm('Are you sure you want to downgrade to the free plan?')">
                                    <i class="bi bi-arrow-down me-1"></i>
                                    Switch to Free
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @else
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <i class="bi bi-check-circle display-4 text-success mb-3"></i>
                        <h5>Current Plan</h5>
                        <p class="text-muted">{{ $canChange['message'] }}</p>

                        <a href="{{ route('plans.index') }}" class="btn btn-primary w-100">
                            <i class="bi bi-arrow-left me-1"></i>
                            View All Plans
                        </a>
                    </div>
                </div>
            @endif

            <!-- Plan Statistics -->
            @if($plan->active_users_count > 0)
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title">Popular Choice</h6>
                        <p class="text-muted mb-0">
                            <i class="bi bi-people me-1"></i>
                            {{ number_format($plan->active_users_count) }} users are currently on this plan
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Duration selection
    const durationOptions = document.querySelectorAll('.duration-option');
    const selectedDurationInput = document.getElementById('selectedDuration');

    // Set initial selection
    durationOptions[0].classList.add('selected');

    durationOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all options
            durationOptions.forEach(opt => opt.classList.remove('selected'));

            // Add selected class to clicked option
            this.classList.add('selected');

            // Update hidden input
            selectedDurationInput.value = this.dataset.duration;
        });
    });
});
</script>
@endpush
