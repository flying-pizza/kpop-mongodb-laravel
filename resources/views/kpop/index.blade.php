<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Pop Idol Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #a78bfa 0%, #c4b5fd 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            --gradient-bg: linear-gradient(135deg, #1e1b4b 0%, #2e1065 50%, #1e1b4b 100%);
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: rgba(168, 85, 247, 0.5) transparent;
        }

        *::-webkit-scrollbar {
            width: 8px;
        }

        *::-webkit-scrollbar-track {
            background: transparent;
        }

        *::-webkit-scrollbar-thumb {
            background: rgba(168, 85, 247, 0.5);
            border-radius: 4px;
        }

        body {
            background: var(--gradient-bg);
            background-attachment: fixed;
        }

        .gradient-purple {
            background: var(--gradient-primary);
        }

        .gradient-secondary {
            background: var(--gradient-secondary);
        }

        .gradient-success {
            background: var(--gradient-success);
        }

        .gradient-danger {
            background: var(--gradient-danger);
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px rgba(102, 126, 234, 0.35), 
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .badge-group {
            background: var(--gradient-secondary);
            color: #6d28d9;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.3);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .status-success {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .status-failed {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .status-warning {
            background: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .icon-wrapper {
            background: linear-gradient(135deg, #ddd6fe 0%, #ede9fe 100%);
            color: #7c3aed;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            padding: 8px;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.15);
        }

        .icon-wrapper.dark {
            background: rgba(168, 85, 247, 0.15);
            color: #c4b5fd;
            border: 1px solid rgba(168, 85, 247, 0.3);
        }

        .dashboard-header {
            background: var(--gradient-primary);
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .dashboard-header::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        .dashboard-header > * {
            position: relative;
            z-index: 10;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(168, 85, 247, 0.1);
            transition: background 0.3s ease;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row:hover {
            background: rgba(168, 85, 247, 0.05);
            border-radius: 6px;
            padding: 12px 8px;
        }

        .info-label {
            font-size: 12px;
            font-weight: 600;
            color: #a78bfa;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #f3f4f6;
        }

        .stat-box {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.15) 0%, rgba(139, 92, 246, 0.1) 100%);
            border: 1px solid rgba(168, 85, 247, 0.3);
            border-radius: 10px;
            padding: 16px;
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.25) 0%, rgba(139, 92, 246, 0.2) 100%);
            border-color: rgba(168, 85, 247, 0.5);
            transform: translateY(-2px);
        }

        .header-stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .header-stat-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 16px 24px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header-stat-number {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            display: block;
        }

        .header-stat-label {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .shimmer {
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .pulse-dot {
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { 
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            50% { 
                box-shadow: 0 0 0 8px rgba(16, 185, 129, 0);
            }
        }

        .card-header-avatar {
            width: 100%;
            height: 140px;
            background: var(--gradient-primary);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 12px 12px 0 0;
        }

        .card-header-avatar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2), transparent 50%);
        }

        .avatar-content {
            position: relative;
            z-index: 5;
            text-align: center;
        }

        .avatar-emoji {
            font-size: 48px;
            margin-bottom: 8px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .avatar-name {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: 0.5px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, #a78bfa 0%, #c4b5fd 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6d28d9;
            font-size: 40px;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .footer {
            text-align: center;
            padding: 32px 20px;
            border-top: 1px solid rgba(168, 85, 247, 0.2);
            margin-top: 60px;
            background: rgba(168, 85, 247, 0.05);
        }

        .footer-text {
            color: #a78bfa;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>
<body class="min-h-screen">
    
    <!-- Header -->
    <div class="dashboard-header text-white py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-start justify-between flex-wrap gap-6 mb-8">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-4xl">✨</span>
                        <h1 class="text-5xl sm:text-6xl font-black bg-gradient-to-r from-white via-purple-100 to-purple-200 bg-clip-text text-transparent">K-Pop Idol</h1>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold mb-3">Dashboard</h2>
                    <p class="text-purple-100 text-lg max-w-2xl">Discover and explore talented K-Pop idols from around the world. Browse through stunning profiles with detailed information.</p>
                </div>
            </div>
            
            <!-- Header Stats -->
            <div class="header-stats">
                <div class="header-stat-item">
                    <span class="header-stat-number">{{ count($idols) }}</span>
                    <span class="header-stat-label">Total Idols</span>
                </div>
                <div class="header-stat-item">
                    <span class="header-stat-number">{{ $idols->pluck('country')->unique()->count() }}</span>
                    <span class="header-stat-label">Countries</span>
                </div>
                <div class="header-stat-item">
                    <span class="header-stat-number">{{ $idols->pluck('group')->unique()->filter()->count() }}</span>
                    <span class="header-stat-label">Groups</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        @if($idols->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">🎤</div>
                <h3 class="text-2xl font-bold text-white mb-3">No Idols Found</h3>
                <p class="text-purple-300 text-lg max-w-md mx-auto">Start adding K-Pop idols to build your amazing dashboard and discover new talents!</p>
            </div>
        @else
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($idols as $idol)
                    <div class="card-hover bg-gradient-to-b from-purple-800 to-purple-900 rounded-xl overflow-hidden border border-purple-700 shadow-2xl">
                        
                        <!-- Card Header with Status -->
                        <div class="card-header-avatar">
                            <div class="avatar-content">
                                <div class="avatar-emoji">🎤</div>
                                <div class="avatar-name">{{ $idol->stage_name ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6">
                            
                            <!-- Group Badge -->
                            @if($idol->group)
                                <div class="mb-5">
                                    <span class="badge-group px-4 py-2 rounded-full text-sm inline-block">
                                        <i class="fas fa-music mr-2"></i>{{ $idol->group }}
                                    </span>
                                </div>
                            @endif

                            <!-- Basic Info -->
                            <div class="space-y-2 mb-6">
                                @if($idol->full_name)
                                    <div class="info-row">
                                        <div class="flex-1">
                                            <p class="info-label">Full Name</p>
                                            <p class="info-value">{{ $idol->full_name }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($idol->korean_name || $idol->k_name)
                                    <div class="info-row">
                                        <div class="flex-1">
                                            <p class="info-label">Korean Name</p>
                                            <p class="info-value">{{ $idol->korean_name ?? $idol->k_name }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($idol->country)
                                    <div class="info-row">
                                        <div class="flex-1">
                                            <p class="info-label">Country</p>
                                            <p class="info-value">{{ $idol->country }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($idol->gender)
                                    <div class="info-row">
                                        <div class="flex-1">
                                            <p class="info-label">Gender</p>
                                            <p class="info-value">{{ $idol->gender }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Physical Attributes with Icons -->
                            <div class="space-y-3 mb-6 pb-6 border-b border-purple-700">
                                @if($idol->k_height)
                                    <div class="stat-box">
                                        <div class="flex items-center gap-3">
                                            <div class="icon-wrapper dark">
                                                <i class="fas fa-ruler-vertical"></i>
                                            </div>
                                            <div class="flex-1">
                                                <p class="info-label">Height</p>
                                                <p class="text-lg font-bold text-white">{{ $idol->k_height }} cm</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($idol->k_weight)
                                    <div class="stat-box">
                                        <div class="flex items-center gap-3">
                                            <div class="icon-wrapper dark">
                                                <i class="fas fa-weight"></i>
                                            </div>
                                            <div class="flex-1">
                                                <p class="info-label">Weight</p>
                                                <p class="text-lg font-bold text-white">{{ $idol->k_weight }} kg</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Birthplace with Icon -->
                            @if($idol->k_birthplace)
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="icon-wrapper dark flex-shrink-0">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="info-label">Birthplace</p>
                                        <p class="text-white font-medium">{{ $idol->k_birthplace }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Date of Birth -->
                            @if($idol->date_of_birth)
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="icon-wrapper dark flex-shrink-0">
                                        <i class="fas fa-birthday-cake"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="info-label">Date of Birth</p>
                                        <p class="text-white font-medium">{{ \Carbon\Carbon::parse($idol->date_of_birth)->format('F j, Y') }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Instagram -->
                            @if($idol->instagram)
                                <div class="flex items-start gap-3">
                                    <div class="icon-wrapper dark flex-shrink-0">
                                        <i class="fab fa-instagram"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="info-label">Instagram</p>
                                        <a href="https://instagram.com/{{ $idol->instagram }}" target="_blank" class="text-purple-300 hover:text-purple-100 font-medium break-words transition duration-300 hover:underline">
                                            @{{ $idol->instagram }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <!-- Card Footer -->
                        <div class="bg-gradient-to-r from-purple-950 to-purple-900 px-6 py-4 flex justify-between items-center border-t border-purple-700">
                            <div class="flex items-center gap-2">
                                <span class="relative inline-flex h-2.5 w-2.5">
                                    <span class="pulse-dot animate-pulse absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                                </span>
                                <span class="status-badge status-success">
                                    <i class="fas fa-check-circle text-xs"></i>
                                    Active
                                </span>
                            </div>
                            <a href="#" class="inline-flex items-center gap-2 text-purple-300 hover:text-purple-100 transition text-sm font-semibold group">
                                View Profile 
                                <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

    <!-- Footer -->
    <div class="footer">
        <p class="footer-text">
            <i class="fas fa-sparkles mr-2"></i>K-Pop Idol Dashboard • Celebrating talented artists worldwide<i class="fas fa-sparkles ml-2"></i>
        </p>
    </div>
</body>
</html>
