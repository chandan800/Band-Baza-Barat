@php
    $isMultiple = is_iterable($users) && count($users) > 1;
    $users = is_iterable($users) ? $users : [$users];
@endphp

<div class="row g-4">
    @foreach($users as $user)
        @if($isMultiple)
            {{-- Compact Card for Multiple Users --}}
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="profile-card shadow-sm border rounded-3 h-100 overflow-hidden">
                    
                    {{-- Profile Image --}}
                    <div class="profile-image position-relative">
                        @if($user->photos && $user->photos->where('is_profile_photo', 1)->first())
                            <img src="{{ $user->photos->where('is_profile_photo', 1)->first()->photo_url }}"
                                 alt="{{ $user->first_name }}"
                                 class="img-fluid w-100"
                                 style="height:250px; object-fit:cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center"
                                 style="height:250px;">
                                <i class="fas fa-user fa-4x text-secondary"></i>
                            </div>
                        @endif

                        @if($user->is_premium)
                            <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">
                                Premium
                            </span>
                        @endif
                    </div>

                    {{-- Profile Content --}}
                    <div class="profile-content p-3">
                        <h5 class="profile-name mb-1">
                            {{ $user->first_name }} {{ Str::substr($user->last_name, 0, 1) }}.
                        </h5>

                        @if($user->profile)
                            <p class="profile-details small text-muted mb-2">
                                {{ $user->age ?? 'N/A' }} yrs,
                                {{ $user->profile->height_cm ?? '?' }} cm<br>
                                {{ $user->education ?? 'N/A' }},
                                {{ $user->occupation ?? 'N/A' }}<br>
                                {{ $user->profile->current_city ?? '' }}
                            </p>
                        @endif

                        <a href="#" 
                           class="btn btn-primary btn-sm w-100">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
        @else
            {{-- Detailed Card for Single User --}}
            <div class="col-lg-12 col-md-8">
                <div class="profile-card shadow-lg rounded-4 bg-white overflow-hidden">
                    <div class="row g-0">
                        
                        {{-- Profile Image --}}
                        <div class="col-md-5 position-relative">
                            @if($user->photos && $user->photos->where('is_profile_photo', 1)->first())
                                <img src="{{ $user->photos->where('is_profile_photo', 1)->first()->photo_url }}"
                                     alt="{{ $user->first_name }}"
                                     class="img-fluid h-100 w-100 object-fit-cover">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-user fa-5x text-secondary"></i>
                                </div>
                            @endif

                            @if($user->is_premium)
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 px-3 py-2 rounded-pill">
                                    Premium
                                </span>
                            @endif
                        </div>

                        {{-- Profile Content --}}
                        <div class="col-md-7 p-4">
                            <h4 class="fw-bold mb-1">
                                {{ $user->first_name }} {{ Str::substr($user->last_name, 0, 1) }}.
                            </h4>
                            <p class="text-muted mb-3">Profile ID: <strong>{{ $user->profile->profile_key ?? '' }}</strong></p>

                            @if($user->profile)
                                <ul class="list-unstyled mb-3">
                                    <li><i class="fas fa-birthday-cake me-2 text-primary"></i> {{ $user->age ?? 'N/A' }} years</li>
                                    <li><i class="fas fa-ruler-vertical me-2 text-primary"></i> {{ $user->profile->height_cm ?? '?' }} cm</li>
                                    <li><i class="fas fa-graduation-cap me-2 text-primary"></i> {{ $user->education ?? 'N/A' }}</li>
                                    <li><i class="fas fa-briefcase me-2 text-primary"></i> {{ $user->occupation ?? 'N/A' }}</li>
                                    <li><i class="fas fa-map-marker-alt me-2 text-primary"></i> {{ $user->profile->current_city ?? 'N/A' }}</li>
                                    <li><i class="fas fa-praying-hands me-2 text-primary"></i> {{ $user->profile->religion ?? '' }} - {{ $user->profile->caste ?? '' }}</li>
                                </ul>
                            @endif

                            <a href="#" 
                               class="btn btn-primary w-100 rounded-pill">
                                View Full Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
