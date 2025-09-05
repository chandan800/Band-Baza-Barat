@extends('layouts.app')
@section('content')
    <style>
        .matches-container {
            background: var(--light-bg);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .matches-header {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .matches-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .filter-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .filter-chip {
            background: var(--maroon);
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .filter-chip .remove-filter {
            background: none;
            border: none;
            color: var(--white);
            cursor: pointer;
            padding: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
        }
        
        .view-toggle {
            display: flex;
            background: var(--white);
            border-radius: 6px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .view-toggle button {
            background: none;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .view-toggle button.active {
            background: var(--maroon);
            color: var(--white);
        }
        
        .filters-sidebar {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            height: fit-content;
            position: sticky;
            top: 100px;
        }
        
        .filter-section {
            margin-bottom: 2rem;
        }
        
        .filter-section h6 {
            color: var(--maroon);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .filter-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .range-slider {
            width: 100%;
            margin: 0.5rem 0;
        }
        
        .range-output {
            background: var(--light-bg);
            padding: 0.5rem;
            border-radius: 4px;
            text-align: center;
            font-weight: 500;
            color: var(--maroon);
        }
        
        .matches-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .matches-list {
            display: none;
            flex-direction: column;
            gap: 1rem;
        }
        
        .match-card {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
        }
        
        .match-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .match-card.list-view {
            display: flex;
            flex-direction: row;
        }
        
        .match-image {
            position: relative;
            height: 250px;
            background: linear-gradient(135deg, var(--soft-peach), var(--golden-orange));
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .match-card.list-view .match-image {
            width: 150px;
            height: 150px;
        }
        
        .match-placeholder {
            font-size: 3rem;
            color: var(--white);
            opacity: 0.7;
        }
        
        .premium-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--accent-gold);
            color: var(--text-dark);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .verified-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #28a745;
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .match-content {
            padding: 1.5rem;
            flex: 1;
        }
        
        .match-header {
            display: flex;
            justify-content: between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .match-name {
            color: var(--maroon);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }
        
        .match-id {
            color: var(--muted);
            font-size: 0.8rem;
        }
        
        .match-details {
            color: var(--text-dark);
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        
        .match-caste {
            background: var(--light-bg);
            color: var(--maroon);
            padding: 0.5rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .match-bio {
            color: var(--muted);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            font-style: italic;
        }
        
        .match-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .match-actions .btn {
            flex: 1;
            min-width: 80px;
        }
        
        .compatibility-score {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--maroon);
            color: var(--white);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }
        
        .gotra-compatible {
            background: #28a745;
            color: var(--white);
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.7rem;
            margin-left: 0.5rem;
        }
        
        .gotra-warning {
            background: #ffc107;
            color: var(--text-dark);
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.7rem;
            margin-left: 0.5rem;
        }
        
        .no-matches {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--muted);
        }
        
        .no-matches i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--soft-peach);
        }
        
        .pagination-container {
            margin-top: 3rem;
            text-align: center;
        }
        
        .load-more {
            background: var(--maroon);
            color: var(--white);
            border: none;
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .load-more:hover {
            background: var(--golden-orange);
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .matches-container {
                padding: 1rem;
            }
            
            .matches-header {
                padding: 1rem;
            }
            
            .matches-summary {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            
            .filters-sidebar {
                position: static;
                margin-bottom: 1rem;
            }
            
            .match-actions {
                flex-direction: column;
            }
            
            .match-actions .btn {
                flex: none;
            }
        }
    </style>

    <!-- Matches Container -->
    <div class="matches-container">
        <div class="container">
            <!-- Header -->
            <div class="matches-header">
                <h2><i class="fas fa-heart me-2"></i>Your Matches</h2>
                <p class="text-muted mb-0">Compatible profiles based on your preferences and cultural values</p>
            </div>

            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-lg-3">
                    <div class="filters-sidebar">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-filter me-2"></i>Filters</h5>
                            <button class="btn btn-sm btn-outline-secondary" id="clearFilters">Clear All</button>
                        </div>

<div class="filter-section">
    <h6>Age Range</h6>
    <div class="range-output" id="ageRangeOutput">{{ $ageMin }} - {{ $ageMax }} years</div>
    <input type="range" class="range-slider" id="ageMin" min="{{ $ageMin }}" max="{{ $ageMax }}" value="{{ $ageMin }}">
    <input type="range" class="range-slider" id="ageMax" min="{{ $ageMin }}" max="{{ $ageMax }}" value="{{ $ageMax }}">
</div>

<!-- Height Range -->
<div class="filter-section">
    <h6>Height Range</h6>
    <div class="range-output" id="heightRangeOutput">{{ $heightMin }}cm - {{ $heightMax }}cm</div>
    <input type="range" class="range-slider" id="heightMin" min="{{ $heightMin }}" max="{{ $heightMax }}" value="{{ $heightMin }}">
    <input type="range" class="range-slider" id="heightMax" min="{{ $heightMin }}" max="{{ $heightMax }}" value="{{ $heightMax }}">
</div>

                        <!-- Education -->
<div class="filter-section">
    <h6>Education</h6>
    <div class="filter-options">
        @foreach($educations as $edu)
            <div class="filter-option">
                <input type="checkbox" class="form-check-input education-checkbox" id="edu-{{ $loop->index }}" value="{{ $edu }}">
                <label for="edu-{{ $loop->index }}">{{ $edu }}</label>
            </div>
        @endforeach
    </div>
</div>

<!-- Occupation -->
<div class="filter-section">
    <h6>Occupation</h6>
    <div class="filter-options">
        @foreach($occupations as $occ)
            <div class="filter-option">
                <input type="checkbox" class="form-check-input occupation-checkbox" id="occ-{{ $loop->index }}" value="{{ $occ }}">
                <label for="occ-{{ $loop->index }}">{{ $occ }}</label>
            </div>
        @endforeach
    </div>
</div>

<!-- State -->
<div class="filter-section">
    <h6>Location</h6>
    <select class="form-select mb-2" id="stateSelect">
        <option value="">Select State</option>
        @foreach($states as $state)
            <option value="{{ $state }}">{{ $state }}</option>
        @endforeach
    </select>
    <select class="form-select" id="citySelect">
        <option value="">Select City</option>
        @foreach($cities as $city)
            <option value="{{ $city }}">{{ $city }}</option>
        @endforeach
    </select>
</div>
<div class="filter-section"> <h6>Gotra Compatibility</h6> <div class="filter-option"> <input type="checkbox" id="allowSameGotra" class="form-check-input"> <label for="allowSameGotra"> <small>Allow same Gotra</small> <i class="fas fa-info-circle text-warning ms-1" title="Usually not recommended by tradition"></i> </label> </div> </div>

<div class="filter-section">
    <h6>Gotra</h6>
    <div class="filter-options">
        @foreach($gotras as $gotra)
            <div class="filter-option">
                <input type="checkbox" class="form-check-input gotra-checkbox" id="gotra-{{ $loop->index }}" value="{{ $gotra }}">
                <label for="gotra-{{ $loop->index }}">{{ $gotra }}</label>
            </div>
        @endforeach
    </div>
</div>



                        <!-- Apply Filters -->
                        <button class="btn btn-primary w-100 mt-3" id="applyFilters">
                            <i class="fas fa-search me-2"></i>Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9">
                    <!-- Summary and Controls -->
                    <div class="matches-summary">
                        <div>
                            <h6>Showing <span id="resultsCount">25</span> matches</h6>
                            <div class="filter-chips" id="activeFilters">
                                <div class="filter-chip">
                                    Same Caste Only
                                    <button class="remove-filter">×</button>
                                </div>
                                <div class="filter-chip">
                                    Different Gotra
                                    <button class="remove-filter">×</button>
                                </div>
                            </div>
                        </div>
                        <div class="view-toggle">
                            <button class="view-btn active" data-view="grid">
                                <i class="fas fa-th"></i>
                            </button>
                            <button class="view-btn" data-view="list">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Matches Grid -->
                    <div class="matches-grid" id="matchesGrid">

                    </div>

                    <!-- Matches List View -->
                    <div class="matches-list" id="matchesList">
                        <!-- List view will be populated by JavaScript -->
                    </div>

                    <!-- Load More -->
                    <div class="pagination-container">
                        <button class="load-more" id="loadMore">
                            <i class="fas fa-plus me-2"></i>Load More Matches
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   <script>
document.addEventListener('DOMContentLoaded', function() {

    // Initialize ranges and view toggle
    initializeViewToggle();
    initializeRanges();
    loadMatches(); // initial AJAX load

    // Clear filters
    document.getElementById('clearFilters').addEventListener('click', function() {
        document.querySelectorAll('.form-check-input').forEach(cb => cb.checked = false);
        document.querySelectorAll('.form-select').forEach(sel => sel.value = '');
        document.getElementById('ageMin').value = 22;
        document.getElementById('ageMax').value = 30;
        document.getElementById('heightMin').value = 62;
        document.getElementById('heightMax').value = 68;
        updateAgeRange();
        updateHeightRange();
        window.BandBazaBarat.showNotification('All filters cleared', 'info');
    });

    // Apply filters
    document.getElementById('applyFilters').addEventListener('click', function() {
        const button = this;
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Applying Filters...';
        button.disabled = true;

        const ageMin = document.getElementById('ageMin').value;
        const ageMax = document.getElementById('ageMax').value;
        const heightMin = document.getElementById('heightMin').value;
        const heightMax = document.getElementById('heightMax').value;

        const state = document.getElementById('stateSelect')?.value || '';
        const city = document.getElementById('citySelect').value || '';

        const allowSameGotra = document.getElementById('allowSameGotra').checked;
        const education = Array.from(document.querySelectorAll('.education-checkbox:checked'))
                      .map(cb => cb.value);
                      const gotras = Array.from(document.querySelectorAll('.gotra-checkbox:checked'))
    .map(cb => cb.value);
        const occupation = Array.from(document.querySelectorAll('.occupation-checkbox:checked'))
                       .map(cb => cb.value);


        fetch('/matches/filter', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ ageMin, ageMax, heightMin, heightMax, state, city, allowSameGotra,  education, occupation ,gotras })
        })
        .then(res => res.json())
        .then(data => {
            const matchesGrid = document.getElementById('matchesGrid');
            matchesGrid.innerHTML = '';
            document.getElementById('resultsCount').textContent = data.count;

            data.users.forEach(user => {
                const mainPhoto = user.photos?.find(p => p.is_profile_photo) || null;
                const photoHtml = mainPhoto ? 
                    `<img src="${mainPhoto.photo_url}" alt="${user.first_name}">` : 
                    `<div class="match-placeholder"><i class="fas fa-user"></i></div>`;

                const compatibility = Math.floor(Math.random() * (99 - 75 + 1)) + 75;

                matchesGrid.insertAdjacentHTML('beforeend', `
                    <div class="match-card">
                        <div class="match-image">
                            ${photoHtml}
                            ${user.is_premium ? '<div class="premium-badge">Premium</div>' : ''}
                            ${user.verified_profile ? '<div class="verified-badge">Verified</div>' : ''}
                            <div class="compatibility-score">${compatibility}%</div>
                        </div>
                        <div class="match-content">
                            <div class="match-header">
                                <div>
                                    <div class="match-name">
                                        ${user.first_name} ${user.last_name?.[0] || ''}.
                                        ${user.profile?.gotra ? '<span class="gotra-compatible">Gotra Compatible</span>' : ''}
                                    </div>
                                    <div class="match-id">${user.profile?.profile_key || 'N/A'}</div>
                                </div>
                            </div>
                            <div class="match-details">
                                ${user.age || 'N/A'} years, ${user.profile?.height_cm || 'N/A'}"<br>
                                ${user.education || 'N/A'}, ${user.occupation || 'N/A'}<br>
                                ${user.profile?.current_city || 'N/A'}, ${user.profile?.current_state || 'N/A'}
                            </div>
                            <div class="match-caste">${user.profile?.religion || 'N/A'} - ${user.profile?.caste || 'N/A'}</div>
                            <div class="match-bio">"${user.profile?.about_family || 'No bio available.'}"</div>
                            <div class="match-actions">
                                <button class="btn btn-primary btn-sm" onclick="sendInterest(event, ${user.user_id})">
                                    <i class="fas fa-heart"></i> Interest
                                </button>
                                <button class="btn btn-outline-warning btn-sm" onclick="addToShortlist(event, ${user.user_id})">
                                    <i class="fas fa-bookmark"></i>
                                </button>
                                <button class="btn btn-outline-primary btn-sm" onclick="viewProfile('CM${String(user.user_id).padStart(6,'0')}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `);
            });

            button.innerHTML = originalText;
            button.disabled = false;
        })
        .catch(err => {
            console.error(err);
            window.BandBazaBarat.showNotification('Failed to apply filters', 'error');
            button.innerHTML = originalText;
            button.disabled = false;
        });
    });

    // Range slider functions
    function initializeRanges() {
        const ageMin = document.getElementById('ageMin');
        const ageMax = document.getElementById('ageMax');
        const heightMin = document.getElementById('heightMin');
        const heightMax = document.getElementById('heightMax');

        function updateAgeRange() {
            const min = parseInt(ageMin.value);
            const max = parseInt(ageMax.value);
            if(min > max) ageMax.value = min;
            document.getElementById('ageRangeOutput').textContent = `${min} - ${ageMax.value} years`;
        }

        function updateHeightRange() {
            const min = parseInt(heightMin.value);
            const max = parseInt(heightMax.value);
            if(min > max) heightMax.value = min;
            const minFeet = Math.floor(min / 12);
            const minInches = min % 12;
            const maxFeet = Math.floor(max / 12);
            const maxInches = max % 12;
            document.getElementById('heightRangeOutput').textContent = `${minFeet}'${minInches}" - ${maxFeet}'${maxInches}"`;
        }

        ageMin.addEventListener('input', updateAgeRange);
        ageMax.addEventListener('input', updateAgeRange);
        heightMin.addEventListener('input', updateHeightRange);
        heightMax.addEventListener('input', updateHeightRange);

        updateAgeRange();
        updateHeightRange();
    }

    // View toggle
    function initializeViewToggle() {
        const viewButtons = document.querySelectorAll('.view-btn');
        const matchesGrid = document.getElementById('matchesGrid');
        const matchesList = document.getElementById('matchesList');

        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                viewButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                if(this.dataset.view === 'list') {
                    matchesGrid.style.display = 'none';
                    matchesList.style.display = 'flex';
                    convertToListView();
                } else {
                    matchesGrid.style.display = 'grid';
                    matchesList.style.display = 'none';
                }
            });
        });
    }

    function convertToListView() {
        const matchesList = document.getElementById('matchesList');
        matchesList.innerHTML = '';
        document.querySelectorAll('.match-card').forEach(card => {
            const listCard = card.cloneNode(true);
            listCard.classList.add('list-view');
            matchesList.appendChild(listCard);
        });
    }

    // Load initial matches
    function loadMatches() {
        fetch('/matchesAjax')
            .then(res => res.json())
            .then(users => {
                const container = document.getElementById('matchesGrid');
                container.innerHTML = '';
                const resultsCount = document.getElementById('resultsCount');
                resultsCount.textContent = users.count;

                users.users.forEach(user => {
                    const mainPhoto = user.photos?.find(p => p.is_profile_photo) || null;
                    const photoHtml = mainPhoto ? `<img src="${mainPhoto.photo_url}" alt="${user.first_name}">` : `<div class="match-placeholder"><i class="fas fa-user"></i></div>`;
                    const compatibility = Math.floor(Math.random() * (99 - 75 + 1)) + 75;

                    container.insertAdjacentHTML('beforeend', `
                        <div class="match-card">
                            <div class="match-image">
                                ${photoHtml}
                                ${user.is_premium ? '<div class="premium-badge">Premium</div>' : ''}
                                ${user.verified_profile ? '<div class="verified-badge">Verified</div>' : ''}
                                <div class="compatibility-score">${compatibility}%</div>
                            </div>
                            <div class="match-content">
                                <div class="match-header">
                                    <div>
                                        <div class="match-name">${user.first_name} ${user.last_name?.[0] || ''}.${user.profile?.gotra ? '<span class="gotra-compatible">Gotra Compatible</span>' : ''}</div>
                                        <div class="match-id">${user.profile?.profile_key || ''}</div>
                                    </div>
                                </div>
                                <div class="match-details">
                                    ${user.age || 'N/A'} years, ${user.profile?.height_cm || 'N/A'}"<br>
                                    ${user.education || 'N/A'}, ${user.occupation || 'N/A'}<br>
                                    ${user.profile?.current_city || 'N/A'}, ${user.profile?.current_state || 'N/A'}
                                </div>
                                <div class="match-caste">${user.profile?.religion || 'N/A'} - ${user.profile?.caste || 'N/A'}</div>
                                <div class="match-bio">"${user.profile?.about_family || 'No bio available.'}"</div>
                                <div class="match-actions">
                                    <button class="btn btn-primary btn-sm" onclick="sendInterest('${user.user_id}')">
                                        <i class="fas fa-heart"></i> Interest
                                    </button>
                                    <button class="btn btn-outline-warning btn-sm" onclick="addToShortlist('${user.user_id}')">
                                        <i class="fas fa-bookmark"></i>
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm" onclick="viewProfile('CM${String(user.user_id).padStart(6,'0')}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `);
                });
            })
            .catch(err => console.error(err));
    }
});
</script>

@endsection