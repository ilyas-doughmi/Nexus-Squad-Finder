<?php 
session_start();
$isloggedin = false;
if (isset($_SESSION["id"])) {
    $isloggedin = true;
}

require_once("Class/connexion.php");
require_once("Class/User.php");
$user = new User;
$user_info = $user->getUserInfo($_SESSION["id"]);
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS | The Squad Finder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Rajdhani:wght@600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nexusGreen: '#cfff04', // Neon Lime
                        nexusDark: '#0a0a0a', 
                        nexusGray: '#171717',
                    },
                    fontFamily: {
                        heading: ['Rajdhani', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 3s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #050505;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            overflow: hidden;
        }

        /* Glassmorphism Effect for Dock */
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* 3D Container */
        .perspective-container {
            perspective: 1200px;
        }
        
        /* The Card Itself */
        .tilted-card {
            transform: rotateY(-12deg) rotateX(8deg);
            transform-style: preserve-3d;
            box-shadow: 
                -30px 30px 60px rgba(0,0,0,0.8), /* Deep shadow */
                0 0 0 1px rgba(255, 255, 255, 0.1) inset; /* Inner glow border */
            transition: transform 0.3s ease;
            background: linear-gradient(160deg, #1a1a1a 0%, #050505 100%);
        }
        
        /* Interactive Hover Effect */
        .perspective-container:hover .tilted-card {
            transform: rotateY(-5deg) rotateX(5deg) scale(1.02);
        }

        /* Floating Rank Badge */
        .floating-badge {
            transform: translateZ(40px); /* Pushes element 'closer' to camera */
        }
    </style>
</head>
<body class="text-white font-body h-screen flex flex-col relative selection:bg-nexusGreen selection:text-black">

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-nexusGreen/10 blur-[150px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-blue-600/10 blur-[150px] rounded-full"></div>
    </div>

        <?php
if (!$isloggedin) { ?>

    <nav class="fixed w-full z-50 top-0 border-b border-white/5 bg-black/50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 md:px-8 h-20 flex items-center justify-between">

            <a href="../index.php" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-nexusGreen text-black flex items-center justify-center rounded skew-x-[-10deg] group-hover:bg-white transition-colors">
                    <i class="fa-solid fa-bolt text-xl skew-x-[10deg]"></i>
                </div>
                <span class="text-2xl font-black font-heading tracking-widest text-white uppercase group-hover:text-nexusGreen transition-colors">Nexus</span>
            </a>

            <div class="flex items-center gap-6 md:gap-8">
                <a href="pages/login.php" class="text-gray-400 hover:text-white font-heading font-bold uppercase tracking-wider text-sm transition-colors">
                    Log In
                </a>
                <a href="pages/register.php" class="bg-white text-black px-6 py-2 rounded font-heading font-bold uppercase tracking-wider text-sm hover:bg-nexusGreen transition-colors shadow-[0_0_15px_rgba(255,255,255,0.3)] hover:shadow-[0_0_20px_rgba(207,255,4,0.6)]">
                    <span class="hidden md:inline">Initialize</span> Start
                </a>
            </div>
        </div>
    </nav>
<?php } else { ?>

    <nav class="fixed w-full z-50 top-0 border-b border-white/10 bg-[#0a0a0a]/90 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 md:px-8 h-20 flex items-center justify-between">

            <div class="flex items-center gap-12">
                <a href="../index.php" class="flex items-center gap-2 group">
                    <i class="fa-solid fa-network-wired text-nexusGreen text-2xl group-hover:animate-pulse"></i>
                    <span class="text-2xl font-black font-heading tracking-widest text-white uppercase group-hover:text-nexusGreen transition-colors">Nexus</span>
                </a>

                <div class="hidden md:flex items-center gap-8 font-heading font-bold uppercase tracking-wider text-sm h-full">
                    <a href="lobbies.php" class="text-white h-full flex items-center border-b-2 border-nexusGreen">
                        Lobby Finder
                    </a>
                    <a href="my-squad.php" class="text-gray-500 hover:text-white h-full flex items-center border-b-2 border-transparent hover:border-white/20 transition-colors">
                        My Squad
                    </a>
                    <a href="scrims.php" class="text-gray-500 hover:text-white h-full flex items-center border-b-2 border-transparent hover:border-white/20 transition-colors">
                        Scrims
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-6">

                <a href="create_lobby.php" class="hidden md:flex items-center gap-2 border border-nexusGreen/30 bg-nexusGreen/5 text-nexusGreen px-4 py-2 rounded hover:bg-nexusGreen hover:text-black transition-all group shadow-[0_0_10px_rgba(207,255,4,0.1)] hover:shadow-[0_0_20px_rgba(207,255,4,0.4)]">
                    <i class="fa-solid fa-plus text-sm"></i>
                    <span class="font-heading font-bold uppercase text-sm tracking-wide">Create Lobby</span>
                </a>

                <button class="relative text-gray-400 hover:text-white transition-colors">
                    <i class="fa-solid fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-[#0a0a0a]"></span>
                </button>

                <div class="h-8 w-[1px] bg-white/10 hidden md:block"></div>

                <div class="flex items-center gap-3 cursor-pointer group">
                    <div class="text-right hidden md:block">
                        <p class="text-white font-heading font-bold leading-none text-lg group-hover:text-nexusGreen transition-colors">
                            <?= $user_info["user_name"] ?>
                        </p>
                        <div class="flex items-center justify-end gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-nexusGreen animate-pulse"></span>
                            <p class="text-[10px] font-mono uppercase text-gray-500">Online</p>
                        </div>
                    </div>
                    <a href="./pages/profile.php">
                        <div class="relative w-10 h-10">
                            <div class="absolute inset-0 rounded-lg border border-white/20 group-hover:border-nexusGreen transition-colors"></div>
                            <img src="<?= $user_info["profile_img"] ?>" class="w-full h-full rounded-lg object-cover p-0.5">
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </nav>

<?php } ?>

    <main class="flex-grow flex items-center justify-center px-4 relative z-10 w-full max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-16 items-center w-full">
            
            <div class="text-left space-y-8 relative z-20">
                <div class="inline-flex items-center gap-2 border border-nexusGreen/30 bg-nexusGreen/5 px-3 py-1 rounded-full text-nexusGreen text-xs font-mono tracking-widest uppercase">
                    <span class="w-2 h-2 rounded-full bg-nexusGreen animate-pulse"></span>
                    Live Matchmaking
                </div>

                <h1 class="text-6xl md:text-8xl font-black font-heading uppercase leading-[0.9]">
                    Never Play <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-nexusGreen to-white">Solo Q</span> Again.
                </h1>

                <p class="text-lg text-gray-400 max-w-md font-light leading-relaxed">
                    Stop gambling with randoms. Find teammates who match your <span class="text-white font-medium">Rank</span>, <span class="text-white font-medium">Role</span>, and <span class="text-white font-medium">Language</span> instantly.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button class="bg-nexusGreen text-black px-8 py-4 rounded font-heading font-black uppercase tracking-wider hover:bg-white transition-all transform hover:-translate-y-1">
                        Find a Squad
                    </button>
                    <button class="px-8 py-4 rounded border border-gray-700 text-white font-heading font-bold uppercase tracking-wider hover:border-nexusGreen hover:text-nexusGreen transition-all">
                        Create Lobby
                    </button>
                </div>
            </div>

            <div class="perspective-container hidden lg:flex justify-center items-center h-[500px]">
                
                <div class="tilted-card animate-float w-[380px] rounded-3xl overflow-hidden relative border border-white/10">
                    
                    <div class="h-32 w-full relative">
                        <img src="https://mmos.com/wp-content/uploads/2021/06/valorant-heroes-grayscale-banner.jpg" class="w-full h-full object-cover opacity-60">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#1a1a1a]"></div>
                        
                        <div class="floating-badge absolute -bottom-6 right-6 w-16 h-16 bg-purple-900 rounded-full border-2 border-purple-400 flex items-center justify-center shadow-[0_0_20px_rgba(168,85,247,0.5)] z-20">
                            <i class="fa-solid fa-gem text-2xl text-white"></i>
                        </div>
                    </div>

                    <div class="p-6 pt-2">
                        <div class="flex items-end gap-3 mb-6 relative z-10 -mt-10">
                            <div class="w-16 h-16 rounded-2xl bg-gray-800 p-1 border border-gray-600">
                                <img src="https://i.pravatar.cc/150?u=ninja" class="w-full h-full rounded-xl object-cover">
                            </div>
                            <div class="mb-1">
                                <h3 class="font-heading font-bold text-2xl leading-none">Ninja</h3>
                                <p class="text-xs text-nexusGreen uppercase tracking-wider font-bold">Host • Ascendant 3</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-4 text-xs font-mono text-gray-400 border-b border-gray-800 pb-2">
                            <span><i class="fa-solid fa-server mr-1"></i> US East</span>
                            <span class="text-red-400"><i class="fa-solid fa-microphone mr-1"></i> Mics Required</span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center bg-black/40 p-3 rounded-lg border border-gray-800">
                                <div class="flex items-center gap-3 opacity-50">
                                    <div class="w-8 h-8 rounded bg-gray-700 flex items-center justify-center"><i class="fa-solid fa-wind text-sm"></i></div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-300 leading-none">Jett</p>
                                        <p class="text-[10px] text-gray-500 uppercase">Duelist</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold text-gray-600 bg-gray-800 px-2 py-1 rounded uppercase">Taken</span>
                            </div>

                            <div class="flex justify-between items-center bg-nexusGreen/5 p-3 rounded-lg border border-nexusGreen shadow-[0_0_15px_rgba(207,255,4,0.1)] relative overflow-hidden group cursor-pointer">
                                <div class="absolute inset-0 bg-nexusGreen/10 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-300"></div>
                                
                                <div class="flex items-center gap-3 relative z-10">
                                    <div class="w-8 h-8 rounded bg-nexusGreen/20 flex items-center justify-center text-nexusGreen">
                                        <i class="fa-solid fa-eye animate-pulse"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-white leading-none">Controller</p>
                                        <p class="text-[10px] text-nexusGreen uppercase">Open Slot</p>
                                    </div>
                                </div>
                                <button class="relative z-10 bg-nexusGreen text-black text-[10px] font-black uppercase px-3 py-1.5 rounded hover:scale-105 transition-transform">
                                    Apply
                                </button>
                            </div>

                            <div class="flex justify-between items-center bg-black/40 p-3 rounded-lg border border-gray-800 border-dashed opacity-70">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded border border-gray-700 flex items-center justify-center text-gray-600"><i class="fa-solid fa-plus"></i></div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-500 leading-none">Any Role</p>
                                        <p class="text-[10px] text-gray-600 uppercase">Open Slot</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="w-full pb-8">
        <div class="max-w-xl mx-auto glass-panel rounded-2xl px-8 py-4 flex justify-between items-center text-gray-400">
            <span class="text-xs font-mono uppercase tracking-widest opacity-50">Supported Platforms</span>
            <div class="h-4 w-[1px] bg-gray-700"></div>
            <div class="flex gap-6 text-xl">
                <i class="fa-brands fa-xbox hover:text-nexusGreen transition-colors cursor-pointer" title="Xbox"></i>
                <i class="fa-brands fa-playstation hover:text-nexusGreen transition-colors cursor-pointer" title="PlayStation"></i>
                <i class="fa-brands fa-steam hover:text-nexusGreen transition-colors cursor-pointer" title="Steam"></i>
                <i class="fa-brands fa-discord hover:text-nexusGreen transition-colors cursor-pointer" title="Discord"></i>
            </div>
        </div>
    </div>

</body>
</html>