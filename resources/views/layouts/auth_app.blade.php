<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BandBazaBarat - Find Your Perfect Life Partner | Hindu Matrimonial</title>
    <meta name="description" content="Find your perfect life partner with BandBazaBarat - India's trusted Hindu matrimonial platform. Rooted in tradition, embraced by modernity.">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">

    <style>
        .dashboard-container {
            background: var(--light-bg);
            min-height: 100vh;
            padding-top: 2rem;
        }
        
        .sidebar {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 0;
            height: fit-content;
        }
        
        .sidebar-header {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 2rem;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            text-align: center;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            border-bottom: 1px solid #f0f0f0;
        }
        
        .sidebar-menu li:last-child {
            border-bottom: none;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--light-bg);
            color: var(--maroon);
        }
        
        .sidebar-menu i {
            width: 20px;
            margin-right: 1rem;
        }
        
        .dashboard-main {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
        }
        
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            text-align: center;
        }
        
        .stat-card i {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .profile-completion {
            background: var(--white);
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .completion-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .completion-bar {
            background: #f0f0f0;
            height: 10px;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 1rem;
        }
        
        .completion-progress {
            background: linear-gradient(90deg, var(--maroon), var(--golden-orange));
            height: 100%;
            border-radius: 5px;
            width: 75%;
            transition: width 0.3s ease;
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .quick-action {
            background: var(--white);
            border: 2px solid #e0e0e0;
            border-radius: var(--border-radius);
            padding: 1rem;
            text-align: center;
            text-decoration: none;
            color: var(--text-dark);
            transition: var(--transition);
        }
        
        .quick-action:hover {
            border-color: var(--maroon);
            color: var(--maroon);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }
        
        .quick-action i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .recent-activity {
            background: var(--white);
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius);
            padding: 1.5rem;
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--maroon);
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-time {
            color: var(--muted);
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }
            
            .sidebar {
                margin-bottom: 1rem;
            }
            
            .sidebar-header {
                padding: 1rem;
            }
            
            .dashboard-main {
                padding: 1rem;
            }
            
            .stat-cards {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
 <x-header/>
    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <div class="container">
            <div class="row">
                 <x-auth_sidebar/>
            @yield('content')
<x-footer/>
</body>
</html>
