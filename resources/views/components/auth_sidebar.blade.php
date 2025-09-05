<div class="col-lg-3 mb-4">
                    <div class="sidebar">
                        <div class="sidebar-header">
                            <div class="profile-avatar mb-2">
                                <div class="profile-placeholder" style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                    <i class="fas fa-user fs-4"></i>
                                </div>
                            </div>
                            <h5 class="mb-1" id="userDisplayName">
                                Welcome {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                            </h5>

                            <small id="profileId">{{ Auth::user()->profile->profile_key }}
                            </small>
                        </div>
                        <ul class="sidebar-menu">
                            <li><a href="{{ route('dashboard')}}" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li><a href="{{ route('dashboard.edit.profile') }}"><i class="fas fa-user-edit"></i> My Profile</a></li>
                            <li><a href="#"><i class="fas fa-images"></i> My Photos</a></li>
                            <li><a href="{{ route('match')}}"><i class="fas fa-heart"></i> Matches</a></li>
                            <li><a href="{{ route('dashboard.shortlist') }}"><i class="fas fa-bookmark"></i> Shortlisted</a></li>
                            <li><a href="#"><i class="fas fa-envelope"></i> Messages</a></li>
                            <li><a href="#"><i class="fas fa-eye"></i> Visitors</a></li>
                            <li><a href="{{ route('membership')}}"><i class="fas fa-crown"></i> Membership</a></li>
                            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                            <li>
                                <a href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                   <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>